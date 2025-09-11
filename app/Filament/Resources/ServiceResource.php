<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Layanan PDAM';
    protected static ?string $pluralLabel = 'Layanan PDAM';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('Informasi Layanan')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Layanan')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $context, $state, Forms\Set $set) {
                                        if ($context === 'create') {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->required()
                                    ->unique(Service::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->rows(3),

                                Forms\Components\RichEditor::make('procedure')
                                    ->label('Prosedur Layanan')
                                    ->columnSpanFull(),

                                Forms\Components\Repeater::make('requirements')
                                    ->label('Persyaratan')
                                    ->schema([
                                        Forms\Components\TextInput::make('requirement')
                                            ->label('Persyaratan')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Forms\Components\Section::make('Pengaturan Layanan')
                            ->schema([
                                Forms\Components\Select::make('category')
                                    ->label('Kategori')
                                    ->options([
                                        'new_connection' => 'Sambungan Baru',
                                        'customer_service' => 'Layanan Pelanggan',
                                        'technical' => 'Layanan Teknis',
                                        'billing' => 'Pembayaran',
                                        'other' => 'Lainnya'
                                    ])
                                    ->required(),

                                Forms\Components\TextInput::make('process_time')
                                    ->label('Waktu Proses')
                                    ->placeholder('3-5 hari kerja'),

                                Forms\Components\TextInput::make('fee')
                                    ->label('Biaya Layanan')
                                    ->numeric()
                                    ->prefix('Rp'),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_person')
                                            ->label('Penanggung Jawab'),

                                        Forms\Components\TextInput::make('contact_phone')
                                            ->label('No. Telepon')
                                            ->tel(),
                                    ]),

                                Forms\Components\FileUpload::make('icon')
                                    ->label('Icon Layanan')
                                    ->image()
                                    ->directory('services/icons'),

                                SpatieMediaLibraryFileUpload::make('service_images')
                                    ->label('Gambar Layanan')
                                    ->collection('icons')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->imageEditor()
                                    ->imageResizeMode('cover')
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('600'),
                            ])
                            ->columnSpan(1),
                    ]),

                Forms\Components\Section::make('Dokumen & Formulir')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('service_forms')
                                    ->label('Upload Formulir')
                                    ->collection('forms')
                                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                    ->multiple()
                                    ->reorderable()
                                    ->maxSize(5120) // 5MB max
                                    ->helperText('Upload formulir dalam format PDF, DOC, atau DOCX (maksimal 5MB per file)')
                                    ->columnSpan(1),

                                Forms\Components\Repeater::make('forms')
                                    ->label('Link Formulir Eksternal')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Nama Formulir'),
                                        Forms\Components\TextInput::make('url')
                                            ->label('Link URL')
                                            ->url()
                                            ->helperText('Link ke Google Drive, OneDrive, atau layanan cloud lainnya'),
                                        Forms\Components\TextInput::make('description')
                                            ->label('Deskripsi')
                                            ->placeholder('Format PDF • 250 KB'),
                                    ])
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->helperText('Opsional: tambahkan link formulir dari Google Drive atau layanan cloud lainnya jika tersedia')
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Pengaturan Tampilan')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Layanan Unggulan'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ]),
                    ])
                    ->collapsible(),

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
                                    ->placeholder('Kosongkan untuk menggunakan nama layanan')
                                    ->visible(fn (Forms\Get $get) => $get('show_in_navbar')),

                                Forms\Components\TextInput::make('navbar_icon')
                                    ->label('Icon Navbar (Class CSS)')
                                    ->placeholder('fas fa-wrench')
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->process_time ? "⏱️ {$record->process_time}" : 'Waktu proses tidak ditentukan'),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Kategori')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new_connection' => 'Sambungan Baru',
                        'customer_service' => 'Layanan Pelanggan',
                        'technical' => 'Layanan Teknis',
                        'billing' => 'Pembayaran',
                        'other' => 'Lainnya',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'new_connection',
                        'success' => 'customer_service',
                        'warning' => 'technical',
                        'danger' => 'billing',
                        'secondary' => 'other',
                    ]),

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

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('forms_count')
                    ->label('Formulir')
                    ->getStateUsing(function (Service $record) {
                        $uploadedForms = $record->getMedia('forms')->count();
                        $externalForms = is_array($record->forms) ? count($record->forms) : 0;
                        $total = $uploadedForms + $externalForms;
                        return $total > 0 ? "{$total} formulir" : 'Tidak ada';
                    })
                    ->badge()
                    ->color(fn (string $state): string => str_contains($state, 'Tidak ada') ? 'gray' : 'success'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'new_connection' => 'Sambungan Baru',
                        'customer_service' => 'Layanan Pelanggan',
                        'technical' => 'Layanan Teknis',
                        'billing' => 'Pembayaran',
                        'other' => 'Lainnya'
                    ]),

                Tables\Filters\TernaryFilter::make('show_in_navbar')
                    ->label('Tampil di Navbar'),

                Tables\Filters\TernaryFilter::make('is_navbar_featured')
                    ->label('Unggulan di Navbar'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Layanan Unggulan'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_navbar')
                    ->label('Toggle Navbar')
                    ->icon('heroicon-o-bars-3')
                    ->action(function (Service $record) {
                        $record->update(['show_in_navbar' => !$record->show_in_navbar]);
                    })
                    ->color(fn (Service $record) => $record->show_in_navbar ? 'danger' : 'success')
                    ->button(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
