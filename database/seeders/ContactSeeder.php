<?php

namespace Database\Seeders;

use App\Modules\Contacts\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory()->count(50)->create();
    }
}