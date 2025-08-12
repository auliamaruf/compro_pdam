<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySettingResource\Pages;
use App\Models\CompanySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CompanySettingResource extends Resource
{
    protected static ?string $model = CompanySetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationLabel = 'Pengaturan Perusahaan';
    
    protected static ?string $modelLabel = 'Pengaturan Perusahaan';
    
    protected static ?string $pluralModelLabel = 'Pengaturan Perusahaan';
    
    protected static ?string $navigationGroup = 'Pengaturan';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        // Tab 1: Identitas Perusahaan
                        Tabs\Tab::make('Identitas Perusahaan')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Section::make('Informasi Dasar')
                                    ->schema([
                                        Forms\Components\TextInput::make('company_name')
                                            ->label('Nama Perusahaan')
                                            ->required()
                                            ->default('PDAM Tirta Perwira')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('company_tagline')
                                            ->label('Tagline Perusahaan')
                                            ->maxLength(255)
                                            ->placeholder('Air Bersih Untuk Kehidupan Yang Lebih Baik'),
                                        Forms\Components\RichEditor::make('company_description')
                                            ->label('Deskripsi Perusahaan')
                                            ->columnSpanFull()
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'link'
                                            ]),
                                    ])->columns(2),
                                    
                                Section::make('Visi & Misi')
                                    ->schema([
                                        Forms\Components\Textarea::make('vision')
                                            ->label('Visi')
                                            ->rows(3)
                                            ->placeholder('Visi perusahaan...'),
                                        Forms\Components\Textarea::make('vision_description')
                                            ->label('Deskripsi Visi')
                                            ->rows(3),
                                        Forms\Components\Textarea::make('mission')
                                            ->label('Misi Utama')
                                            ->rows(3),
                                        Forms\Components\Repeater::make('mission_points')
                                            ->label('Poin-Poin Misi')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Misi')
                                                    ->required()
                                                    ->placeholder('Contoh: Penyediaan Air Berkualitas'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi Misi')
                                                    ->rows(2)
                                                    ->required()
                                                    ->placeholder('Contoh: Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional...')
                                            ])
                                            ->columnSpanFull()
                                            ->defaultItems(0)
                                            ->addActionLabel('Tambah Poin Misi')
                                            ->collapsible()
                                    ])->columns(2),
                            ]),
                            
                        // Tab 2: Kontak & Media
                        Tabs\Tab::make('Kontak & Media')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('Informasi Kontak')
                                    ->schema([
                                        Forms\Components\TextInput::make('phone')
                                            ->label('Nomor Telepon')
                                            ->tel()
                                            ->placeholder('0281-123456'),
                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->placeholder('info@pdamtirtaperwira.com'),
                                        Forms\Components\TextInput::make('whatsapp_cs')
                                            ->label('WhatsApp Customer Service')
                                            ->placeholder('628123456789'),
                                        Forms\Components\Textarea::make('address')
                                            ->label('Alamat')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])->columns(3),
                                    
                                Section::make('Jam Operasional')
                                    ->schema([
                                        Forms\Components\KeyValue::make('office_hours')
                                            ->label('Jam Operasional')
                                            ->keyLabel('Hari')
                                            ->valueLabel('Jam')
                                            ->default([
                                                'senin_kamis' => '07:00 - 16:00',
                                                'jumat' => '07:00 - 11:30',
                                                'sabtu_minggu' => 'Tutup'
                                            ])
                                    ]),
                                    
                                Section::make('Media')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('logo')
                                            ->label('Logo Perusahaan')
                                            ->collection('logo')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(2048),
                                        SpatieMediaLibraryFileUpload::make('logo_white')
                                            ->label('Logo Putih (untuk background gelap)')
                                            ->collection('logo_white')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(2048),
                                        SpatieMediaLibraryFileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->collection('favicon')
                                            ->image()
                                            ->acceptedFileTypes(['image/x-icon', 'image/png'])
                                            ->maxSize(512),
                                        SpatieMediaLibraryFileUpload::make('about_image')
                                            ->label('Foto Kantor/Tentang Kami')
                                            ->collection('about_image')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(5120)
                                            ->helperText('Foto yang akan ditampilkan di halaman beranda section "Tentang Kami" dan halaman tentang. Maksimal 5MB.')
                                            ->columnSpanFull(),
                                        SpatieMediaLibraryFileUpload::make('vision_image')
                                            ->label('Foto Visi & Misi')
                                            ->collection('vision_image')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(5120)
                                            ->helperText('Foto yang akan ditampilkan di halaman visi & misi. Maksimal 5MB.')
                                            ->columnSpanFull(),
                                    ])->columns(3),
                            ]),
                            
                        // Tab 3: Statistik & Data
                        Tabs\Tab::make('Statistik & Data')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Statistik Perusahaan')
                                    ->schema([
                                        Forms\Components\TextInput::make('years_experience')
                                            ->label('Tahun Pengalaman')
                                            ->numeric()
                                            ->suffix('tahun'),
                                        Forms\Components\TextInput::make('customers_served')
                                            ->label('Jumlah Pelanggan')
                                            ->numeric()
                                            ->suffix('pelanggan'),
                                        Forms\Components\TextInput::make('water_quality_percentage')
                                            ->label('Persentase Kualitas Air')
                                            ->numeric()
                                            ->suffix('%')
                                            ->step(0.1)
                                            ->minValue(0)
                                            ->maxValue(100),
                                        Forms\Components\TextInput::make('service_availability')
                                            ->label('Ketersediaan Layanan')
                                            ->numeric()
                                            ->suffix('%')
                                            ->step(0.1)
                                            ->minValue(0)
                                            ->maxValue(100),
                                    ])->columns(2),
                                    
                                Section::make('Nilai-Nilai Perusahaan')
                                    ->schema([
                                        Forms\Components\Repeater::make('core_values')
                                            ->label('Core Values')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Nilai')
                                                    ->required()
                                                    ->placeholder('Contoh: PEDULI'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->rows(2)
                                                    ->required()
                                                    ->placeholder('Contoh: Mengutamakan kepentingan masyarakat dan lingkungan...'),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon HTML')
                                                    ->placeholder('<i class="fas fa-heart"></i>')
                                                    ->helperText('HTML untuk icon Font Awesome atau SVG')
                                            ])
                                            ->columnSpanFull()
                                            ->defaultItems(0)
                                            ->addActionLabel('Tambah Nilai')
                                            ->collapsible()
                                    ])
                            ]),
                            
                        // Tab 4: Media Sosial
                        Tabs\Tab::make('Media Sosial')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Section::make('Social Media Links')
                                    ->schema([
                                        Forms\Components\TextInput::make('social_media.facebook')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.facebook_username')
                                            ->label('Facebook Username')
                                            ->placeholder('@pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.instagram')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.instagram_username')
                                            ->label('Instagram Username')
                                            ->placeholder('@pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.youtube')
                                            ->label('YouTube URL')
                                            ->url()
                                            ->placeholder('https://youtube.com/@pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.youtube_username')
                                            ->label('YouTube Channel Name')
                                            ->placeholder('PDAM Tirta Perwira Official'),
                                        Forms\Components\TextInput::make('social_media.twitter')
                                            ->label('Twitter URL')
                                            ->url()
                                            ->placeholder('https://twitter.com/pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.twitter_username')
                                            ->label('Twitter Username')
                                            ->placeholder('@pdamtirtaperwira'),
                                        Forms\Components\TextInput::make('social_media.whatsapp')
                                            ->label('WhatsApp URL')
                                            ->url()
                                            ->placeholder('https://wa.me/6281234567890')
                                    ])->columns(2)
                            ]),
                            
                        // Tab 5: Home Page Content
                        Tabs\Tab::make('Konten Home Page')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('About Preview Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_preview_title')
                                            ->label('Judul About Preview')
                                            ->placeholder('PDAM Tirta Perwira Purbalingga'),
                                        Forms\Components\Textarea::make('about_preview_description')
                                            ->label('Deskripsi Singkat')
                                            ->rows(2)
                                            ->placeholder('Deskripsi singkat untuk section about di home'),
                                        Forms\Components\RichEditor::make('about_preview_content')
                                            ->label('Konten About Preview')
                                            ->columnSpanFull()
                                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                                            ->placeholder('Konten lengkap untuk ditampilkan di section about preview'),
                                    ])->columns(2),
                                    
                                Section::make('Key Features')
                                    ->schema([
                                        Forms\Components\Repeater::make('key_features')
                                            ->label('Fitur Utama')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Fitur')
                                                    ->required()
                                                    ->placeholder('Air Berkualitas Tinggi'),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon CSS Class')
                                                    ->placeholder('w-5 h-5 text-blue-600')
                                                    ->helperText('CSS class untuk icon SVG'),
                                                Forms\Components\ColorPicker::make('bg_color')
                                                    ->label('Background Color')
                                                    ->helperText('Warna background untuk fitur'),
                                                Forms\Components\ColorPicker::make('icon_color')
                                                    ->label('Icon Color')
                                                    ->helperText('Warna icon untuk fitur'),
                                            ])
                                            ->columnSpanFull()
                                            ->defaultItems(0)
                                            ->addActionLabel('Tambah Fitur')
                                            ->collapsible()
                                    ]),
                                    
                                Section::make('Quick Services')
                                    ->schema([
                                        Forms\Components\Repeater::make('quick_services')
                                            ->label('Layanan Cepat')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Layanan')
                                                    ->required()
                                                    ->placeholder('Cek Tagihan'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->rows(2)
                                                    ->placeholder('Cek tagihan air bulanan Anda secara online'),
                                                Forms\Components\TextInput::make('url')
                                                    ->label('URL Link')
                                                    ->url()
                                                    ->placeholder('https://tagihan.pdampurbalingga.co.id/'),
                                                Forms\Components\ColorPicker::make('bg_color')
                                                    ->label('Background Color Icon')
                                                    ->helperText('Warna background icon'),
                                                Forms\Components\ColorPicker::make('hover_color')
                                                    ->label('Hover Color')
                                                    ->helperText('Warna untuk efek hover'),
                                                Forms\Components\Checkbox::make('external_link')
                                                    ->label('Link Eksternal')
                                                    ->helperText('Centang jika link menuju website eksternal'),
                                            ])
                                            ->columnSpanFull()
                                            ->defaultItems(0)
                                            ->addActionLabel('Tambah Layanan Cepat')
                                            ->collapsible()
                                    ]),
                                    
                                Section::make('Section Titles & Descriptions')
                                    ->schema([
                                        Forms\Components\TextInput::make('stats_section_title')
                                            ->label('Judul Section Statistik')
                                            ->placeholder('Prestasi Kami'),
                                        Forms\Components\Textarea::make('stats_section_description')
                                            ->label('Deskripsi Section Statistik')
                                            ->rows(2),
                                        Forms\Components\TextInput::make('services_section_title')
                                            ->label('Judul Section Layanan')
                                            ->placeholder('Layanan Utama'),
                                        Forms\Components\Textarea::make('services_section_description')
                                            ->label('Deskripsi Section Layanan')
                                            ->rows(2),
                                        Forms\Components\TextInput::make('news_section_title')
                                            ->label('Judul Section Berita')
                                            ->placeholder('Berita Terkini'),
                                        Forms\Components\Textarea::make('news_section_description')
                                            ->label('Deskripsi Section Berita')
                                            ->rows(2),
                                    ])->columns(2),
                              
                            ]),
                            
                        // Tab 6: Status
                        Tabs\Tab::make('Status')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make('Pengaturan')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true)
                                            ->helperText('Hanya satu pengaturan perusahaan yang dapat aktif pada satu waktu')
                                    ])
                            ])
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Nama Perusahaan')
                    ->weight('bold')
                    ->description(fn ($record) => $record->company_tagline ?: 'Tidak ada tagline')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Kontak')
                    ->formatStateUsing(function ($record) {
                        $contact = [];
                        if ($record->phone) $contact[] = '📞 ' . $record->phone;
                        if ($record->email) $contact[] = '✉️ ' . $record->email;
                        return implode(' • ', $contact);
                    })
                    ->description(fn ($record) => $record->address ? \Illuminate\Support\Str::limit($record->address, 60) : 'Alamat belum diatur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('vision')
                    ->label('Visi & Misi')
                    ->formatStateUsing(function ($record) {
                        $info = [];
                        if ($record->vision) $info[] = '✨ Visi';
                        if ($record->mission) $info[] = '🎯 Misi';
                        if (is_array($record->mission_points) && count($record->mission_points) > 0) {
                            $info[] = count($record->mission_points) . ' poin misi';
                        }
                        return count($info) > 0 ? implode(' • ', $info) : 'Belum diatur';
                    })
                    ->description('Data visi dan misi perusahaan'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                // Toggleable columns (hidden by default)
                Tables\Columns\TextColumn::make('facebook_url')
                    ->label('Media Sosial')
                    ->formatStateUsing(function ($record) {
                        $social = [];
                        if ($record->facebook_url) $social[] = 'Facebook';
                        if ($record->instagram_url) $social[] = 'Instagram';
                        if ($record->twitter_url) $social[] = 'Twitter';
                        if ($record->youtube_url) $social[] = 'YouTube';
                        if ($record->linkedin_url) $social[] = 'LinkedIn';
                        return count($social) > 0 ? implode(', ', $social) : 'Tidak ada';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('is_active', 'desc');
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
            'index' => Pages\ListCompanySettings::route('/'),
            'create' => Pages\CreateCompanySetting::route('/create'),
            'edit' => Pages\EditCompanySetting::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }
    
    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('is_active', true)->count() > 0 ? 'warning' : 'success' ;
    }
}
