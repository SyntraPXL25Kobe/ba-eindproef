<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['company_id', 'event_type_id', 'title', 'description', 'start_time', 'end_time', 'is_online', 'online_url', 'address_id', 'status'])]
class Event extends Model
{
    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_online' => 'boolean',
        'status' => EventStatus::class,
    ];
}
