<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;

class ManageTranslations extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?string $navigationLabel = 'Çeviriler';
    protected static ?string $title = 'Çeviri Yönetimi';
    protected static ?string $navigationGroup = 'Site Ayarları';

    protected static string $view = 'filament.pages.manage-translations';

    public ?array $translations = [];

    public function mount(): void
    {
        $enPath = lang_path('en.json');
        $trPath = lang_path('tr.json');

        $enTranslations = File::exists($enPath) ? json_decode(File::get($enPath), true) : [];
        $trTranslations = File::exists($trPath) ? json_decode(File::get($trPath), true) : [];

        $merged = [];
        // Use English as the base key structure
        foreach ($enTranslations as $key => $value) {
            $merged[] = [
                'key' => $key,
                'en' => $value,
                'tr' => $trTranslations[$key] ?? '',
            ];
        }

        $this->form->fill([
            'translations' => $merged,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('translations')
                    ->label('Çeviri Metinleri')
                    ->schema([
                        TextInput::make('key')
                            ->label('Anahtar (Key)')
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('tr')
                            ->label('Türkçe')
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('en')
                            ->label('İngilizce')
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->reorderable(false)
                    ->addable(true) // Allow adding new keys if developer needs to from UI
                    ->deletable(true)
                    ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                    ->collapsible(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $translations = $data['translations'] ?? [];

        $enData = [];
        $trData = [];

        foreach ($translations as $item) {
            if (!empty($item['key'])) {
                $enData[$item['key']] = $item['en'];
                $trData[$item['key']] = $item['tr'];
            }
        }

        File::put(lang_path('en.json'), json_encode($enData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        File::put(lang_path('tr.json'), json_encode($trData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        Notification::make()
            ->title('Çeviriler başarıyla kaydedildi')
            ->success()
            ->send();
    }
}
