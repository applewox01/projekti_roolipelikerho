<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalCharacters = 0;
        $totalScenarios = 0;
        return [
            Stat::make('Käyttäjät', $totalUsers),
            Stat::make('Hahmot', $totalCharacters),
            Stat::make('Skenaariot', $totalScenarios),
        ];
    }
}
