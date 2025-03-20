<?php

declare(strict_types=1);

namespace App\Modules\Contacts\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class E164PhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // E164 format validation
        if (!preg_match('/^\+[1-9]\d{1,14}$/', $value)) {
            $fail('The :attribute must be in E164 format.');
            return;
        }

        // Check if it's an Australian (+61) or New Zealand (+64) number
        if (!str_starts_with($value, '+61') && !str_starts_with($value, '+64')) {
            $fail('The :attribute must be an Australian or New Zealand phone number.');
        }
    }
}