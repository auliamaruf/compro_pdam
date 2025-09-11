<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Berita & Pengumuman';
    protected static ?string $pluralLabel = 'Berita & Pengumuman';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('Konten Utama')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
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
                                    ->unique(News::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Konten')
                                    ->required()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h1',
                                        'h2',
                                        'h3',
                                        'h4',
                                        'h5',
                                        'h6',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'subscript',
                                        'superscript',
                                        'table',
                                        'underline',
                                        'undo',
                                    ])
                                    ->disableToolbarButtons([
                                        // Remove any buttons you don't want
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Forms\Components\Section::make('Pengaturan')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Kategori')
                                    ->options([
                                        'news' => 'Berita',
                                        'announcement' => 'Pengumuman',
                                        'emergency' => 'Darurat',
                                        'csr' => 'Program CSR'
                                    ])
                                    ->required()
                                    ->default('news'),

                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Dipublikasi',
                                        'archived' => 'Diarsipkan'
                                    ])
                                    ->required()
                                    ->default('draft'),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()),

                                Forms\Components\Select::make('author_id')
                                    ->label('Penulis')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->default(auth()->id()),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Artikel Unggulan'),

                                Forms\Components\Toggle::make('is_emergency')
                                    ->label('Pengumuman Darurat'),

                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->collection('featured_image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675'),

                                SpatieMediaLibraryFileUpload::make('gallery')
                                    ->label('Galeri Gambar')
                                    ->collection('gallery')
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

                // Tambahkan section untuk documents
                Forms\Components\Section::make('Dokumen & Lampiran')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('document_files')
                            ->label('Upload Dokumen')
                            ->collection('documents')
                            ->multiple()
                            ->reorderable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                'text/plain',
                                'image/jpeg',
                                'image/png',
                                'image/webp'
                            ])
                            ->maxSize(10240) // 10MB max per file
                            ->helperText('Upload dokumen pendukung seperti PDF, Word, Excel, PowerPoint, atau gambar. Maksimal 10MB per file.')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('document_links')
                            ->label('Link Dokumen External')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Dokumen')
                                    ->required()
                                    ->placeholder('Contoh: Peraturan Daerah No. 5 Tahun 2024'),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL Dokumen')
                                    ->url()
                                    ->required()
                                    ->placeholder('https://example.com/dokumen.pdf'),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->placeholder('Deskripsi singkat dokumen')
                                    ->rows(2),

                                Forms\Components\Hidden::make('type')
                                    ->default('url'),

                                Forms\Components\Hidden::make('created_at')
                                    ->default(fn() => now()->toISOString()),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Link Dokumen')
                            ->collapsible()
                            ->helperText('Tambahkan link ke dokumen yang tersimpan di website lain atau cloud storage.'),

                        Forms\Components\Toggle::make('has_documents')
                            ->label('Berita Memiliki Dokumen')
                            ->helperText('Centang jika berita ini memiliki dokumen lampiran yang relevan')
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                // Auto-set based on uploaded files or URLs
                                // This will be handled in the save process
                            }),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->collection('featured_image')
                    ->circular()
                    ->size(40),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->weight('bold')
                    ->description(function ($record) {
                        $desc = Str::limit($record->excerpt ?? '', 60);
                        
                        // Add document indicator
                        if ($record->hasDocuments()) {
                            $docsCount = $record->getMedia('documents')->count();
                            $urlsCount = $record->documents ? count($record->documents) : 0;
                            $totalDocs = $docsCount + $urlsCount;
                            $desc .= " • 📎 {$totalDocs} dokumen";
                        }
                        
                        return $desc;
                    }),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Kategori')
                    ->colors([
                        'primary' => 'news',
                        'warning' => 'announcement',
                        'danger' => 'emergency',
                        'success' => 'csr'
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'news' => 'Berita',
                        'announcement' => 'Pengumuman',
                        'emergency' => 'Darurat',
                        'csr' => 'Program CSR',
                        default => $state,
                    }),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                        'gray' => 'archived'
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('views')
                    ->label('Views')
                    ->sortable()
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Dipublikasi')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Kategori')
                    ->options([
                        'news' => 'Berita',
                        'announcement' => 'Pengumuman',
                        'emergency' => 'Darurat',
                        'csr' => 'Program CSR'
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasi',
                        'archived' => 'Diarsipkan'
                    ]),

                Tables\Filters\Filter::make('is_featured')
                    ->label('Artikel Unggulan')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
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
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNews::route('/'),
        ];
    }
}
