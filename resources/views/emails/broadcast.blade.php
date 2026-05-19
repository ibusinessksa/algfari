<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>{{ $heading }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        .header { background: #1B5E3B; padding: 24px; text-align: center; color: #fff; }
        .body { padding: 32px 24px; color: #333; line-height: 1.7; white-space: pre-wrap; }
        .footer { background: #f4f4f4; text-align: center; padding: 16px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header"><h2>{{ $heading }}</h2></div>
        <div class="body">
            <p>{{ __('emails.guest') }}{{ $recipientName ? ' ' . $recipientName : '' }}،</p>
            <p>{{ $bodyText }}</p>
        </div>
        <div class="footer">&copy; {{ date('Y') }} {{ config('app.name') }}</div>
    </div>
</body>
</html>
