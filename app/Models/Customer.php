<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'secondary_phone',
        'national_id',
        'national_id_front',
        'national_id_back',
        'date_of_birth',
        'address',
        'job',
        'workplace',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'additional_data',
        'notes',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
