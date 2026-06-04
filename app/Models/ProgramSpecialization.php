<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['program_id', 'code', 'name', 'description'])]
class ProgramSpecialization extends Model
{
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
