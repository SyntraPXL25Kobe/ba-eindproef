<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'name'])]
class DeliveryMode extends Model
{
    public function programOfferings(): HasMany
    {
        return $this->hasMany(ProgramOffering::class);
    }
}
