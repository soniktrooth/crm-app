<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Contacts\Models\Contact;
use App\Modules\Contacts\Requests\UpsertContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');

        $contacts = Contact::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->get();

        return response()->json($contacts);
    }

    public function upsert(UpsertContactRequest $request): JsonResponse
    {
        $contact = Contact::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
            ]
        );

        return response()->json($contact);
    }

    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    public function delete(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => true]);
    }

    public function call(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);

        // Simulate a call with mock responses
        $outcomes = ['success', 'busy', 'no_answer', 'failed'];
        $outcome = $outcomes[array_rand($outcomes)];

        return response()->json([
            'status' => $outcome,
            'contact' => $contact,
            'timestamp' => now(),
        ]);
    }
}