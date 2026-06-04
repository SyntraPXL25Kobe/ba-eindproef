<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'website_url', 'email', 'phone'])]
class EducationalInstitution extends Model
{
    //
}
