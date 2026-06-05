<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'birth_date', 'current_education_level_id'])]
class StudentProfile extends Model
{
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currentEducationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(StudentTag::class);
    }

    public function desiredSectors(): BelongsToMany
    {
        return $this->belongsToMany(StudentDesiredSector::class);
    }

    public function desiredRegions(): BelongsToMany
    {
        return $this->belongsToMany(StudentDesiredRegion::class);
    }

    public function desiredEducationLevels(): BelongsToMany
    {
        return $this->belongsToMany(StudentDesiredEducationLevel::class);
    }

    public function favoriteCompanies(): BelongsToMany
    {
        return $this->belongsToMany(StudentFavoriteCompany::class);
    }

    public function favoriteEducationalInstitutions(): BelongsToMany
    {
        return $this->belongsToMany(StudentFavoriteEducationalInstitution::class);
    }

    public function favoriteEvents(): BelongsToMany
    {
        return $this->belongsToMany(StudentFavoriteEvent::class);
    }

    public function favoriteOccupations(): BelongsToMany
    {
        return $this->belongsToMany(StudentFavoriteOccupation::class);
    }

    public function favoritePrograms(): BelongsToMany
    {
        return $this->belongsToMany(StudentFavoriteProgram::class);
    }

    public function hiddenPrograms(): BelongsToMany
    {
        return $this->belongsToMany(StudentHiddenProgram::class);
    }

    public function eventRegistrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }
}
