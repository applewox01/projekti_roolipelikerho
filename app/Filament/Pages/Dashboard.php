<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $recordTitleAttribute = 'Etusivu';
    protected static ?string $navigationLabel = 'Etusivu';
    protected static ?string $title = 'Etusivu';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static string $view = 'filament.pages.dashboard';
}
