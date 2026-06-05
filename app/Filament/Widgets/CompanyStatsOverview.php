<?php

namespace App\Filament\Widgets;

use App\Enums\CompanyStatus;
use App\Models\Company;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Colors\Color;

class CompanyStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total companies', Company::count())
                ->description('All registered companies')
                ->color('primary'),

            Stat::make('Approved', Company::where('status', CompanyStatus::APPROVED)->count())
                ->description('Active companies')
                ->color('success'),

            Stat::make('Pending approval', Company::where('status', CompanyStatus::PENDING)->count())
                ->description('Awaiting review')
                ->color('warning'),
            
            Stat::make('Rejected', Company::where('status', CompanyStatus::REJECTED)->count())
                ->description('Declined companies')
                ->color('danger'),

            Stat::make('Blocked', Company::where('status', CompanyStatus::BLOCKED)->count())
                ->description('Blocked companies')
                ->color('gray'),

        ];
    }
}