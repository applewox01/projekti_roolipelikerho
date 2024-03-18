<?php

namespace App\Filament\Pages;

use App\Models\Scenario;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;


class ScenarioEdit extends Page implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $edit = '';
    public ?array $data = [];
    public $scenario;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.scenario-edit';

    public function mount() {
        $this->scenario = Scenario::find($this->edit);
        if(!$this->scenario) {
            abort(404, 'Skenaariota ei löytynyt');
        }

        $this->form->fill($this->scenario->toArray());
    }

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
            ])
            ->statePath('data')
            ->live();
    }
}
