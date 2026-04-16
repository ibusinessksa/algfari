<?php

namespace App\Enums;

enum OtpPurpose: string
{
    case Register = 'register';
    case Reset = 'reset';
    case Verify = 'verify';

    public function label(): string
    {
        return match ($this) {
            self::Register => __('enums.otp_purpose.register'),
            self::Reset => __('enums.otp_purpose.reset'),
            self::Verify => __('enums.otp_purpose.verify'),
        };
    }
}
