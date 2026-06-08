<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Models\Event;
use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(Request $request): Response
    {
        $selectedSector = $request->integer('sector') ?: null;

        $events = Event::query()
            ->where('status', EventStatus::PUBLISHED)
            ->where('start_time', '>=', now())
            ->when($selectedSector, fn ($query) => $query->whereHas(
                'sectors',
                fn ($q) => $q->where('sectors.id', $selectedSector)
            ))
            ->with(['company:id,display_name', 'eventType:id,name', 'sectors:id,name'])
            ->orderBy('start_time')
            ->get(['id', 'company_id', 'event_type_id', 'title', 'description', 'start_time', 'end_time', 'is_online']);

        $sectors = Sector::orderBy('name')->get(['id', 'name']);

        return Inertia::render('events/index', [
            'events' => $events,
            'sectors' => $sectors,
            'selectedSector' => $selectedSector,
        ]);
    }
}
