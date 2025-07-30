<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationStructureResource\Pages;
use App\Filament\Resources\OrganizationStructureResource\RelationManagers;
use App\Models\OrganizationStructure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationStructureResource extends Resource
{
    protected static ?string $model = OrganizationStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Struktur Organisasi';

    protected static ?string $modelLabel = 'Struktur Organisasi';

    protected static ?string $pluralModelLabel = 'Struktur Organisasi';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Posisi')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Jabatan')
                            ->required()
                            ->placeholder('Direktur Utama, Kabag Umum, dll')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pejabat')
                            ->required()
                            ->placeholder('Nama lengkap pejabat')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle/Divisi')
                            ->placeholder('CEO, General Manager, dll')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Tanggung jawab dan deskripsi jabatan')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Hierarki & Tampilan')
                    ->schema([
                        Forms\Components\Select::make('level')
                            ->label('Level Hierarki')
                            ->required()
                            ->options([
                                1 => 'Level 1 - Direktur Utama',
                                2 => 'Level 2 - Direktur Umum',
                                3 => 'Level 3 - Kepala Bagian',
                                4 => 'Level 4 - Kepala Cabang',
                                5 => 'Level 5 - Kepala Sub Bagian (Umum)',
                                6 => 'Level 6 - Kepala Sub Bagian (Teknik)',
                                7 => 'Level 7 - Kepala Sub Bagian (Hublang)',
                                8 => 'Level 8 - Kepala Sub Bagian (Keuangan)',
                            ])
                            ->default(1),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan dalam level yang sama'),
                        Forms\Components\Textarea::make('icon')
                            ->label('Icon SVG')
                            ->placeholder('Paste SVG icon code disini')
                            ->rows(4)
                            ->helperText('Icon SVG untuk ditampilkan di struktur organisasi'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Tampilkan dalam struktur organisasi'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pejabat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('level')
                    ->label('Level')
                    ->colors([
                        'danger' => 1,
                        'warning' => 2,
                        'success' => 3,
                        'primary' => 4,
                        'secondary' => 5,
                    ])
                    ->formatStateUsing(fn (string $state): string => "Level $state")
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->label('Level')
                    ->options([
                        1 => 'Level 1 - Direktur Utama',
                        2 => 'Level 2 - Direktur/Manager',
                        3 => 'Level 3 - Kepala Bagian',
                        4 => 'Level 4 - Kepala Sub Bagian',
                        5 => 'Level 5 - Staff/Pelaksana',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('level', 'asc')
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
            'index' => Pages\ListOrganizationStructures::route('/'),
            'create' => Pages\CreateOrganizationStructure::route('/create'),
            'edit' => Pages\EditOrganizationStructure::route('/{record}/edit'),
        ];
    }
}
