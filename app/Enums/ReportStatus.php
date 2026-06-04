<?php

namespace App\Enums;

enum ReportStatus: string
{
    case OPEN = 'open';
    case IN_REVIEW = 'in review';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';
}
