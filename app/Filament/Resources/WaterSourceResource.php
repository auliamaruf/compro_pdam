<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaterSourceResource\Pages;
use App\Filament\Resources\WaterSourceResource\RelationManagers;
use App\Models\WaterSource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class WaterSourceResource extends Resource
{
    protected static ?string $model = WaterSource::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    
    protected static ?string $navigationLabel = 'Sumber Mata Air';
    
    protected static ?string $modelLabel = 'Sumber Mata Air';
    
    protected static ?string $pluralModelLabel = 'Sumber Mata Air';
    
    protected static ?string $navigationGroup = 'Profil Perusahaan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Sumber Air')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('production_capacity')
                            ->label('Kapasitas Produksi (L/detik)')
                            ->required()
                            ->numeric()
                            ->step(0.01)
                            ->suffix('L/detik'),
                            
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'maintenance' => 'Maintenance',
                            ])
                            ->default('active'),
                            
                        Forms\Components\Select::make('ownership')
                            ->label('Kepemilikan')
                            ->required()
                            ->options([
                                'milik_sendiri' => 'Milik Sendiri',
                                'sewa' => 'Sewa',
                                'kerjasama' => 'Kerjasama',
                            ])
                            ->default('milik_sendiri'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Detail Operasional')
                    ->schema([
                        Forms\Components\Textarea::make('distribution_area')
                            ->label('Wilayah Distribusi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Media & Pengaturan')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('water_source_images')
                            ->label('Foto Sumber Air')
                            ->collection('water_source_images')
                            ->image()
                            ->maxFiles(1)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull()
                            ->optimize('webp'),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil angka, semakin atas urutan tampil'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('water_source_images')
                    ->label('Foto')
                    ->collection('water_source_images')
                    ->width(80)
                    ->height(60)
                    ->circular(),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Sumber Air')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                    
                Tables\Columns\TextColumn::make('production_capacity')
                    ->label('Kapasitas')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(' L/detik')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'maintenance' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'maintenance' => 'Maintenance',
                        default => $state,
                    }),
                    
                Tables\Columns\TextColumn::make('ownership')
                    ->label('Kepemilikan')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'milik_sendiri' => 'Milik Sendiri',
                        'sewa' => 'Sewa',
                        'kerjasama' => 'Kerjasama',
                        default => $state,
                    }),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'maintenance' => 'Maintenance',
                    ]),
                    
                Tables\Filters\SelectFilter::make('ownership')
                    ->label('Kepemilikan')
                    ->options([
                        'milik_sendiri' => 'Milik Sendiri',
                        'sewa' => 'Sewa',
                        'kerjasama' => 'Kerjasama',
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
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListWaterSources::route('/'),
            'create' => Pages\CreateWaterSource::route('/create'),
            'edit' => Pages\EditWaterSource::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
