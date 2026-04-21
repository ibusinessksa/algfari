<?php

namespace Tests\Unit;

use App\Support\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    public function test_normalizes_domestic_ten_digits(): void
    {
        $this->assertSame('0551234567', PhoneNumber::normalizeSaMobile('0551234567'));
        $this->assertSame('0551234567', PhoneNumber::normalizeSaMobile(' 0551234567 '));
    }

    public function test_normalizes_nine_digits_starting_with_five(): void
    {
        $this->assertSame('0551234567', PhoneNumber::normalizeSaMobile('551234567'));
    }

    public function test_normalizes_country_code_966(): void
    {
        $this->assertSame('0551234567', PhoneNumber::normalizeSaMobile('+966551234567'));
        $this->assertSame('0551234567', PhoneNumber::normalizeSaMobile('9660551234567'));
    }

    public function test_returns_null_for_invalid(): void
    {
        $this->assertNull(PhoneNumber::normalizeSaMobile('123'));
        $this->assertNull(PhoneNumber::normalizeSaMobile(''));
        $this->assertNull(PhoneNumber::normalizeSaMobile(null));
    }
}
