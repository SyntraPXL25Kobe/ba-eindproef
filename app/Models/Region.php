<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['country_code', 'name'])]
class Region extends Model
{
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
