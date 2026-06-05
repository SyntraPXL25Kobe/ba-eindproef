<?php

namespace App\Enums;

enum ConversationStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
}
