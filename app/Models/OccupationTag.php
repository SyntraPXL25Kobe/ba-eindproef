<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['occupation_id', 'tag_id'])]
class OccupationTag extends Model
{
    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
