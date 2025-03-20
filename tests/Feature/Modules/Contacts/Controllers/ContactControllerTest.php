<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Contacts\Controllers;

use App\Modules\Contacts\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_upsert_contact(): void
    {
        $response = $this->postJson('/api/contacts', [
            'name' => 'John Doe',
            'phone' => '+61412345678',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'phone',
                'email',
            ]);
    }

    public function test_it_validates_phone_number_format(): void
    {
        $response = $this->postJson('/api/contacts', [
            'name' => 'John Doe',
            'phone' => '0412345678', // Invalid format
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone']);
    }

    public function test_it_can_search_by_email_domain(): void
    {
        Contact::factory()->create([
            'email' => 'test@example.com'
        ]);

        $response = $this->getJson('/api/contacts/search?q=example.com&type=email_domain');

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_it_simulates_call(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->postJson("/api/contacts/{$contact->id}/call");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'contact',
                'timestamp'
            ]);
    }
}