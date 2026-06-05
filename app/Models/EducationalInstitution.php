<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description', 'website_url', 'email', 'phone'])]
class EducationalInstitution extends Model
{
    public function campuses(): HasMany
    {
        return $this->hasMany(EducationalInstitutionCampus::class);
    }

    public function programOfferings(): HasMany
    {
        return $this->hasMany(ProgramOffering::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }
}
