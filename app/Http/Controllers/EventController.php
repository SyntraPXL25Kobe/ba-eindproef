<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Models\Event;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        $events = Event::query()
            ->where('status', EventStatus::PUBLISHED)
            ->where('start_time', '>=', now())
            ->with(['company:id,display_name', 'eventType:id,name', 'sectors:id,name'])
            ->orderBy('start_time')
            ->get(['id', 'company_id', 'event_type_id', 'title', 'description', 'start_time', 'end_time', 'is_online']);

        return Inertia::render('events/index', [
            'events' => $events,
        ]);
    }
}
