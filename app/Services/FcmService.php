<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class FcmService
{
    private const OAUTH_SCOPE = 'https://www.googleapis.com/auth/firebase.messaging';
    private const OAUTH_TOKEN_URL = 'https://oauth2.googleapis.com/token';
    private const CACHE_KEY = 'fcm.v1.access_token';

    private ?array $credentials = null;
    private ?string $projectId = null;

    public function send(string $token, string $title, string $body, array $data = []): bool
    {
        $result = $this->sendMulticast([$token], $title, $body, $data);

        return empty($result['invalid_tokens']) && $result['success'] > 0;
    }

    /**
     * Send the same message to many device tokens.
     *
     * @return array{success:int, failure:int, invalid_tokens:string[]}
     */
    public function sendMulticast(array $tokens, string $title, string $body, array $data = []): array
    {
        $tokens = array_values(array_filter(array_unique($tokens)));
        $result = ['success' => 0, 'failure' => 0, 'invalid_tokens' => []];

        if (empty($tokens)) {
            return $result;
        }

        try {
            $accessToken = $this->getAccessToken();
            $projectId = $this->getProjectId();
        } catch (\Throwable $e) {
            Log::error('FCM: unable to obtain access token', ['error' => $e->getMessage()]);
            $result['failure'] = count($tokens);
            return $result;
        }

        $endpoint = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $stringData = [];
        foreach ($data as $k => $v) {
            $stringData[(string) $k] = is_scalar($v) ? (string) $v : json_encode($v, JSON_UNESCAPED_UNICODE);
        }

        foreach ($tokens as $token) {
            $payload = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'data' => $stringData,
                ],
            ];

            try {
                $response = Http::withToken($accessToken)
                    ->acceptJson()
                    ->asJson()
                    ->timeout(10)
                    ->post($endpoint, $payload);

                if ($response->successful()) {
                    $result['success']++;
                    continue;
                }

                $result['failure']++;
                $errorStatus = $response->json('error.status');
                $errorDetails = $response->json('error.details') ?? [];

                if ($this->isInvalidTokenError($response->status(), $errorStatus, $errorDetails)) {
                    $result['invalid_tokens'][] = $token;
                }

                Log::warning('FCM send failed', [
                    'status' => $response->status(),
                    'error' => $response->json('error'),
                ]);
            } catch (\Throwable $e) {
                $result['failure']++;
                Log::error('FCM send exception', ['error' => $e->getMessage()]);
            }
        }

        return $result;
    }

    private function isInvalidTokenError(int $httpStatus, ?string $errorStatus, array $details): bool
    {
        if ($httpStatus === 404 || $errorStatus === 'NOT_FOUND' || $errorStatus === 'UNREGISTERED') {
            return true;
        }

        foreach ($details as $detail) {
            $code = $detail['errorCode'] ?? null;
            if (in_array($code, ['UNREGISTERED', 'INVALID_ARGUMENT'], true)) {
                return true;
            }
        }

        return false;
    }

    private function getAccessToken(): string
    {
        $cached = Cache::get(self::CACHE_KEY);
        if (is_string($cached) && $cached !== '') {
            return $cached;
        }

        $creds = $this->loadCredentials();
        $now = time();
        $expiry = $now + 3600;

        $jwt = $this->buildJwt([
            'iss' => $creds['client_email'],
            'scope' => self::OAUTH_SCOPE,
            'aud' => self::OAUTH_TOKEN_URL,
            'iat' => $now,
            'exp' => $expiry,
        ], $creds['private_key']);

        $response = Http::asForm()->timeout(10)->post(self::OAUTH_TOKEN_URL, [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]);

        if (! $response->successful()) {
            throw new RuntimeException('Failed to fetch FCM access token: ' . $response->body());
        }

        $token = (string) $response->json('access_token');
        $expiresIn = (int) ($response->json('expires_in') ?? 3600);

        if ($token === '') {
            throw new RuntimeException('Empty access token returned by Google OAuth.');
        }

        Cache::put(self::CACHE_KEY, $token, max(60, $expiresIn - 60));

        return $token;
    }

    private function buildJwt(array $claims, string $privateKey): string
    {
        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        $segments = [
            $this->base64UrlEncode(json_encode($header, JSON_UNESCAPED_SLASHES)),
            $this->base64UrlEncode(json_encode($claims, JSON_UNESCAPED_SLASHES)),
        ];

        $signingInput = implode('.', $segments);
        $signature = '';

        if (! openssl_sign($signingInput, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new RuntimeException('Failed to sign FCM JWT with service account private key.');
        }

        $segments[] = $this->base64UrlEncode($signature);

        return implode('.', $segments);
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    public function getProjectId(): string
    {
        if ($this->projectId !== null) {
            return $this->projectId;
        }

        $creds = $this->loadCredentials();

        return $this->projectId = $creds['project_id'];
    }

    private function loadCredentials(): array
    {
        if ($this->credentials !== null) {
            return $this->credentials;
        }

        $path = config('services.fcm.credentials')
            ?: env('FIREBASE_CREDENTIALS')
            ?: env('GOOGLE_APPLICATION_CREDENTIALS');

        if (! $path) {
            throw new RuntimeException('FCM credentials path is not configured (FIREBASE_CREDENTIALS).');
        }

        if (! str_starts_with($path, '/') && ! preg_match('/^[A-Za-z]:[\\\\\/]/', $path)) {
            $path = base_path($path);
        }

        if (! is_file($path) || ! is_readable($path)) {
            throw new RuntimeException("FCM credentials file not found or unreadable: {$path}");
        }

        $json = json_decode((string) file_get_contents($path), true);

        if (! is_array($json) || empty($json['project_id']) || empty($json['client_email']) || empty($json['private_key'])) {
            throw new RuntimeException('Invalid FCM service account JSON (missing project_id/client_email/private_key).');
        }

        return $this->credentials = $json;
    }
}
