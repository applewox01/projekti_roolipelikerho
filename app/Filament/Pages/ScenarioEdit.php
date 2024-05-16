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
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class ScenarioEdit extends Page implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $edit = '';

    public ?array $data = [];
    public ?array $npcs = [];
    public ?array $monsters = [];
    public ?array $places = [];
    public ?array $events = [];
    public ?array $attachments = [];

    public $scenario;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $recordTitleAttribute = 'Skenaarion muokkaus';
    protected static ?string $navigationLabel = 'Skenaarion muokkaus';
    protected static ?string $title = 'Skenaarion muokkaus';

    protected static string $view = 'filament.pages.scenario-edit';

    public function mount() {
        $this->scenario = Scenario::find($this->edit);
        if(!$this->scenario) {
            abort(404, 'Skenaariota ei löytynyt');
        }

        $npc = npc::where('scenario_id', $this->scenario->id)->get();
        $monster = monster::where('scenario_id', $this->scenario->id)->get();
        $rooms = rooms::where('scenario_id', $this->scenario->id)->get();
        $events = events::where('scenario_id', $this->scenario->id)->get();
        $attachments = attachments::where('scenario_id', $this->scenario->id)->get();

        $this->npcs = $npc[0]->data ?? [];
        $this->monsters = $monster[0]->data ?? [];
        $this->places = $rooms[0]->data ?? [];
        $this->events = $events[0]->data ?? [];
        $this->attachments = $attachments[0]->data ?? [];

        $this->form->fill($this->scenario->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Nimi')
                ->unique('scenarios', 'name')
                ->required()
                ->columnSpan(2),
            Select::make('world_id')
                ->label('Maailma')
                ->native(false)
                ->searchable()
                ->options([worlds::all()->pluck('name', 'id')->toArray()])
                ->columnSpan(2),
            RichEditor::make('description')
                ->label('Kuvaus')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'italic',
                ])
                ->columnSpan(2),
            TextInput::make('lvl_lowest')
                ->label('Matalin taso')
                ->numeric()
                ->required(),
            TextInput::make('lvl_highest')
                ->label('Korkein taso')
                ->numeric()
                ->required(),
            TextInput::make('plr_least')
                ->label('Vähiten pelaajia')
                ->numeric()
                ->required(),
            TextInput::make('plr_most')
                ->label('Eniten pelaajia')
                ->numeric()
                ->required(),
            RichEditor::make('other_requirements')
                ->label('Muut vaatimukset')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'italic',
                ])
                ->columnSpan(2),
            RichEditor::make('admin_desc')
                ->label('Ylläpidon kuvaus')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'italic',
                ])
                ->columnSpan(2),
            RichEditor::make('background_info')
                ->label('Taustatiedot')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'italic',
                ])
                ->columnSpan(2),
            FileUpload::make('attachments')
                ->multiple()
                ->disk('public')
                ->label('Liitteet')
                ->columnSpan(2),
        ])
        ->statePath('data')
        ->columns(2);
    }

    public function update() {

        $scenario = Scenario::find($this->edit);
        $scenario->update($this->data);

        $npc = npc::where('scenario_id', $this->scenario->id)->get();
        $monster = monster::where('scenario_id', $this->scenario->id)->get();
        $rooms = rooms::where('scenario_id', $this->scenario->id)->get();
        $events = events::where('scenario_id', $this->scenario->id)->get();
        $attachments = attachments::where('scenario_id', $this->scenario->id)->get();

        if(isset($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $key => $attachment) {
                $filename = uniqid('attachment_') . '.' . $attachment->extension();
                $path = $attachment->storeAs('public/attachments', $filename);
                $attachmentPaths[] = $path;
            }
        }

        $attachments[0]->update([
            'data' => $this->attachments
        ]);

        $npc[0]->update([
            'data' => $this->npcs
        ]);

        $monster[0]->update([
            'data' => $this->monsters
        ]);

        $rooms[0]->update([
            'data' => $this->places
        ]);

        $events[0]->update([
            'data' => $this->events
        ]);

        Notification::make()
            ->title('Skenaario päivitetty')
            ->success()
            ->send();

    }

    public function addAttachmentField()
    {
        $this->attachments[] = [''];
    }

    public function removeAttachment($index)
    {
        array_splice($this->attachments, $index, 1);
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
