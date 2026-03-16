<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;

class SlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $modelLabel = 'Slayt';
    protected static ?string $pluralModelLabel = 'Slaytlar';
    protected static ?string $navigationGroup = 'Site Ayarları';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slayt Detayları')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->required(),
                        Forms\Components\TextInput::make('sub_title')
                            ->label('Alt Başlık'),
                        Forms\Components\Textarea::make('description')
                            ->label('Açıklama')
                            ->rows(3),
                    ]),
                Forms\Components\Section::make('Görsel & Durum')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Görsel')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/svg+xml'])
                            ->directory('slides')
                            ->required(),
                        Forms\Components\Grid::make()
                            ->columns(['sm' => 2])
                            ->schema([
                                Forms\Components\TextInput::make('order_column')
                                    ->label('Sıralama')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif mi')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Görsel'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_column')
                    ->label('Sıra')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('order_column')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
