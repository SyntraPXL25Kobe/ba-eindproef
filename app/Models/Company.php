<?php

namespace App\Models;

use App\Enums\CompanyStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['legal_name', 'display_name', 'description', 'website_url', 'logo_url', 'email', 'phone', 'address', 'status'])]
class Company extends Model
{
    protected $casts = [
        'status' => CompanyStatus::class,
    ];
}
