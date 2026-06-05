<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['conversation_id', 'user_id', 'arrived_at', 'joined_at'])]
class ConversationParticipant extends Model
{
    protected function casts(): array
    {
        return [
            'arrived_at' => 'datetime',
            'joined_at' => 'datetime',
        ];
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
