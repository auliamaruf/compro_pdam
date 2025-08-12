<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FixedCostResource\Pages;
use App\Filament\Resources\FixedCostResource\RelationManagers;
use App\Models\FixedCost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FixedCostResource extends Resource
{
    protected static ?string $model = FixedCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    
    protected static ?string $navigationLabel = 'Biaya Tetap';
    
    protected static ?string $modelLabel = 'Biaya Tetap';
    
    protected static ?string $pluralModelLabel = 'Biaya Tetap';
    
    protected static ?string $navigationGroup = 'Tarif & Biaya';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kategori')
                    ->schema([
                        Forms\Components\TextInput::make('category_name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Rumah Tangga, Komersial, Industri'),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->maxLength(65535)
                            ->placeholder('Deskripsi detail kategori pelanggan'),

                        Forms\Components\Textarea::make('legal_basis')
                            ->label('Dasar Hukum')
                            ->rows(3)
                            ->maxLength(65535)
                            ->placeholder('Contoh: SK Direktur PDAM Kabupaten Purbalingga no.695.1/45.289/PDAM/XI/2010'),
                        
                        Forms\Components\Select::make('connection_type')
                            ->label('Jenis Sambungan')
                            ->options([
                                'new' => 'Sambungan Baru',
                                'upgrade' => 'Upgrade',
                                'replacement' => 'Penggantian',
                            ])
                            ->default('new')
                            ->required(),
                            
                        Forms\Components\TextInput::make('meter_size')
                            ->label('Ukuran Meter')
                            ->placeholder('Contoh: 1/2 inch, 3/4 inch, 1 inch')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Biaya & Tarif')
                    ->schema([
                        Forms\Components\TextInput::make('monthly_cost')
                            ->label('Biaya Tetap Bulanan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\TextInput::make('installation_cost')
                            ->label('Biaya Layanan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\TextInput::make('security_deposit')
                            ->label('Uang Jaminan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\TextInput::make('minimum_usage')
                            ->label('Pemakaian Minimum')
                            ->numeric()
                            ->suffix('m³')
                            ->default(0)
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Status & Tanggal')
                    ->schema([
                        Forms\Components\DatePicker::make('effective_date')
                            ->label('Tanggal Berlaku')
                            ->required()
                            ->default(now()),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                        
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(3)
                            ->maxLength(65535)
                            ->placeholder('Catatan tambahan mengenai biaya tetap ini'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_name')
                    ->label('Kategori')
                    ->weight('bold')
                    ->description(fn ($record) => $record->description ? \Illuminate\Support\Str::limit($record->description, 60) : 'Tidak ada deskripsi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('connection_type')
                    ->label('Jenis & Meter')
                    ->formatStateUsing(function ($record) {
                        $type = match ($record->connection_type) {
                            'new' => '🆕 Baru',
                            'upgrade' => '⬆️ Upgrade',
                            'replacement' => '🔄 Ganti',
                            default => $record->connection_type
                        };
                        $meter = $record->meter_size ? ' • ' . $record->meter_size : '';
                        return $type . $meter;
                    })
                    ->description(fn ($record) => $record->minimum_usage ? 'Min: ' . $record->minimum_usage . ' m³' : 'Tidak ada minimum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'success',
                        'upgrade' => 'warning',
                        'replacement' => 'info',
                        default => 'gray'
                    }),

                Tables\Columns\TextColumn::make('monthly_cost')
                    ->label('Biaya')
                    ->formatStateUsing(function ($record) {
                        $monthly = 'Bulanan: Rp' . number_format($record->monthly_cost, 0, ',', '.');
                        $install = $record->installation_cost ? ' • Layanan: Rp' . number_format($record->installation_cost, 0, ',', '.') : '';
                        return $monthly . $install;
                    })
                    ->description(fn ($record) => $record->security_deposit ? 'Jaminan: Rp' . number_format($record->security_deposit, 0, ',', '.') : 'Tidak ada jaminan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('effective_date')
                    ->label('Berlaku')
                    ->date('d M Y')
                    ->description('Tanggal efektif')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                // Toggleable columns (hidden by default)
                Tables\Columns\TextColumn::make('legal_basis')
                    ->label('Dasar Hukum')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('connection_type')
                    ->label('Jenis Sambungan')
                    ->options([
                        'new' => 'Sambungan Baru',
                        'upgrade' => 'Upgrade',
                        'replacement' => 'Penggantian',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('category_name');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListFixedCosts::route('/'),
            'create' => Pages\CreateFixedCost::route('/create'),
            'edit' => Pages\EditFixedCost::route('/{record}/edit'),
        ];
    }
}
