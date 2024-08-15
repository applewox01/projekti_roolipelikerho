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
                    ->options(Worlds::query()->pluck('name', 'id'))
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
                Repeater::make('attachments')
                    ->label('Liitteet')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nimi')
                            ->required()
                            ->columnSpan(2),
                        FileUpload::make('attachments')
                            ->disk('public')
                            ->label('Liitteet')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->cloneable()
                    ->reorderableWithButtons()
                    ->addActionLabel('Lisää liite')
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Liite'),
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
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'NPC'),
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
                            ->columnSpan(1),
                        RichEditor::make('attack_info')
                            ->label('Taistelutiedot')
                            ->toolbarButtons([
                                'h2',
                                'blockquote',
                                'bold',
                                'italic',
                            ])
                            ->columnSpan(2),
                        RichEditor::make('misc_info')
                            ->label('Lisätiedot')
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
                    ->addActionLabel('Lisää hirviö')
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Hirviö'),
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
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Paikka'),
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
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Tapahtuma'),
            ])
            ->statePath('data')
            ->live()
            ->columns(2);
    }
    public function create() {
        $attachmentPaths = [];

        if (isset($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $groupKey => $attachmentGroup) {
                foreach ($attachmentGroup['attachments'] as $attachmentKey => $attachment) {
                    $filename = uniqid('attachment_') . '.' . $attachment->extension();

                    $path = $attachment->storeAs('attachments', $filename, 'public');

                    $attachmentPaths[$groupKey]['name'] = $attachmentGroup['name'];
                    $attachmentPaths[$groupKey]['attachments'][$attachmentKey] = [
                        'filename' => $filename,
                        'path' => $path
                    ];
                }
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
            'data' => json_encode($attachmentPaths)
        ]);

        activity()
            ->causedBy(auth()->user())
            ->event('scenario.created')
            ->log('Ylläpitäjä ' . auth()->user()->username . ' loi skenaarion ' . $this->data['name']);

        Notification::make()
            ->title('Skenaario luotu')
            ->success()
            ->send();

        return redirect()->route('filament.admin.pages.scenarios');
    }
}
