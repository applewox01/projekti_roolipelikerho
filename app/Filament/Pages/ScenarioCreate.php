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
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Components\RichEditor;
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

    public function mount() {
        $this->form->fill();
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
                        'h2',
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
                        'h2',
                        'blockquote',
                        'bold',
                        'italic',
                    ])
                    ->columnSpan(2),
                RichEditor::make('admin_desc')
                    ->label('Ylläpidon kuvaus')
                    ->toolbarButtons([
                        'h2',
                        'blockquote',
                        'bold',
                        'italic',
                    ])
                    ->columnSpan(2),
                RichEditor::make('background_info')
                    ->label('Taustatiedot')
                    ->toolbarButtons([
                        'h2',
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
                Repeater::make('npcs')
                    ->label('NPC:t')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nimi')
                            ->required()
                            ->columnSpan(2),
                        RichEditor::make('description')
                            ->label('Kuvaus')
                            ->toolbarButtons([
                                'h2',
                                'blockquote',
                                'bold',
                                'italic',
                            ])
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->cloneable()
                    ->reorderableWithButtons()
                    ->addActionLabel('Lisää NPC')
                    ->itemLabel('NPC'),
                Repeater::make('monsters')
                    ->label('Hirviöt')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nimi')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('defense')
                            ->label('Puolustus')
                            ->columnSpan(1),
                        TextInput::make('attack_info')
                            ->label('Taistelutiedot')
                            ->columnSpan(1),
                        RichEditor::make('misc_info')
                            ->label('Lisätiedot')
                            ->toolbarButtons([
                                'h2',
                                'blockquote',
                                'bold',
                                'italic',
                            ])
                            ->columnSpan(2),
                        TextInput::make('hp')
                            ->label('Osumapisteet')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('xp')
                            ->label('XP')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('link')
                            ->label('Linkki')
                            ->url()
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->cloneable()
                    ->reorderableWithButtons()
                    ->addActionLabel('Lisää hirviö')
                    ->itemLabel('Hirviö'),
                Repeater::make('places')
                    ->label('Paikat')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nimi')
                            ->required()
                            ->columnSpan(2),
                        RichEditor::make('description')
                            ->label('Kuvaus')
                            ->toolbarButtons([
                                'h2',
                                'blockquote',
                                'bold',
                                'italic',
                            ])
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->cloneable()
                    ->reorderableWithButtons()
                    ->addActionLabel('Lisää paikka')
                    ->itemLabel('Paikka'),
                Repeater::make('events')
                    ->label('Tapahtumat')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nimi')
                            ->required()
                            ->columnSpan(2),
                        RichEditor::make('description')
                            ->label('Kuvaus')
                            ->toolbarButtons([
                                'h2',
                                'blockquote',
                                'bold',
                                'italic',
                            ])
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->cloneable()
                    ->reorderableWithButtons()
                    ->addActionLabel('Lisää tapahtuma')
                    ->itemLabel('Tapahtuma'),
            ])
            ->statePath('data')
            ->live()
            ->columns(2);
    }
    public function create() {
        $attachmentPaths = [];

        if(isset($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $key => $attachment) {
                $filename = uniqid('attachment_') . '.' . $attachment->extension();
                $path = $attachment->storeAs('public/attachments', $filename);
                $attachmentPaths[] = $path;
            }
        }

        $scenario = Scenario::create($this->data);

        npc::create([
            'scenario_id' => $scenario->id,
            'data' => json_encode($this->data['npcs'])
        ]);

        monster::create([
            'scenario_id' => $scenario->id,
            'data' => json_encode($this->data['monsters'])
        ]);

        rooms::create([
            'scenario_id' => $scenario->id,
            'data' => json_encode($this->data['places'])
        ]);

        events::create([
            'scenario_id' => $scenario->id,
            'data' => json_encode($this->data['events'])
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
        $this->reset('data');
    }
}
