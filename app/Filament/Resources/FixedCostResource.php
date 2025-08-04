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
                            ->label('Biaya Pemasangan')
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
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('connection_type')
                    ->label('Jenis Sambungan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'success',
                        'upgrade' => 'warning',
                        'replacement' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Sambungan Baru',
                        'upgrade' => 'Upgrade',
                        'replacement' => 'Penggantian',
                    }),
                
                Tables\Columns\TextColumn::make('monthly_cost')
                    ->label('Biaya Bulanan')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('installation_cost')
                    ->label('Biaya Pemasangan')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('security_deposit')
                    ->label('Jaminan')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('minimum_usage')
                    ->label('Min. Pemakaian')
                    ->suffix(' m³')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('meter_size')
                    ->label('Ukuran Meter')
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('effective_date')
                    ->label('Berlaku')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
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
