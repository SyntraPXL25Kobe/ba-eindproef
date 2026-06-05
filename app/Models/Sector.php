<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['code', 'name'])]
class Sector extends Model
{
    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(OccupationSector::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(EventSector::class);
    }
}
