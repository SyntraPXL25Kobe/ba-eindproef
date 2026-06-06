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
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => CompanyStatus::class,
        ];
    }

    public function locations(): HasMany
    {
        return $this->hasMany(CompanyLocation::class);
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'company_occupations');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'company_tags');
    }

    // TODO: members() — veel-op-veel via company_members (pivot bestaat nog niet, komt bij goedkeuringsworkflow-kaart)
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);

    }

    public function reviews(): HasMany
    {
        return $this->hasMany(CompanyReview::class);
    }
}
