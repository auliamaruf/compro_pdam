<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationMenuResource\Pages;
use App\Models\NavigationMenu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NavigationMenuResource extends Resource
{
    protected static ?string $model = NavigationMenu::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationLabel = 'Menu Navigasi';
    protected static ?string $pluralLabel = 'Menu Navigasi';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make('Informasi Menu')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Menu')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL/Link')
                                    ->required()
                                    ->placeholder('/layanan atau https://example.com')
                                    ->helperText('Gunakan / untuk halaman internal atau URL lengkap untuk eksternal'),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->placeholder('Deskripsi singkat untuk tooltip atau sub-menu')
                                    ->rows(2),

                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon (Heroicon)')
                                    ->placeholder('heroicon-o-home')
                                    ->helperText('Opsional. Gunakan nama icon dari Heroicons'),
                            ]),

                        Forms\Components\Section::make('Pengaturan')
                            ->schema([
                                Forms\Components\Select::make('position')
                                    ->label('Posisi Menu')
                                    ->options([
                                        'main' => 'Menu Utama (Header)',
                                        'footer' => 'Menu Footer',
                                        'sidebar' => 'Menu Sidebar'
                                    ])
                                    ->required()
                                    ->default('main'),

                                Forms\Components\Select::make('parent_id')
                                    ->label('Menu Induk')
                                    ->relationship('parent', 'title')
                                    ->placeholder('Pilih jika ini adalah sub-menu')
                                    ->helperText('Kosongkan untuk menu utama'),

                                Forms\Components\Select::make('target')
                                    ->label('Target Link')
                                    ->options([
                                        '_self' => 'Halaman yang sama',
                                        '_blank' => 'Tab/Window baru'
                                    ])
                                    ->required()
                                    ->default('_self'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Angka untuk mengurutkan menu (0 = paling atas)'),

                                Forms\Components\Toggle::make('is_external')
                                    ->label('Link Eksternal')
                                    ->helperText('Centang jika URL mengarah ke website lain'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true)
                                    ->helperText('Menu akan ditampilkan di website'),
                            ]),
                    ]),
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

                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->limit(50)
                    ->copyable(),

                Tables\Columns\BadgeColumn::make('position')
                    ->label('Posisi')
                    ->colors([
                        'primary' => 'main',
                        'success' => 'footer',
                        'warning' => 'sidebar',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'main' => 'Menu Utama',
                        'footer' => 'Footer',
                        'sidebar' => 'Sidebar',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Menu Induk')
                    ->placeholder('Menu Utama')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_external')
                    ->label('Eksternal')
                    ->boolean()
                    ->tooltip('Link eksternal'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Posisi')
                    ->options([
                        'main' => 'Menu Utama',
                        'footer' => 'Footer',
                        'sidebar' => 'Sidebar'
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\TernaryFilter::make('is_external')
                    ->label('Link Eksternal'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNavigationMenus::route('/'),
            'create' => Pages\CreateNavigationMenu::route('/create'),
            'edit' => Pages\EditNavigationMenu::route('/{record}/edit'),
        ];
    }
}
