<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('street', 'city', 'postal_code', 'house_number')]
class Address extends Model
{
    protected $casts = [
        'house_number' => 'integer',
    ];
}
