<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Contacts\Rules;

use App\Modules\Contacts\Rules\E164PhoneNumber;
use PHPUnit\Framework\TestCase;

class E164PhoneNumberTest extends TestCase
{
    private E164PhoneNumber $rule;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rule = new E164PhoneNumber();
    }

    /**
     * @dataProvider validPhoneNumbers
     */
    public function test_it_passes_valid_phone_numbers(string $number): void
    {
        $fails = false;
        $this->rule->validate('phone', $number, function () use (&$fails) {
            $fails = true;
        });

        $this->assertFalse($fails);
    }

    /**
     * @dataProvider invalidPhoneNumbers
     */
    public function test_it_fails_invalid_phone_numbers(string $number): void
    {
        $fails = false;
        $this->rule->validate('phone', $number, function () use (&$fails) {
            $fails = true;
        });

        $this->assertTrue($fails);
    }

    public static function validPhoneNumbers(): array
    {
        return [
            ['+61412345678'],
            ['+64211234567'],
        ];
    }

    public static function invalidPhoneNumbers(): array
    {
        return [
            ['0412345678'], // Missing +
            ['+1234567890'], // US number
            ['+61abc123456'], // Invalid characters
        ];
    }
}