<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['occupation_id', 'program_id'])]
class OccupationProgram extends Model
{
    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
