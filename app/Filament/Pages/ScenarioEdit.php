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
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ScenarioEdit extends Page implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $edit = '';

    public ?array $data = [];

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


        $formData = $this->scenario->toArray();

        if (isset($attachments[0])) {
            $decodedAttachments = json_decode($attachments[0]->data, true);
            $formData['attachments'] = [];

            foreach ($decodedAttachments as $attachmentGroup) {
                $attachmentItem = [
                    'name' => $attachmentGroup['name'],
                    'attachments' => $attachmentGroup['attachments'],
                ];

                foreach ($attachmentGroup['attachments'] as $attachment) {
                    $attachmentItem['attachments'] = $attachment['path'];
                }

                $formData['attachments'][] = $attachmentItem;
            }
        } else {
            $formData['attachments'] = [];
        }

        $formData['npcs'] = isset($npc[0]) ? json_decode($npc[0]->data, true) : [];
        $formData['monsters'] = isset($monster[0]) ? json_decode($monster[0]->data, true) : [];
        $formData['places'] = isset($rooms[0]) ? json_decode($rooms[0]->data, true) : [];
        $formData['events'] = isset($events[0]) ? json_decode($events[0]->data, true) : [];

        $this->form->fill($formData);
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
        ->columns(2);
    }

    public function update() {

        $scenario = Scenario::find($this->edit);
        $scenario->update($this->data);

        $npc = npc::where('scenario_id', $this->scenario->id)->first();
        $monster = monster::where('scenario_id', $this->scenario->id)->first();
        $rooms = rooms::where('scenario_id', $this->scenario->id)->first();
        $events = events::where('scenario_id', $this->scenario->id)->first();
        $attachments = attachments::where('scenario_id', $this->scenario->id)->first();

        $attachmentPaths = [];

        if (isset($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $groupKey => $attachmentGroup) {
                $attachmentItem = [
                    'name' => $attachmentGroup['name'],
                    'attachments' => []
                ];

                foreach ($attachmentGroup['attachments'] as $attachmentKey => $attachment) {
                    if ($attachment instanceof TemporaryUploadedFile) {

                        $filename = uniqid('attachment_') . '.' . $attachment->extension();
                        $path = $attachment->storeAs('attachments', $filename, 'public');

                        $attachmentItem['attachments'][$attachmentKey] = [
                            'filename' => $filename,
                            'path' => $path
                        ];
                    } else {
                        $attachmentItem['attachments'][$attachmentKey] = [
                            'filename' => basename($attachment),
                            'path' => $attachment
                        ];
                    }
                }

                $attachmentPaths[$groupKey] = $attachmentItem;
            }
        }

        if ($attachments) {
            $attachments->update([
                'data' => json_encode($attachmentPaths)
            ]);
        } else {
            attachments::create([
                'scenario_id' => $scenario->id,
                'data' => json_encode($attachmentPaths)
            ]);
        }

        if ($npc) {
            $npc->update([
                'data' => json_encode($this->data['npcs'])
            ]);
        }

        if ($monster) {
            $monster->update([
                'data' => json_encode($this->data['monsters'])
            ]);
        }

        if ($rooms) {
            $rooms->update([
                'data' => json_encode($this->data['places'])
            ]);
        }

        if ($events) {
            $events->update([
                'data' => json_encode($this->data['events'])
            ]);
        }

        Notification::make()
            ->title('Skenaario päivitetty')
            ->body('Skenaario on päivitetty onnistuneesti')
            ->success()
            ->send();

    }
}
