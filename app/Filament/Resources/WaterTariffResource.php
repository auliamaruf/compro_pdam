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
use Illuminate\Support\Str;

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
                                Forms\Components\Select::make('customer_type')
                                    ->label('Jenis Pelanggan')
                                    ->options([
                                        'Sosial' => 'Sosial',
                                        'Rumah Tangga' => 'Rumah Tangga',
                                        'Instansi' => 'Instansi',
                                        'TNI/Polri' => 'TNI/Polri',
                                        'Niaga' => 'Niaga',
                                        'Industri' => 'Industri',
                                    ])
                                    ->required()
                                    ->searchable(),

                                Forms\Components\Select::make('sub_category')
                                    ->label('Sub Kategori')
                                    ->options([
                                        // Sosial
                                        'SOSIAL UMUM (HU)' => 'Sosial Umum (HU)',
                                        'SOSIAL KHUSUS' => 'Sosial Khusus',
                                        // Rumah Tangga
                                        'RUMAH TANGGA KHUSUS' => 'Rumah Tangga Khusus',
                                        'RUMAH TANGGA A' => 'Rumah Tangga A',
                                        'RUMAH TANGGA B' => 'Rumah Tangga B',
                                        'RUMAH TANGGA C' => 'Rumah Tangga C',
                                        // Instansi
                                        'INSTANSI PEMERINTAH' => 'Instansi Pemerintah',
                                        // TNI/Polri
                                        'TNI/POLRI' => 'TNI/POLRI',
                                        // Niaga
                                        'NIAGA KECIL' => 'Niaga Kecil',
                                        'NIAGA BESAR' => 'Niaga Besar',
                                        // Industri
                                        'INDUSTRI KECIL' => 'Industri Kecil',
                                        'INDUSTRI BESAR' => 'Industri Besar',
                                    ])
                                    ->required()
                                    ->searchable(),
                            ]),

                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(2)
                                    ->placeholder('Deskripsi lengkap tarif ini'),

                                Forms\Components\Textarea::make('legal_basis')
                                    ->label('Dasar Hukum')
                                    ->rows(3)
                                    ->placeholder('Contoh: Peraturan Bupati Purbalingga No.62 Tahun 2011 tanggal 14 Juni 2011'),
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
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->sub_category),

                Tables\Columns\TextColumn::make('min_usage')
                    ->label('Min (m³)')
                    ->sortable()
                    ->description(fn ($record) => $record->max_usage ? "Max: {$record->max_usage} m³" : 'Unlimited'),

                Tables\Columns\TextColumn::make('rate_per_m3')
                    ->label('Tarif/m³')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                Tables\Columns\IconColumn::make('show_in_navbar')
                    ->label('Di Navbar')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\IconColumn::make('is_navbar_featured')
                    ->label('Featured')
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
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('admin_fee')
                    ->label('Biaya Admin')
                    ->money('IDR')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('navbar_order')
                    ->label('Urutan Navbar')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('customer_type')
                    ->label('Jenis Pelanggan')
                    ->options([
                        'Sosial' => 'Sosial',
                        'Rumah Tangga' => 'Rumah Tangga',
                        'Instansi' => 'Instansi',
                        'TNI/Polri' => 'TNI/Polri',
                        'Niaga' => 'Niaga',
                        'Industri' => 'Industri',
                    ]),

                Tables\Filters\SelectFilter::make('sub_category')
                    ->label('Sub Kategori')
                    ->options([
                        'SOSIAL UMUM (HU)' => 'Sosial Umum (HU)',
                        'SOSIAL KHUSUS' => 'Sosial Khusus',
                        'RUMAH TANGGA KHUSUS' => 'Rumah Tangga Khusus',
                        'RUMAH TANGGA A' => 'Rumah Tangga A',
                        'RUMAH TANGGA B' => 'Rumah Tangga B',
                        'RUMAH TANGGA C' => 'Rumah Tangga C',
                        'INSTANSI PEMERINTAH' => 'Instansi Pemerintah',
                        'TNI/POLRI' => 'TNI/POLRI',
                        'NIAGA KECIL' => 'Niaga Kecil',
                        'NIAGA BESAR' => 'Niaga Besar',
                        'INDUSTRI KECIL' => 'Industri Kecil',
                        'INDUSTRI BESAR' => 'Industri Besar',
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('toggle_navbar')
                        ->label('Toggle Navbar')
                        ->icon('heroicon-o-bars-3')
                        ->action(function (WaterTariff $record) {
                            $record->update(['show_in_navbar' => !$record->show_in_navbar]);
                        })
                        ->color(fn (WaterTariff $record) => $record->show_in_navbar ? 'danger' : 'success'),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->label('Aksi')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button()
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
