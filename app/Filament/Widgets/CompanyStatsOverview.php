<?php

namespace App\Filament\Widgets;

use App\Enums\CompanyStatus;
use App\Models\Company;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total companies', Company::count())
                ->description('All registered companies')
                ->color('primary'),

            Stat::make('Pending approval', Company::where('status', CompanyStatus::PENDING)->count())
                ->description('Awaiting review')
                ->color('warning'),

            Stat::make('Approved', Company::where('status', CompanyStatus::APPROVED)->count())
                ->description('Active companies')
                ->color('success'),

            Stat::make('Total users', User::count())
                ->description('Registered accounts')
                ->color('gray'),
        ];
    }
}