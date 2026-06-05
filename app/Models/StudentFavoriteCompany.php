<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['student_profile_id', 'company_id'])]
class StudentFavoriteCompany extends Model
{
    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
