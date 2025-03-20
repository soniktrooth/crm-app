<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Modules\Contacts\DTOs\ContactData;
use App\Modules\Contacts\Services\ContactService;
use Illuminate\Console\Command;

class ContactCommand extends Command
{
    protected $signature = 'contacts
                          {action : The action to perform (upsert/delete/search/show/call)}
                          {--id= : Contact ID for show/delete/call}
                          {--name= : Contact name for upsert}
                          {--phone= : Contact phone for upsert}
                          {--email= : Contact email for upsert}
                          {--query= : Search query}';

    protected $description = 'Manage contacts via CLI';

    public function handle(ContactService $service): int
    {
        $action = $this->argument('action');

        return match ($action) {
            'upsert' => $this->handleUpsert($service),
            'delete' => $this->handleDelete($service),
            'search' => $this->handleSearch($service),
            'show' => $this->handleShow($service),
            'call' => $this->handleCall($service),
            default => $this->error('Invalid action')
        };
    }

    private function handleUpsert(ContactService $service): int
    {
        $contact = $service->upsert(new ContactData(
            name: $this->option('name'),
            phone: $this->option('phone'),
            email: $this->option('email')
        ));

        $this->info("Contact upserted: {$contact->id}");
        return 0;
    }

    // ... similar methods for other actions
}