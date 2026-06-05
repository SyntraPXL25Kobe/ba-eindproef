<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['code', 'name', 'description', 'education_level_id', 'default_duration_months', 'outecome_credential_id', 'is_active'])]
class Program extends Model
{
    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function outcomeCredential(): BelongsTo
    {
        return $this->belongsTo(Credential::class, 'outecome_credential_id');
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(OccupationProgram::class);
    }
}
