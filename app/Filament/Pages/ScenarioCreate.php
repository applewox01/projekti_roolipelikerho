<?php

namespace App\Filament\Pages;

use App\Models\attachments;
use App\Models\events;
use App\Models\monster;
use App\Models\npc;
use App\Models\rooms;
use App\Models\Scenario;
use App\Models\worlds;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

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
                    ->unique('scenarios', 'name')
                    ->required(),
                TextInput::make('description')
                    ->label('Kuvaus'),
                TextInput::make('background_info')
                    ->label('Taustatiedot'),
                TextInput::make('other_requirements')
                    ->label('Muut vaatimukset'),
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
                    ->label('Ylläpidon kuvaus'),
                Select::make('world_id')
                    ->label('Maailma')
                    ->native(false)
                    ->searchable()
                    ->options([worlds::all()->pluck('name', 'id')->toArray()]),
                FileUpload::make('attachments')
                    ->multiple()
                    ->disk('local')
                    ->label('Liitteet'),
            ])
            ->statePath('data');
    }

    public function create() {
        $attachmentPaths = [];

        if(isset($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $key => $attachment) {
                $filename = uniqid('attachment_') . '.' . $attachment->extension();
                $path = $attachment->storeAs('attachments', $filename);
                $attachmentPaths[] = $path;
            }
        }

        $scenario = Scenario::create($this->data);

        npc::create([
            'scenario_id' => $scenario->id,
            'data' => $this->npcs
        ]);

        monster::create([
            'scenario_id' => $scenario->id,
            'data' => $this->monsters
        ]);

        rooms::create([
            'scenario_id' => $scenario->id,
            'data' => $this->places
        ]);

        events::create([
            'scenario_id' => $scenario->id,
            'data' => $this->events
        ]);

        attachments::create([
            'scenario_id' => $scenario->id,
            'data' => $attachmentPaths
        ]);

        Notification::make()
            ->title('Skenaario luotu')
            ->success()
            ->send();

        $this->form->fill();
        $this->reset('data', 'npcs', 'monsters', 'places', 'events');
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
