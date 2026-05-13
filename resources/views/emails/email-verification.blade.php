<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.email_verification_subject') }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        .header { background: #1a3c5e; padding: 24px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; }
        .body { padding: 32px 24px; color: #333; line-height: 1.7; }
        .code-box { margin: 24px 0; text-align: center; background: #f0f4f8; border-radius: 8px; padding: 20px; }
        .code { font-size: 36px; font-weight: bold; letter-spacing: 10px; color: #1a3c5e; }
        .footer { background: #f4f4f4; text-align: center; padding: 16px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="body">
            <p>{{ __('emails.email_verification_greeting', ['name' => $name]) }}</p>
            <p>{{ __('emails.email_verification_line') }}</p>
            <div class="code-box">
                <div class="code">{{ $code }}</div>
            </div>
            <p>{{ __('emails.email_verification_expiry') }}</p>
            <p>{{ __('emails.email_verification_ignore') }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</body>
</html>
