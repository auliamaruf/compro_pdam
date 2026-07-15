<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerInfoResource\Pages;
use App\Filament\Resources\CustomerInfoResource\RelationManagers;
use App\Models\CustomerInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CustomerInfoResource extends Resource
{
    protected static ?string $model = CustomerInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Manajemen Informasi';
    protected static ?string $navigationLabel = 'Info Pelanggan';
    protected static ?string $pluralModelLabel = 'Info Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pelanggan')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'umum' => 'Informasi Umum',
                                'perbaikan' => 'Perbaikan / Pemeliharaan',
                                'gangguan' => 'Gangguan / Mati Air',
                                'promo' => 'Promo / Diskon',
                            ])
                            ->default('umum')
                            ->required()
                            ->live(),
                        Forms\Components\DateTimePicker::make('display_until')
                            ->label('Tayangkan Sampai (Opsional)')
                            ->helperText('Kosongkan jika ingin info terus tayang tanpa batas.'),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('published_date')
                            ->label('Tanggal Publikasi')
                            ->required()
                            ->default(now()),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\Fieldset::make('Detail Pengerjaan')
                            ->schema([
                                Forms\Components\DateTimePicker::make('repair_start')
                                    ->label('Waktu Mulai Pengerjaan'),
                                Forms\Components\DateTimePicker::make('repair_end')
                                    ->label('Waktu Selesai / Estimasi Selesai'),
                                Forms\Components\Textarea::make('affected_areas')
                                    ->label('Wilayah Terdampak')
                                    ->columnSpanFull(),
                            ])
                            ->visible(fn (Get $get) => in_array($get('category'), ['perbaikan', 'gangguan'])),
                        Forms\Components\Fieldset::make('Detail Promo')
                            ->schema([
                                Forms\Components\DatePicker::make('promo_start')
                                    ->label('Tanggal Mulai Promo'),
                                Forms\Components\DatePicker::make('promo_end')
                                    ->label('Tanggal Berakhir Promo'),
                            ])
                            ->visible(fn (Get $get) => $get('category') === 'promo'),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Gambar Utama (Otomatis WebP)')
                            ->collection('customer-info-images')
                            ->image()
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('category')
                    ->label('Kategori')
                    ->colors([
                        'primary' => 'umum',
                        'warning' => 'perbaikan',
                        'danger' => 'gangguan',
                        'success' => 'promo',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'umum' => 'Umum',
                        'perbaikan' => 'Perbaikan',
                        'gangguan' => 'Gangguan',
                        'promo' => 'Promo',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('display_until')
                    ->label('Selesai Tayang')
                    ->dateTime()
                    ->placeholder('Selamanya')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_date')
                    ->label('Tanggal Publikasi')
                    ->date()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCustomerInfos::route('/'),
            'create' => Pages\CreateCustomerInfo::route('/create'),
            'edit' => Pages\EditCustomerInfo::route('/{record}/edit'),
        ];
    }
}
