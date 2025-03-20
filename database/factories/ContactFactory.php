<?php

namespace Database\Factories;

use App\Modules\Contacts\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Contacts\Models\Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}