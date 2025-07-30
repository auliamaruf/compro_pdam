<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Halaman Website';
    protected static ?string $pluralLabel = 'Halaman Website';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 3;
    // resource ini disembunyikan
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('Konten Halaman')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Halaman')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $context, $state, Forms\Set $set) {
                                        if ($context === 'create') {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL Halaman')
                                    ->required()
                                    ->prefix(url('/') . '/')
                                    ->unique(Page::class, 'slug', ignoreRecord: true)
                                    ->helperText('URL yang akan digunakan untuk mengakses halaman ini'),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan Halaman')
                                    ->rows(3)
                                    ->helperText('Deskripsi singkat halaman untuk SEO dan preview')
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Konten Halaman')
                                    ->required()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Forms\Components\Section::make('Pengaturan Halaman')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Gambar Unggulan')
                                    ->image()
                                    ->disk('public')
                                    ->directory('pages')
                                    ->imageEditor()
                                    ->helperText('Gambar yang akan ditampilkan di hero section halaman'),

                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Dipublikasi',
                                        'private' => 'Privat'
                                    ])
                                    ->required()
                                    ->default('draft'),

                                Forms\Components\Select::make('template')
                                    ->label('Template Halaman')
                                    ->options([
                                        'default' => 'Default',
                                        'about' => 'Tentang Kami',
                                        'contact' => 'Kontak',
                                        'services' => 'Layanan',
                                        'custom' => 'Custom'
                                    ])
                                    ->required()
                                    ->default('default')
                                    ->helperText('Layout yang akan digunakan untuk menampilkan halaman'),

                                Forms\Components\Toggle::make('show_in_menu')
                                    ->label('Tampilkan di Menu')
                                    ->helperText('Centang untuk menampilkan halaman ini di menu navigasi utama'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan Menu')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Angka untuk mengurutkan posisi di menu (0 = paling atas)'),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()),

                                Forms\Components\KeyValue::make('meta')
                                    ->label('Meta Data SEO')
                                    ->helperText('Data tambahan untuk SEO (meta keywords, custom meta tags, dll)')
                                    ->collapsed(),
                            ])
                            ->columnSpan(1),
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

                Tables\Columns\TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->prefix('/')
                    ->copyable()
                    ->copyMessage('URL berhasil disalin!')
                    ->copyMessageDuration(1500),

                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->circular()
                    ->defaultImageUrl(asset('images/placeholder.jpg')),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                        'warning' => 'private',
                    ]),

                Tables\Columns\TextColumn::make('template')
                    ->label('Template')
                    ->badge(),

                Tables\Columns\IconColumn::make('show_in_menu')
                    ->label('Di Menu')
                    ->boolean()
                    ->tooltip('Tampil di menu navigasi'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Dipublikasi')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasi',
                        'private' => 'Privat'
                    ]),

                Tables\Filters\SelectFilter::make('template')
                    ->label('Template')
                    ->options([
                        'default' => 'Default',
                        'about' => 'Tentang Kami',
                        'contact' => 'Kontak',
                        'services' => 'Layanan',
                        'custom' => 'Custom'
                    ]),

                Tables\Filters\TernaryFilter::make('show_in_menu')
                    ->label('Tampilkan di Menu'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Page $record): string => url('/' . $record->slug))
                    ->openUrlInNewTab(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
