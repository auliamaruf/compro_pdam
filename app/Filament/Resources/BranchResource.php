<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use App\Models\OrganizationStructure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Profil Perusahaan';
    protected static ?string $navigationLabel = 'Cabang';
    protected static ?string $modelLabel = 'Cabang';
    protected static ?string $pluralModelLabel = 'Cabang';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Cabang')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Cabang/Unit')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('branch_type')
                                    ->label('Tipe')
                                    ->options([
                                        'cabang' => 'Cabang',
                                        'unit_ikk' => 'Unit IKK',
                                    ])
                                    ->required()
                                    ->default('cabang')
                                    ->reactive(),
                                Forms\Components\TextInput::make('code')
                                    ->label('Kode')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('CBG-001 atau IKK-001')
                                    ->maxLength(50),
                            ]),
                        
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->label('Telepon')
                                    ->tel()
                                    ->placeholder('contoh: (0281) 123456'),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->placeholder('contoh: cabang@tirtaperwira.com'),
                            ]),
                    ]),

                Forms\Components\Section::make('Kepala Cabang/Unit')
                    ->schema([
                        Forms\Components\Select::make('head_of_branch_id')
                            ->label(fn (callable $get) => $get('branch_type') === 'unit_ikk' ? 'Kepala Unit IKK' : 'Kepala Cabang')
                            ->options(function (callable $get) {
                                $branchType = $get('branch_type') ?? 'cabang';
                                if ($branchType === 'unit_ikk') {
                                    return OrganizationStructure::where('title', 'like', '%Kepala Unit IKK%')
                                        ->active()
                                        ->pluck('name', 'id');
                                } else {
                                    return OrganizationStructure::where('title', 'like', '%Kepala Cabang%')
                                        ->active()
                                        ->pluck('name', 'id');
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Lokasi')
                    ->schema([
                        Forms\Components\TextInput::make('google_maps_url')
                            ->label('URL Google Maps')
                            ->url()
                            ->placeholder('https://goo.gl/maps/...')
                            ->helperText('Masukkan URL Google Maps lokasi cabang'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Operasional')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('office_hours_weekday')
                                    ->label('Senin - Kamis')
                                    ->placeholder('07:30 - 15:00')
                                    ->helperText('Format: 07:30 - 15:00'),
                                Forms\Components\TextInput::make('office_hours_friday')
                                    ->label('Jumat')
                                    ->placeholder('07:30 - 11:00')
                                    ->helperText('Format: 07:30 - 11:00'),
                                Forms\Components\TextInput::make('office_hours_saturday')
                                    ->label('Sabtu')
                                    ->placeholder('07:30 - 13:00')
                                    ->helperText('Format: 07:30 - 13:00'),
                                Forms\Components\TextInput::make('office_hours_sunday')
                                    ->label('Minggu')
                                    ->placeholder('Tutup')
                                    ->helperText('Format: 08:00 - 12:00 atau "Tutup"'),
                            ]),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Cabang')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Layanan & Cakupan')
                    ->schema([
                        Forms\Components\TagsInput::make('services')
                            ->label('Layanan yang Tersedia')
                            ->placeholder('Tambahkan layanan...')
                            ->columnSpanFull(),
                            
                        Forms\Components\TagsInput::make('coverage_areas')
                            ->label('Area Cakupan Layanan')
                            ->placeholder('Tambahkan area...')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan Tampilan')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\BadgeColumn::make('branch_type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'cabang',
                        'success' => 'unit_ikk',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cabang' => 'Cabang',
                        'unit_ikk' => 'Unit IKK',
                        default => $state,
                    }),
                    
                Tables\Columns\TextColumn::make('headOfBranch.name')
                    ->label('Kepala')
                    ->sortable()
                    ->placeholder('Belum ditentukan'),
                    
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->address;
                    }),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('branch_type')
                    ->label('Tipe')
                    ->options([
                        'cabang' => 'Cabang',
                        'unit_ikk' => 'Unit IKK',
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
