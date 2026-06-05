<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['student_profile_id', 'education_level_id'])]
class StudentDesiredEducationLevel extends Model
{
    public function studentProfile()
    {
        return $this->belongsTo(StudentProfile::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
