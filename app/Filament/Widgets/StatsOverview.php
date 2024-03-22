<?php

namespace App\Livewire;

use App\Models\characters;
use App\Models\Scenario;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalCharacters = characters::count();
        $totalScenarios = Scenario::count();
        return [
            Stat::make('Käyttäjät', $totalUsers),
            Stat::make('Hahmot', $totalCharacters),
            Stat::make('Skenaariot', $totalScenarios),
        ];
    }
}
