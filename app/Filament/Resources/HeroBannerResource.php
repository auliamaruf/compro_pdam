<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Hero Banner';

    protected static ?string $modelLabel = 'Hero Banner';

    protected static ?string $pluralModelLabel = 'Hero Banner';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Hero Banner')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Utama')
                            ->required()
                            ->placeholder('Judul hero banner')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->placeholder('Subtitle hero banner')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->placeholder('Deskripsi lengkap hero banner'),
                    ])->columns(1),

                Section::make('Tampilan Visual')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('background_image')
                            ->label('Background Image')
                            ->collection('hero_backgrounds')
                            ->image()
                            ->imageEditor()
                            ->maxSize(5120)
                            ->helperText('Gambar background untuk hero banner'),
                        Forms\Components\ColorPicker::make('overlay_color')
                            ->label('Warna Overlay')
                            ->default('#1e3a8a')
                            ->helperText('Warna overlay di atas background'),
                        Forms\Components\TextInput::make('overlay_opacity')
                            ->label('Transparansi Overlay')
                            ->numeric()
                            ->default(80)
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),
                        Forms\Components\Select::make('text_position')
                            ->label('Posisi Teks')
                            ->options([
                                'left' => 'Kiri',
                                'center' => 'Tengah',
                                'right' => 'Kanan'
                            ])
                            ->default('left'),
                    ])->columns(2),

                Section::make('Call to Action (CTA)')
                    ->schema([
                        Forms\Components\TextInput::make('primary_cta_text')
                            ->label('Teks Tombol Utama')
                            ->placeholder('Lihat Layanan'),
                        Forms\Components\TextInput::make('primary_cta_link')
                            ->label('Link Tombol Utama')
                            ->placeholder('/layanan'),
                        Forms\Components\TextInput::make('secondary_cta_text')
                            ->label('Teks Tombol Kedua')
                            ->placeholder('Kontak Kami'),
                        Forms\Components\TextInput::make('secondary_cta_link')
                            ->label('Link Tombol Kedua')
                            ->placeholder('/kontak'),
                    ])->columns(2),

                Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan (semakin kecil semakin di atas)'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Tampilkan hero banner ini')
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('background_image')
                    ->label('Background')
                    ->collection('hero_backgrounds')
                    ->size(80),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->weight('bold')
                    ->description(fn ($record) => $record->subtitle ?: 'Tidak ada subtitle')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('text_position')
                    ->label('Posisi & CTA')
                    ->formatStateUsing(function ($record) {
                        $position = match ($record->text_position) {
                            'left' => '⬅️ Kiri',
                            'center' => '⬆️ Tengah',
                            'right' => '➡️ Kanan',
                            default => '⬅️ Kiri'
                        };
                        $ctaCount = 0;
                        if ($record->primary_cta_text) $ctaCount++;
                        if ($record->secondary_cta_text) $ctaCount++;
                        return $position . ' • ' . $ctaCount . ' tombol';
                    })
                    ->description(fn ($record) => $record->primary_cta_text ? 'CTA: ' . $record->primary_cta_text : 'Tidak ada CTA'),

                Tables\Columns\TextColumn::make('overlay_color')
                    ->label('Overlay')
                    ->formatStateUsing(function ($record) {
                        $opacity = $record->overlay_opacity ?? 80;
                        return '🎨 ' . ($record->overlay_color ?? '#1e3a8a') . ' • ' . $opacity . '%';
                    })
                    ->description('Warna dan transparansi overlay'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->alignCenter()
                    ->description('Urutan tampil')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                // Toggleable columns (hidden by default)
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('text_position')
                    ->label('Posisi Teks')
                    ->options([
                        'left' => 'Kiri',
                        'center' => 'Tengah',
                        'right' => 'Kanan'
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroBanners::route('/'),
            'create' => Pages\CreateHeroBanner::route('/create'),
            'edit' => Pages\EditHeroBanner::route('/{record}/edit'),
        ];
    }
}
