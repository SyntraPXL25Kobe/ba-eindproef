<?php

namespace App\Filament\Widgets;

use App\Enums\EventStatus;
use App\Filament\Resources\Events\EventResource;
use App\Models\Event;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class EventStatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $now = Carbon::now();

        return [
            Stat::make('Upcoming published', Event::where('status', EventStatus::PUBLISHED)->where('start_time', '>', $now)->count())
                ->description('Published, not started yet')
                ->color('success')
                ->icon(Heroicon::OutlinedCalendarDays)
                ->url(EventResource::getUrl('index', ['filters' => ['status' => ['value' => EventStatus::PUBLISHED->value]]])),

            Stat::make('Upcoming drafts', Event::where('status', EventStatus::DRAFT)->where('start_time', '>', $now)->count())
                ->description('Drafts, not started yet')
                ->color('gray')
                ->icon(Heroicon::OutlinedPencilSquare)
                ->url(EventResource::getUrl('index', ['filters' => ['status' => ['value' => EventStatus::DRAFT->value]]])),

           Stat::make('Now', Event::where('status', EventStatus::PUBLISHED)->where('start_time', '<=', $now)->where('end_time', '>=', $now)->count())
                ->description('Happening right now')
                ->color('warning')
                ->icon(Heroicon::OutlinedBolt)
                ->url(EventResource::getUrl('index', ['filters' => ['now' => ['isActive' => true]]])),

            Stat::make('Cancelled', Event::where('status', EventStatus::CANCELLED)->count())
                ->description('Cancelled events')
                ->color('danger')
                ->icon(Heroicon::OutlinedXCircle)
                ->url(EventResource::getUrl('index', ['filters' => ['status' => ['value' => EventStatus::CANCELLED->value]]])),
        ];
    }
}
