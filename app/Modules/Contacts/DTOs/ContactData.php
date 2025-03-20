<?php

declare(strict_types=1);

namespace App\Modules\Contacts\DTOs;

readonly class ContactData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
        );
    }
}