<?php

declare(strict_types=1);

namespace App\Modules\Contacts\Services;

use App\Modules\Contacts\DTOs\ContactData;
use App\Modules\Contacts\Models\Contact;
use Illuminate\Support\Collection;

class ContactService
{
    public function upsert(ContactData $data): Contact
    {
        return Contact::updateOrCreate(
            ['email' => $data->email],
            [
                'name' => $data->name,
                'phone' => $data->phone,
            ]
        );
    }

    public function delete(int $id): bool
    {
        return Contact::findOrFail($id)->delete();
    }

    public function search(string $query, string $type = 'all'): Collection
    {
        $contactsQuery = Contact::query();

        switch ($type) {
            case 'name':
                $contactsQuery->where('name', 'like', "%{$query}%");
                break;
            case 'phone':
                $contactsQuery->where('phone', 'like', "%{$query}%");
                break;
            case 'email_domain':
                $domain = explode('@', $query)[0] ?? $query;
                $contactsQuery->where('email', 'like', "%@{$domain}%");
                break;
            default:
                $contactsQuery->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('phone', 'like', "%{$query}%")
                      ->orWhere('email', 'like', "%{$query}%");
                });
        }

        return $contactsQuery->get();
    }

    public function call(int $id): array
    {
        $contact = Contact::findOrFail($id);

        // Simulate a phone call with mock responses
        $outcomes = ['success', 'busy', 'no_answer', 'failed'];
        $outcome = $outcomes[array_rand($outcomes)];

        return [
            'status' => $outcome,
            'contact' => $contact,
            'timestamp' => now(),
        ];
    }

    public function find(int $id): Contact
    {
        return Contact::findOrFail($id);
    }
}