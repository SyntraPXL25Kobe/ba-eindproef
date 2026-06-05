<?php

namespace App\Filament\Widgets;

use App\Enums\CompanyStatus;
use App\Filament\Resources\Companies\CompanyResource;
use App\Models\Company;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total companies', Company::count())
                ->description('All registered companies')
                ->color('primary')
                ->icon(Heroicon::OutlinedEye)
                ->url(CompanyResource::getUrl('index')),

            Stat::make('Approved', Company::where('status', CompanyStatus::APPROVED)->count())
                ->description('Active companies')
                ->color('success')
                ->icon(Heroicon::OutlinedEye)
                ->url(CompanyResource::getUrl('index', ['filters' => ['status' => ['value' => CompanyStatus::APPROVED->value]]])),

            Stat::make('Pending approval', Company::where('status', CompanyStatus::PENDING)->count())
                ->description('Awaiting review')
                ->color('warning')
                ->icon(Heroicon::OutlinedEye)
                ->url(CompanyResource::getUrl('index', ['filters' => ['status' => ['value' => CompanyStatus::PENDING->value]]])),

            Stat::make('Rejected', Company::where('status', CompanyStatus::REJECTED)->count())
                ->description('Declined companies')
                ->color('danger')
                ->icon(Heroicon::OutlinedEye)
                ->url(CompanyResource::getUrl('index', ['filters' => ['status' => ['value' => CompanyStatus::REJECTED->value]]])),

            Stat::make('Blocked', Company::where('status', CompanyStatus::BLOCKED)->count())
                ->description('Blocked companies')
                ->color('gray')
                ->icon(Heroicon::OutlinedEye)
                ->url(CompanyResource::getUrl('index', ['filters' => ['status' => ['value' => CompanyStatus::BLOCKED->value]]])),
        ];
    }
}
