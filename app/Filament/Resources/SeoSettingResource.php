<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSettingResource\Pages;
use App\Filament\Resources\SeoSettingResource\RelationManagers;
use App\Models\SeoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    
    protected static ?string $navigationGroup = 'Pengaturan';
    
    protected static ?string $navigationLabel = 'Pengaturan SEO';
    
    protected static ?string $pluralLabel = 'Pengaturan SEO';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identifikasi Halaman')
                    ->schema([
                        Forms\Components\Select::make('page_type')
                            ->label('Tipe Halaman')
                            ->required()
                            ->options([
                                'home' => 'Halaman Beranda',
                                'news' => 'Halaman Berita',
                                'news_detail' => 'Detail Berita',
                                'service' => 'Halaman Layanan',
                                'service_detail' => 'Detail Layanan',
                                'page' => 'Halaman Statis',
                                'contact' => 'Halaman Kontak',
                                'complaint' => 'Halaman Pengaduan',
                                'tariff' => 'Halaman Tarif',
                                'about' => 'Tentang Kami',
                                'organization' => 'Struktur Organisasi',
                                'history' => 'Sejarah Perusahaan',
                            ])
                            ->native(false)
                            ->reactive(),
                            
                        Forms\Components\TextInput::make('page_identifier')
                            ->label('Identifier Halaman')
                            ->placeholder('slug atau ID spesifik (kosongkan untuk halaman umum)')
                            ->helperText('Untuk halaman spesifik seperti detail berita/layanan'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('SEO Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->required()
                            ->maxLength(60)
                            ->placeholder('Judul halaman untuk search engine')
                            ->helperText('Maksimal 60 karakter untuk optimal SEO')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $count = strlen($state ?? '');
                                $set('title_count', $count);
                            }),
                            
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->rows(3)
                            ->placeholder('Deskripsi halaman untuk search engine')
                            ->helperText('Maksimal 160 karakter untuk optimal SEO')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $count = strlen($state ?? '');
                                $set('description_count', $count);
                            }),
                            
                        Forms\Components\TagsInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('Kata kunci dipisahkan dengan enter')
                            ->helperText('Maksimal 10 kata kunci yang relevan'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Open Graph (Facebook/WhatsApp)')
                    ->schema([
                        Forms\Components\TextInput::make('og_title')
                            ->label('OG Title')
                            ->maxLength(60)
                            ->placeholder('Judul untuk share di Facebook/WhatsApp'),
                            
                        Forms\Components\Textarea::make('og_description')
                            ->label('OG Description')
                            ->maxLength(160)
                            ->rows(3)
                            ->placeholder('Deskripsi untuk share di Facebook/WhatsApp'),
                            
                        Forms\Components\FileUpload::make('og_image')
                            ->label('OG Image')
                            ->image()
                            ->disk('public')
                            ->directory('seo/og-images')
                            ->imageEditor()
                            ->helperText('Ukuran optimal: 1200x630px')
                            ->maxSize(2048),
                            
                        Forms\Components\Select::make('og_type')
                            ->label('OG Type')
                            ->options([
                                'website' => 'Website',
                                'article' => 'Article',
                                'profile' => 'Profile',
                                'product' => 'Product',
                            ])
                            ->default('website'),
                    ])
                    ->columns(2)
                    ->collapsible(),
                    
                Forms\Components\Section::make('Twitter Card')
                    ->schema([
                        Forms\Components\Select::make('twitter_card')
                            ->label('Twitter Card Type')
                            ->options([
                                'summary' => 'Summary',
                                'summary_large_image' => 'Summary Large Image',
                                'app' => 'App',
                                'player' => 'Player',
                            ])
                            ->default('summary_large_image'),
                            
                        Forms\Components\TextInput::make('twitter_title')
                            ->label('Twitter Title')
                            ->maxLength(60)
                            ->placeholder('Judul untuk share di Twitter'),
                            
                        Forms\Components\Textarea::make('twitter_description')
                            ->label('Twitter Description')
                            ->maxLength(160)
                            ->rows(3)
                            ->placeholder('Deskripsi untuk share di Twitter'),
                            
                        Forms\Components\FileUpload::make('twitter_image')
                            ->label('Twitter Image')
                            ->image()
                            ->disk('public')
                            ->directory('seo/twitter-images')
                            ->imageEditor()
                            ->helperText('Ukuran optimal: 1200x675px')
                            ->maxSize(2048),
                    ])
                    ->columns(2)
                    ->collapsible(),
                    
                Forms\Components\Section::make('Pengaturan Teknis')
                    ->schema([
                        Forms\Components\TextInput::make('canonical_url')
                            ->label('Canonical URL')
                            ->url()
                            ->placeholder('https://example.com/canonical-url')
                            ->helperText('URL kanonik untuk menghindari duplikasi konten'),
                            
                        Forms\Components\Select::make('robots')
                            ->label('Robots Meta Tag')
                            ->options([
                                'index,follow' => 'Index, Follow (Default)',
                                'noindex,follow' => 'No Index, Follow',
                                'index,nofollow' => 'Index, No Follow',
                                'noindex,nofollow' => 'No Index, No Follow',
                            ])
                            ->default('index,follow')
                            ->helperText('Instruksi untuk search engine crawler'),
                            
                        Forms\Components\KeyValue::make('schema_markup')
                            ->label('Schema Markup (JSON-LD)')
                            ->keyLabel('Property')
                            ->valueLabel('Value')
                            ->helperText('Data terstruktur untuk search engine')
                            ->columnSpanFull(),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Hanya setting SEO yang aktif yang akan digunakan'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_type')
                    ->label('Tipe Halaman')
                    ->weight('bold')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'home' => '🏠 Beranda',
                        'news' => '📰 Berita',
                        'news_detail' => '📝 Detail Berita',
                        'service' => '💼 Layanan',
                        'service_detail' => '🔧 Detail Layanan',
                        'page' => '📄 Halaman Statis',
                        'contact' => '📞 Kontak',
                        'complaint' => '📋 Pengaduan',
                        'tariff' => '💰 Tarif',
                        'about' => '👥 Tentang Kami',
                        'organization' => '🏢 Struktur Organisasi',
                        'history' => '📚 Sejarah',
                        default => $state
                    })
                    ->description(fn ($record) => $record->page_identifier ?: 'Pengaturan umum')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'home' => 'success',
                        'news', 'news_detail' => 'info',
                        'service', 'service_detail' => 'warning',
                        'page' => 'secondary',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('meta_title')
                    ->label('SEO Title & Description')
                    ->weight('medium')
                    ->description(fn ($record) => $record->meta_description ? \Illuminate\Support\Str::limit($record->meta_description, 80) : 'Tidak ada deskripsi')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('meta_keywords')
                    ->label('Keywords')
                    ->formatStateUsing(function ($record) {
                        if (is_array($record->meta_keywords)) {
                            $count = count($record->meta_keywords);
                            $first = $record->meta_keywords[0] ?? '';
                            return $count > 1 ? $first . ' (+' . ($count - 1) . ' lainnya)' : $first;
                        }
                        return 'Tidak ada';
                    })
                    ->description('Kata kunci SEO')
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                // Toggleable columns (hidden by default)
                Tables\Columns\ImageColumn::make('og_image')
                    ->label('OG Image')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(asset('images/placeholder-og.jpg'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('page_type')
                    ->label('Tipe Halaman')
                    ->options([
                        'home' => 'Beranda',
                        'news' => 'Berita',
                        'service' => 'Layanan',
                        'page' => 'Halaman Statis',
                        'contact' => 'Kontak',
                        'about' => 'Tentang Kami',
                    ]),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                    
                Tables\Filters\Filter::make('has_og_image')
                    ->label('Memiliki OG Image')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('og_image')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('preview_seo')
                    ->label('Preview SEO')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalContent(function ($record) {
                        return view('filament.seo-preview', ['record' => $record]);
                    })
                    ->modalWidth('2xl'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true])),
                        
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false])),
                        
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('page_type', 'asc');
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
            'index' => Pages\ListSeoSettings::route('/'),
            'create' => Pages\CreateSeoSetting::route('/create'),
            'edit' => Pages\EditSeoSetting::route('/{record}/edit'),
        ];
    }
}
