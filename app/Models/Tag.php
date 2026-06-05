<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'code'])]
class Tag extends Model
{
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(StudentTag::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(ProgramTag::class);
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(SpecializationTag::class);
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(OccupationTag::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(CompanyTag::class);
    }
}
