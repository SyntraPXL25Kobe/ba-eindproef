<?php

namespace App\Models;

use App\Enums\CompanyStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['legal_name', 'display_name', 'description', 'website_url', 'logo_url', 'email', 'phone', 'status'])]
class Company extends Model
{
    protected function casts(): array
    {
        return [
            'status' => CompanyStatus::class,
        ];
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(CompanyOccupation::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(CompanyTag::class);
    }
}
