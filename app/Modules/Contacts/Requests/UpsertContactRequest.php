<?php

declare(strict_types=1);

namespace App\Modules\Contacts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Contacts\Rules\E164PhoneNumber;

class UpsertContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', new E164PhoneNumber],
            'email' => ['required', 'email'],
        ];
    }
}