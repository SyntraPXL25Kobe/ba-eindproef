<?php

namespace App\Models;

use App\Enums\CompanyStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['legal_name', 'display_name', 'description', 'website_url', 'logo_url', 'email', 'phone', 'status'])]
class Company extends Model
{
    protected $casts = [
        'status' => CompanyStatus::class,
    ];

    /**
     * The locations (offices/branches) belonging to this company.
     *
     * @return HasMany<CompanyLocation, $this>
     */
    public function locations(): HasMany
    {
        return $this->hasMany(CompanyLocation::class);
    }

    /**
     * The occupations this company hires for.
     *
     * @return BelongsToMany<Occupation, $this>
     */
    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'company_occupations');
    }
}
