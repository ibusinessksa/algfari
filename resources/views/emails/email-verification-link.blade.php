<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>{{ __('emails.email_verification_subject') }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        .header { background: #1B5E3B; padding: 24px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; }
        .body { padding: 32px 24px; color: #333; line-height: 1.7; }
        .btn { display: inline-block; background: #1B5E3B; color: #fff !important; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: bold; }
        .footer { background: #f4f4f4; text-align: center; padding: 16px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header"><h1>{{ config('app.name') }}</h1></div>
        <div class="body">
            <p>{{ __('emails.email_verification_greeting', ['name' => $name]) }}</p>
            <p>{{ __('emails.email_verification_link_line') }}</p>
            <p style="text-align:center; margin: 28px 0;">
                <a class="btn" href="{{ $url }}">{{ __('emails.email_verification_link_button') }}</a>
            </p>
            <p style="font-size:12px; color:#666;">{{ __('emails.email_verification_link_expiry') }}</p>
            <p style="font-size:12px; color:#666;">{{ __('emails.email_verification_ignore') }}</p>
        </div>
        <div class="footer">&copy; {{ date('Y') }} {{ config('app.name') }}</div>
    </div>
</body>
</html>
