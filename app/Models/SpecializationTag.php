<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['specialization_id', 'tag_id'])]
class SpecializationTag extends Model
{
    public function specialization(): BelongsTo
    {
        return $this->belongsTo(ProgramSpecialization::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
