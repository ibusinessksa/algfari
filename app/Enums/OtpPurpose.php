<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OtpPurpose: string implements HasLabel
{
    case Register = 'register';
    case Reset = 'reset';
    case Verify = 'verify';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this) {
            self::Register => __('enums.otp_purpose.register'),
            self::Reset => __('enums.otp_purpose.reset'),
            self::Verify => __('enums.otp_purpose.verify'),
        };
    }
}
