<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['program_id', 'campus_id', 'delivery_mode_id'])]
class ProgramOffering extends Model
{
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function campus(): BelongsTo
    {
        return $this->belongsTo(EducationalInstitutionCampus::class);
    }

    public function deliveryMode(): BelongsTo
    {
        return $this->belongsTo(DeliveryMode::class);
    }
}
