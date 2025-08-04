<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaterTariffResource\Pages;
use App\Filament\Resources\WaterTariffResource\RelationManagers;
use App\Models\WaterTariff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaterTariffResource extends Resource
{
    protected static ?string $model = WaterTariff::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Tarif & Biaya';
    protected static ?string $navigationLabel = 'Tarif Air';
    protected static ?string $pluralLabel = 'Tarif Air';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tarif')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('customer_type')
                                    ->label('Jenis Pelanggan')
                                    ->required()
                                    ->placeholder('Rumah Tangga, Usaha, Sosial, dll'),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(2),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('min_usage')
                                    ->label('Pemakaian Minimum (m³)')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\TextInput::make('max_usage')
                                    ->label('Pemakaian Maksimum (m³)')
                                    ->numeric()
                                    ->placeholder('Kosongkan jika unlimited'),

                                Forms\Components\TextInput::make('rate_per_m3')
                                    ->label('Tarif per m³')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('admin_fee')
                                    ->label('Biaya Admin')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),

                                Forms\Components\TextInput::make('maintenance_fee')
                                    ->label('Biaya Pemeliharaan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('effective_date')
                                    ->label('Berlaku Mulai')
                                    ->required()
                                    ->default(today()),

                                Forms\Components\DatePicker::make('expired_date')
                                    ->label('Berlaku Sampai')
                                    ->placeholder('Kosongkan jika tidak ada batas'),
                            ]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ]),
                    ]),

                Forms\Components\Section::make('Konfigurasi Navbar')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('show_in_navbar')
                                    ->label('Tampilkan di Navbar')
                                    ->live()
                                    ->default(false),

                                Forms\Components\Toggle::make('is_navbar_featured')
                                    ->label('Unggulan di Navbar')
                                    ->visible(fn (Forms\Get $get) => $get('show_in_navbar')),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('navbar_order')
                                    ->label('Urutan di Navbar')
                                    ->numeric()
                                    ->default(0)
                                    ->visible(fn (Forms\Get $get) => $get('show_in_navbar')),

                                Forms\Components\TextInput::make('navbar_label')
                                    ->label('Label Navbar (Opsional)')
                                    ->placeholder('Kosongkan untuk menggunakan label otomatis')
                                    ->visible(fn (Forms\Get $get) => $get('show_in_navbar')),

                                Forms\Components\TextInput::make('navbar_icon')
                                    ->label('Icon Navbar (Class CSS)')
                                    ->placeholder('fas fa-home')
                                    ->visible(fn (Forms\Get $get) => $get('show_in_navbar')),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_type')
                    ->label('Jenis Pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('min_usage')
                    ->label('Min (m³)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('max_usage')
                    ->label('Max (m³)')
                    ->placeholder('Unlimited')
                    ->sortable(),

                Tables\Columns\TextColumn::make('rate_per_m3')
                    ->label('Tarif/m³')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('admin_fee')
                    ->label('Biaya Admin')
                    ->money('IDR')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('show_in_navbar')
                    ->label('Di Navbar')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('navbar_order')
                    ->label('Urutan Navbar')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_navbar_featured')
                    ->label('Unggulan Navbar')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('effective_date')
                    ->label('Berlaku Mulai')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('customer_type')
                    ->label('Jenis Pelanggan')
                    ->options([
                        'Rumah Tangga' => 'Rumah Tangga',
                        'Komersial' => 'Komersial',
                        'Industri' => 'Industri',
                        'Sosial' => 'Sosial',
                        'Instansi' => 'Instansi'
                    ]),

                Tables\Filters\TernaryFilter::make('show_in_navbar')
                    ->label('Tampil di Navbar'),

                Tables\Filters\TernaryFilter::make('is_navbar_featured')
                    ->label('Unggulan di Navbar'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\Filter::make('current')
                    ->label('Tarif Berlaku')
                    ->query(fn (Builder $query): Builder => $query->current()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_navbar')
                    ->label('Toggle Navbar')
                    ->icon('heroicon-o-bars-3')
                    ->action(function (WaterTariff $record) {
                        $record->update(['show_in_navbar' => !$record->show_in_navbar]);
                    })
                    ->color(fn (WaterTariff $record) => $record->show_in_navbar ? 'danger' : 'success')
                    ->button(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('add_to_navbar')
                        ->label('Tampilkan di Navbar')
                        ->icon('heroicon-o-plus')
                        ->action(function ($records) {
                            $records->each->update(['show_in_navbar' => true]);
                        })
                        ->color('success'),
                    Tables\Actions\BulkAction::make('remove_from_navbar')
                        ->label('Hapus dari Navbar')
                        ->icon('heroicon-o-minus')
                        ->action(function ($records) {
                            $records->each->update(['show_in_navbar' => false]);
                        })
                        ->color('danger'),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('navbar_order')
            ->reorderable('navbar_order');
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
            'index' => Pages\ListWaterTariffs::route('/'),
            'create' => Pages\CreateWaterTariff::route('/create'),
            'edit' => Pages\EditWaterTariff::route('/{record}/edit'),
        ];
    }
}
