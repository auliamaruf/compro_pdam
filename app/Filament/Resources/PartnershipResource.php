<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipResource\Pages;
use App\Filament\Resources\PartnershipResource\RelationManagers;
use App\Models\Partnership;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PartnershipResource extends Resource
{
    protected static ?string $model = Partnership::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    
    protected static ?string $navigationLabel = 'Kemitraan';
    
    protected static ?string $modelLabel = 'Kemitraan';
    
    protected static ?string $pluralModelLabel = 'Kemitraan';
    
    protected static ?string $navigationGroup = 'Profil Perusahaan';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kemitraan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Partner')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, Forms\Set $set) => 
                                $context === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Partnership::class, 'slug', ignoreRecord: true)
                            ->rules(['alpha_dash']),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->maxLength(500),

                        Forms\Components\TextInput::make('website_url')
                            ->label('Website URL')
                            ->url()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Logo Partner')
                    ->schema([
                        Forms\Components\Select::make('logo_type')
                            ->label('Sumber Logo')
                            ->options([
                                'upload' => 'Upload File',
                                'url' => 'URL Link'
                            ])
                            ->default('upload')
                            ->live()
                            ->required()
                            ->helperText('Pilih apakah logo akan diupload atau menggunakan URL dari internet'),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                            ->label('Upload Logo')
                            ->collection('logo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '3:2',
                                '4:3',
                                '16:9',
                            ])
                            ->maxSize(2048)
                            ->helperText('Upload logo partner. Ukuran maksimal 2MB. Format: JPG, PNG, SVG.')
                            ->visible(fn (Forms\Get $get): bool => $get('logo_type') === 'upload')
                            ->required(fn (Forms\Get $get): bool => $get('logo_type') === 'upload'),

                        Forms\Components\TextInput::make('logo_url')
                            ->label('URL Logo')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Masukkan URL logo dari internet (pastikan dapat diakses publik)')
                            ->placeholder('https://example.com/logo.png')
                            ->visible(fn (Forms\Get $get): bool => $get('logo_type') === 'url')
                            ->required(fn (Forms\Get $get): bool => $get('logo_type') === 'url'),

                        Forms\Components\Placeholder::make('logo_preview')
                            ->label('Preview Logo')
                            ->content(function (Forms\Get $get) {
                                $logoUrl = $get('logo_url');
                                if ($logoUrl && $get('logo_type') === 'url') {
                                    return new \Illuminate\Support\HtmlString(
                                        '<img src="' . $logoUrl . '" alt="Logo Preview" class="max-w-32 max-h-20 object-contain border rounded" onerror="this.style.display=\'none\'">'
                                    );
                                }
                                return 'Preview akan muncul setelah memasukkan URL yang valid';
                            })
                            ->visible(fn (Forms\Get $get): bool => $get('logo_type') === 'url'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_display')
                    ->label('Logo')
                    ->getStateUsing(function ($record) {
                        if ($record->logo_type === 'url' && $record->logo_url) {
                            return $record->logo_url;
                        }
                        return $record->getFirstMediaUrl('logo', 'thumb') ?: null;
                    })
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(asset('images/default-logo.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Partner')
                    ->weight('bold')
                    ->description(fn ($record) => $record->description ? \Illuminate\Support\Str::limit($record->description, 60) : 'Tidak ada deskripsi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('logo_type')
                    ->label('Logo & Website')
                    ->formatStateUsing(function ($record) {
                        $logoType = match ($record->logo_type) {
                            'upload' => '📁 Upload',
                            'url' => '🔗 URL',
                            default => '📁 Upload'
                        };
                        $website = $record->website_url ? parse_url($record->website_url, PHP_URL_HOST) : 'Tidak ada';
                        return $logoType . ' • ' . $website;
                    })
                    ->description(fn ($record) => $record->website_url ? 'Klik untuk membuka website' : null)
                    ->url(fn ($record) => $record->website_url)
                    ->openUrlInNewTab(),

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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
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
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
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
            'index' => Pages\ListPartnerships::route('/'),
            'create' => Pages\CreatePartnership::route('/create'),
            'edit' => Pages\EditPartnership::route('/{record}/edit'),
        ];
    }
}
