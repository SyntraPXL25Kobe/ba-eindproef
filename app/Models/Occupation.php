<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['code', 'name', 'function_description'])]
class Occupation extends Model
{
    public function sectors(): BelongsToMany
    {
        return $this->belongsToMany(OccupationSector::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(OccupationProgram::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(CompanyOccupation::class);
    }
}
