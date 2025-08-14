<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyHistoryResource\Pages;
use App\Models\CompanySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyHistoryResource extends Resource
{
    protected static ?string $model = CompanySetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Profil Perusahaan';
    protected static ?string $navigationLabel = 'Sejarah Perusahaan';
    protected static ?string $modelLabel = 'Sejarah Perusahaan';
    protected static ?string $pluralModelLabel = 'Sejarah Perusahaan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sejarah Perusahaan')
                    ->schema([
                        Forms\Components\RichEditor::make('company_history')
                            ->label('Sejarah Perusahaan')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Timeline Sejarah')
                    ->schema([
                        Forms\Components\Repeater::make('history_timeline')
                            ->label('Timeline Sejarah')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('year')
                                            ->label('Tahun/Periode')
                                            ->placeholder('contoh: 1970, 1980-an, 2000-2005')
                                            ->required(),
                                        Forms\Components\Select::make('icon')
                                            ->label('Ikon Timeline')
                                            ->options([
                                                'fas fa-seedling' => 'Seedling (Awal Mula)',
                                                'fas fa-rocket' => 'Rocket (Peluncuran)',
                                                'fas fa-chart-line' => 'Chart Line (Pertumbuhan)',
                                                'fas fa-industry' => 'Industry (Industri)',
                                                'fas fa-globe' => 'Globe (Ekspansi)',
                                                'fas fa-award' => 'Award (Penghargaan)',
                                                'fas fa-star' => 'Star (Pencapaian)',
                                                'fas fa-lightbulb' => 'Lightbulb (Inovasi)',
                                                'fas fa-handshake' => 'Handshake (Kerjasama)',
                                                'fas fa-cog' => 'Cog (Modernisasi)',
                                            ])
                                            ->default('fas fa-calendar-alt'),
                                    ]),
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Era')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('image')
                                    ->label('Gambar Timeline')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('timeline-images')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Textarea::make('impact')
                                            ->label('Dampak (Opsional)')
                                            ->placeholder('Jelaskan dampak dari periode ini')
                                            ->rows(2),
                                        Forms\Components\Textarea::make('achievement')
                                            ->label('Pencapaian (Opsional)')
                                            ->placeholder('Pencapaian khusus di periode ini')
                                            ->rows(2),
                                    ]),
                            ])
                            ->columnSpanFull()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' - ' . ($state['title'] ?? 'Timeline'))
                            ->reorderable()
                            ->defaultItems(0),
                    ]),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\EditCompanyHistory::route('/'),
        ];
    }
}
