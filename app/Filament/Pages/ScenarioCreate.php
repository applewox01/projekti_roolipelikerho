<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

class ScenarioCreate extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $recordTitleAttribute = 'Skenaarion luonti';
    protected static ?string $navigationLabel = 'Skenaarion luonti';
    protected static ?string $title = 'Skenaarion luonti';
    protected static string $view = 'filament.pages.scenario-create';

    public ?array $data = [];
    public ?array $npcs = [];
    public ?array $monsters = [];
    public ?array $places = [];
    public ?array $events = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nimi')
                    ->required(),
                TextInput::make('description')
                    ->label('Kuvaus')
                    ->required(),
                TextInput::make('background_info')
                    ->label('Taustatiedot')
                    ->required(),
                TextInput::make('other_requirements')
                    ->label('Muut vaatimukset')
                    ->required(),
                TextInput::make('lvl_highest')
                    ->label('Korkein taso')
                    ->numeric()
                    ->required(),
                TextInput::make('lvl_lowest')
                    ->label('Matalin taso')
                    ->numeric()
                    ->required(),
                TextInput::make('plr_most')
                    ->label('Eniten pelaajia')
                    ->numeric()
                    ->required(),
                TextInput::make('plr_least')
                    ->label('Vähiten pelaajia')
                    ->numeric()
                    ->required(),
                TextInput::make('admin_desc')
                    ->label('Ylläpidon kuvaus')
                    ->required(),
                FileUpload::make('attachments')
                    ->multiple()
            ])
            ->statePath('data')
            ->live();
    }

    public function create() {
        dd($this->data, $this->npcs, $this->monsters, $this->places, $this->events, $this->data['attachments']);
    }

    public function addNpcField()
    {
        $this->npcs[] = ['name' => '', 'description' => ''];
    }

    public function removeNpc($index)
    {
        array_splice($this->npcs, $index, 1);
    }

    public function addMonsterField()
    {
        $this->monsters[] = ['name' => '', 'attack_info' => '', 'misc_info' => '', 'defense' => '', 'hp' => '', 'xp' => '', 'link' => ''];
    }

    public function removeMonster($index)
    {
        array_splice($this->monsters, $index, 1);
    }

    public function addPlaceField()
    {
        $this->places[] = ['name' => '', 'description' => ''];
    }

    public function removePlace($index)
    {
        array_splice($this->places, $index, 1);
    }

    public function addEventField()
    {
        $this->events[] = ['name' => '', 'description' => ''];
    }

    public function removeEvent($index)
    {
        array_splice($this->events, $index, 1);
    }
}
