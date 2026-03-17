<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.manage-settings';

    protected static ?string $title = 'Site Ayarlarını Yönet';
    protected static ?string $navigationLabel = 'Site Ayarları (Hızlı)';

    public ?array $data = [];

    protected function isTranslatableSetting(Setting $setting): bool
    {
        return $setting->group === 'seo' || 
               $setting->group === 'homepage' || 
               $setting->group === 'our_story' || 
               $setting->group === 'social' || 
               in_array($setting->key, ['site_name', 'address', 'footer_text']);
    }

    public function mount(): void
    {
        $settings = Setting::all();
        $this->data = [];

        foreach ($settings as $setting) {
            /** @var Setting $setting */
            if ($this->isTranslatableSetting($setting)) {
                $this->data[$setting->key] = $setting->getTranslations('value');
            } else {
                // For global settings, we take the TR translation as the single truth
                // or fall back to whatever is there.
                $this->data[$setting->key] = $setting->getTranslation('value', 'tr') ?: $setting->value;
            }
        }

        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        $settings = Setting::all();
        $groups = [
            'general' => 'Genel',
            'branding' => 'Marka',
            'contact' => 'İletişim',
            'social' => 'Sosyal Medya',
            'seo' => 'SEO',
            'homepage' => 'Anasayfa',
            'our_story' => 'Hakkımızda',
        ];

        $tabs = [];

        foreach ($groups as $groupKey => $groupLabel) {
            $groupSettings = $settings->where('group', $groupKey);
            if ($groupSettings->isEmpty()) continue;

            $fields = [];
            foreach ($groupSettings as $setting) {
                /** @var Setting $setting */
                $fields[] = $this->getSettingField($setting);
            }

            $tabs[] = Tabs\Tab::make($groupLabel)
                ->schema($fields);
        }

        return $form
            ->schema([
                Tabs::make('Ayarlar')
                    ->tabs($tabs)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getSettingField(Setting $setting)
    {
        $label = str_replace('_', ' ', ucfirst($setting->key));
        
        // Manual labels for better UX
        $labels = [
            'site_name' => 'Site Adı',
            'address' => 'Adres',
            'phone' => 'Telefon',
            'email' => 'E-posta',
            'whatsapp' => 'WhatsApp Numarası',
            'facebook_url' => 'Facebook Linki',
            'instagram_url' => 'Instagram Linki',
            'google_reviews_url' => 'Google Yorumları Linki',
            'tripadvisor_reviews_url' => 'TripAdvisor Yorumları Linki',
            'logo' => 'Logo',
            'logo_white' => 'Logo (Beyaz)',
            'favicon' => 'Favicon',
            'meta_title' => 'Meta Başlık (Genel)',
            'meta_description' => 'Meta Açıklama (Genel)',
            'footer_text' => 'Alt Bilgi (Footer) Metni',
            'our_story_hero_image' => 'Hikayemiz - Kapak Görseli',
            'our_story_hero_title' => 'Hikayemiz - Ana Başlık',
            'our_story_hero_subtitle' => 'Hikayemiz - Alt Başlık',
            'our_story_roots_title' => 'Bölüm 1 - Başlık (Köklerimiz)',
            'our_story_roots_content' => 'Bölüm 1 - İçerik',
            'our_story_roots_image' => 'Bölüm 1 - Görsel',
            'our_story_sea_title' => 'Bölüm 2 - Başlık (Deniz)',
            'our_story_sea_content' => 'Bölüm 2 - İçerik',
            'our_story_sea_image' => 'Bölüm 2 - Görsel',
            'our_story_flame_title' => 'Bölüm 3 - Başlık (Ateş)',
            'our_story_flame_content' => 'Bölüm 3 - İçerik',
            'our_story_flame_image' => 'Bölüm 3 - Görsel',
            'our_story_gathering_title' => 'Bölüm 4 - Başlık (Sofra)',
            'our_story_gathering_content' => 'Bölüm 4 - İçerik',
            'our_story_gathering_image' => 'Bölüm 4 - Görsel',
            'our_story_conclusion_title' => 'Kapanış - Başlık',
            'our_story_conclusion_content' => 'Kapanış - İçerik',
            'our_story_discover_menu_text' => 'Buton Metni (Menü Keşfet)',
        ];

        $displayLabel = $labels[$setting->key] ?? $label;

        // Logic for translatable vs global
        $isTranslatable = $this->isTranslatableSetting($setting);

        if ($isTranslatable) {
            return Grid::make()
                ->columns(['default' => 2])
                ->label($displayLabel)
                ->schema([
                    $this->createBaseField($setting, 'tr', $displayLabel . ' (TR)'),
                    $this->createBaseField($setting, 'en', $displayLabel . ' (EN)'),
                ]);
        }

        return $this->createBaseField($setting, null, $displayLabel);
    }

    protected function createBaseField(Setting $setting, ?string $lang, string $label)
    {
        $key = $setting->key . ($lang ? ".{$lang}" : "");
        
        return match ($setting->type) {
            'image' => FileUpload::make($key)
                ->label($label)
                ->image()
                ->disk('public')
                ->directory('settings')
                ->preserveFilenames(),
            'images' => FileUpload::make($key)
                ->label($label)
                ->image()
                ->multiple()
                ->reorderable()
                ->disk('public')
                ->directory('settings')
                ->preserveFilenames(),
            'color' => ColorPicker::make($key)
                ->label($label),
            'boolean' => Select::make($key)
                ->label($label)
                ->options([
                    '1' => 'Evet',
                    '0' => 'Hayır',
                ]),
            default => TextInput::make($key)
                ->label($label),
        };
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Değişiklikleri Kaydet')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting) continue;

            $processValue = function($val, $oldVal) use ($setting) {
                if (($setting->type === 'image' || $setting->type === 'images') && !empty($val) && $val !== ($oldVal ?: '')) {
                    return \App\Services\ImageService::process($val, 'settings');
                }
                return $val;
            };

            if ($this->isTranslatableSetting($setting)) {
                // If it's translatable, the value is an array ['tr' => ..., 'en' => ...]
                if (is_array($value)) {
                    $oldTranslations = $setting->getTranslations('value');
                    foreach ($value as $lang => $val) {
                        $processedVal = $processValue($val, $oldTranslations[$lang] ?? null);
                        $setting->setTranslation('value', $lang, $processedVal);
                    }
                }
            } else {
                // If it's global, we save it for both locales to satisfy Spatie
                $oldVal = $setting->getTranslation('value', 'tr');
                $processedVal = $processValue($value, $oldVal);
                $setting->setTranslation('value', 'tr', $processedVal);
                $setting->setTranslation('value', 'en', $processedVal);
            }
            
            $setting->save();
        }

        Notification::make()
            ->title('Ayarlar başarıyla güncellendi.')
            ->success()
            ->send();
    }
}
