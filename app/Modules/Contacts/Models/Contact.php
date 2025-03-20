<?php

declare(strict_types=1);

namespace App\Modules\Contacts\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}