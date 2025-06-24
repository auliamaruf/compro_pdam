<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySettingResource\Pages;
use App\Models\CompanySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanySettingResource extends Resource
{
    protected static ?string $model = CompanySetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan Perusahaan';
    protected static ?string $pluralLabel = 'Pengaturan Perusahaan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('company_settings')
                    ->persistTabInQueryString()
                    ->tabs([
                        // TAB 1: INFORMASI DASAR
                        Forms\Components\Tabs\Tab::make('🏢 Informasi Dasar')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\Section::make('Identitas Perusahaan')
                                    ->description('Informasi dasar perusahaan yang akan tampil di seluruh website')
                                    ->schema([
                                        Forms\Components\TextInput::make('company_name')
                                            ->label('Nama Perusahaan')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('company_tagline')
                                            ->label('Tagline/Slogan')
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('address')
                                            ->label('Alamat Lengkap')
                                            ->rows(3),
                                    ]),

                                Forms\Components\Section::make('Kontak')
                                    ->description('Informasi kontak yang dapat dihubungi')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('phone')
                                                    ->label('Telepon')
                                                    ->tel()
                                                    ->maxLength(20),

                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email')
                                                    ->email()
                                                    ->maxLength(255),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('emergency_phone')
                                                    ->label('Telepon Darurat')
                                                    ->tel()
                                                    ->maxLength(20),

                                                Forms\Components\TextInput::make('whatsapp_cs')
                                                    ->label('WhatsApp Customer Service')
                                                    ->tel()
                                                    ->maxLength(20),
                                            ]),

                                        Forms\Components\TextInput::make('website')
                                            ->label('Website')
                                            ->url()
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Section::make('Jam Operasional & Media Sosial')
                                    ->schema([
                                        Forms\Components\KeyValue::make('office_hours')
                                            ->label('Jam Operasional')
                                            ->keyLabel('Hari')
                                            ->valueLabel('Jam')
                                            ->default([
                                                'senin_jumat' => '07:30 - 16:00 WIB',
                                                'sabtu' => '07:30 - 12:00 WIB',
                                                'minggu' => 'Tutup',
                                                'emergency' => '24 Jam'
                                            ]),

                                        Forms\Components\KeyValue::make('social_media')
                                            ->label('Tautan Media Sosial')
                                            ->keyLabel('Platform')
                                            ->valueLabel('URL')
                                            ->default([
                                                'facebook' => '',
                                                'instagram' => '',
                                                'twitter' => '',
                                                'youtube' => ''
                                            ]),
                                    ])
                                    ->collapsible(),
                            ]),

                        // TAB 2: BRANDING & VISUAL
                        Forms\Components\Tabs\Tab::make('🎨 Branding & Visual')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Logo & Assets')
                                    ->description('Upload logo dan visual branding perusahaan')
                                    ->schema([
                                        Forms\Components\FileUpload::make('logo')
                                            ->label('Logo Perusahaan')
                                            ->image()
                                            ->disk('public')
                                            ->directory('branding')
                                            ->imageEditor()
                                            ->imageResizeMode('contain')
                                            ->imageResizeTargetWidth('300')
                                            ->imageResizeTargetHeight('100')
                                            ->acceptedFileTypes(['image/png', 'image/svg+xml', 'image/jpeg'])
                                            ->helperText('Format: PNG/SVG/JPG. Ukuran optimal: 300x100px. Background transparan disarankan untuk PNG/SVG.')
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('logo_white')
                                            ->label('Logo Putih (untuk background gelap)')
                                            ->image()
                                            ->disk('public')
                                            ->directory('branding')
                                            ->imageEditor()
                                            ->imageResizeMode('contain')
                                            ->imageResizeTargetWidth('300')
                                            ->imageResizeTargetHeight('100')
                                            ->acceptedFileTypes(['image/png', 'image/svg+xml'])
                                            ->helperText('Opsional. Logo putih untuk digunakan pada background gelap. Format: PNG/SVG dengan background transparan.')
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->disk('public')
                                            ->directory('branding')
                                            ->imageEditor()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('1:1')
                                            ->imageResizeTargetWidth('512')
                                            ->imageResizeTargetHeight('512')
                                            ->acceptedFileTypes(['image/png', 'image/ico', 'image/svg+xml'])
                                            ->helperText('Format: PNG/ICO/SVG. Ukuran: 512x512px (rasio 1:1). File akan otomatis di-resize untuk berbagai ukuran favicon.')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Tema Warna')
                                    ->description('Pengaturan warna tema website')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\ColorPicker::make('primary_color')
                                                    ->label('Warna Utama Brand')
                                                    ->default('#2563eb')
                                                    ->helperText('Warna utama yang digunakan untuk branding'),

                                                Forms\Components\ColorPicker::make('secondary_color')
                                                    ->label('Warna Sekunder Brand')
                                                    ->default('#1e40af')
                                                    ->helperText('Warna sekunder untuk aksen'),

                                                Forms\Components\ColorPicker::make('accent_color')
                                                    ->label('Warna Aksen')
                                                    ->default('#10B981'),
                                            ]),

                                        Forms\Components\Textarea::make('brand_description')
                                            ->label('Deskripsi Brand')
                                            ->placeholder('Perumda Air Minum Tirta Perwira adalah perusahaan daerah yang bergerak di bidang penyediaan air bersih...')
                                            ->rows(3)
                                            ->helperText('Deskripsi singkat tentang perusahaan untuk meta description dan SEO'),
                                    ])
                                    ->collapsible(),
                            ]),

                        // TAB 3: HERO SECTION
                        Forms\Components\Tabs\Tab::make('🚀 Hero Section')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Forms\Components\Section::make('Hero Slides (Rekomendasi)')
                                    ->description('Hero section dengan multiple slides, gambar, dan custom links untuk experience yang lebih menarik')
                                    ->schema([
                                        Forms\Components\Repeater::make('hero_slides')
                                            ->label('Hero Slides')
                                            ->schema([
                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('title')
                                                            ->label('Judul')
                                                            ->placeholder('Melayani dengan Hati')
                                                            ->required()
                                                            ->maxLength(255),

                                                        Forms\Components\Toggle::make('is_active')
                                                            ->label('Aktif')
                                                            ->default(true),
                                                    ]),

                                                Forms\Components\Textarea::make('subtitle')
                                                    ->label('Subtitle')
                                                    ->placeholder('Memberikan yang terbaik untuk air bersih berkualitas...')
                                                    ->rows(2)
                                                    ->maxLength(500),

                                                Forms\Components\FileUpload::make('background_image')
                                                    ->label('Gambar Background')
                                                    ->image()
                                                    ->disk('public')
                                                    ->directory('hero-slides')
                                                    ->imageEditor()
                                                    ->imageResizeMode('cover')
                                                    ->imageCropAspectRatio('16:9')
                                                    ->imageResizeTargetWidth('1920')
                                                    ->imageResizeTargetHeight('1080')
                                                    ->helperText('Resolusi optimal: 1920x1080px, Ratio 16:9'),

                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('primary_cta_text')
                                                            ->label('Text Button Utama')
                                                            ->placeholder('Layanan Kami')
                                                            ->maxLength(50),

                                                        Forms\Components\TextInput::make('primary_cta_link')
                                                            ->label('Link Button Utama')
                                                            ->placeholder('/layanan atau https://example.com')
                                                            ->maxLength(255),
                                                    ]),

                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('secondary_cta_text')
                                                            ->label('Text Button Kedua')
                                                            ->placeholder('Cek Tagihan')
                                                            ->maxLength(50),

                                                        Forms\Components\TextInput::make('secondary_cta_link')
                                                            ->label('Link Button Kedua')
                                                            ->placeholder('/cek-tagihan')
                                                            ->maxLength(255),
                                                    ]),

                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        Forms\Components\Select::make('text_position')
                                                            ->label('Posisi Text')
                                                            ->options([
                                                                'left' => 'Kiri',
                                                                'center' => 'Tengah',
                                                                'right' => 'Kanan',
                                                            ])
                                                            ->default('left'),

                                                        Forms\Components\ColorPicker::make('overlay_color')
                                                            ->label('Warna Overlay')
                                                            ->default('#1e3a8a'),

                                                        Forms\Components\TextInput::make('overlay_opacity')
                                                            ->label('Opacity Overlay (%)')
                                                            ->numeric()
                                                            ->minValue(0)
                                                            ->maxValue(100)
                                                            ->default(80)
                                                            ->suffix('%')
                                                            ->helperText('Nilai antara 0-100'),
                                                    ]),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Hero Slide')
                                            ->addActionLabel('Tambah Slide')
                                            ->defaultItems(1),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Hero Section (Legacy)')
                                    ->description('Hero section sederhana (untuk kompatibilitas mundur)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title')
                                            ->label('Judul Hero Section')
                                            ->placeholder('Melayani dengan Hati')
                                            ->helperText('Gunakan \n untuk baris baru. Contoh: Melayani dengan\nHati')
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('hero_subtitle')
                                            ->label('Subtitle Hero Section')
                                            ->placeholder('Memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_cta_primary')
                                                    ->label('Text Button Utama')
                                                    ->placeholder('Layanan Kami')
                                                    ->maxLength(50),

                                                Forms\Components\TextInput::make('hero_cta_secondary')
                                                    ->label('Text Button Kedua')
                                                    ->placeholder('Cek Tagihan')
                                                    ->maxLength(50),
                                            ]),

                                        Forms\Components\Textarea::make('hero_description')
                                            ->label('Deskripsi Tambahan (Opsional)')
                                            ->placeholder('Deskripsi tambahan yang akan ditampilkan di hero section')
                                            ->rows(2)
                                            ->maxLength(300),
                                    ])
                                    ->collapsed(),
                            ]),

                        // TAB 4: PROFIL & KONTEN PERUSAHAAN (Menggabungkan beberapa tab)
                        Forms\Components\Tabs\Tab::make('📋 Profil & Konten')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Forms\Components\Section::make('Konten Homepage')
                                    ->description('Konten ringkas yang tampil di halaman utama')
                                    ->schema([
                                        Forms\Components\RichEditor::make('about_us')
                                            ->label('Tentang Kami (Ringkas)')
                                            ->columnSpanFull(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Textarea::make('vision')
                                                    ->label('Visi (Ringkas)')
                                                    ->rows(3),

                                                Forms\Components\Textarea::make('mission')
                                                    ->label('Misi (Ringkas)')
                                                    ->rows(4),
                                            ]),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Profil Detail')
                                    ->description('Konten detail untuk halaman profil')
                                    ->schema([
                                        Forms\Components\RichEditor::make('company_description')
                                            ->label('Deskripsi Perusahaan Detail')
                                            ->columnSpanFull(),

                                        Forms\Components\RichEditor::make('company_history')
                                            ->label('Sejarah Perusahaan')
                                            ->columnSpanFull(),

                                        Forms\Components\RichEditor::make('vision_description')
                                            ->label('Deskripsi Visi Detail')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Nilai-Nilai Perusahaan')
                                    ->schema([
                                        Forms\Components\Repeater::make('company_values')
                                            ->label('Nilai-nilai Perusahaan')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Nilai')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required(),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('core_values')
                                            ->label('Nilai-nilai Inti')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Nilai')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required(),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon (heroicon name)')
                                                    ->placeholder('heroicon-o-heart'),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('mission_points')
                                            ->label('Poin-poin Misi')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Misi')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required(),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),
                                    ])
                                    ->collapsible(),
                            ]),

                        // TAB 5: SEJARAH & ORGANISASI (Menggabungkan Timeline, Struktur Org, dll)
                        Forms\Components\Tabs\Tab::make('🏛️ Sejarah & Organisasi')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\Section::make('Timeline & Pencapaian')
                                    ->schema([
                                        Forms\Components\Repeater::make('history_timeline')
                                            ->label('Timeline Sejarah')
                                            ->schema([
                                                Forms\Components\TextInput::make('period')
                                                    ->label('Periode (contoh: 1970-an)')
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Era')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required(),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('milestones')
                                            ->label('Milestone Penting')
                                            ->schema([
                                                Forms\Components\TextInput::make('year')
                                                    ->label('Tahun')
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi'),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('achievements')
                                            ->label('Pencapaian Bersejarah')
                                            ->schema([
                                                Forms\Components\TextInput::make('metric')
                                                    ->label('Metrik (contoh: 50+)')
                                                    ->required(),
                                                Forms\Components\TextInput::make('label')
                                                    ->label('Label (contoh: Tahun Pengalaman)')
                                                    ->required(),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon (heroicon name)')
                                                    ->placeholder('heroicon-o-building-office'),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\RichEditor::make('legacy_description')
                                            ->label('Deskripsi Warisan untuk Masa Depan')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Struktur Organisasi')
                                    ->schema([
                                        Forms\Components\Repeater::make('organization_structure')
                                            ->label('Struktur Organisasi')
                                            ->schema([
                                                Forms\Components\TextInput::make('position')
                                                    ->label('Jabatan')
                                                    ->required(),
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama (opsional)'),
                                                Forms\Components\TextInput::make('level')
                                                    ->label('Level (1=tertinggi)')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('parent_id')
                                                    ->label('ID Atasan (opsional)')
                                                    ->numeric(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi Tugas'),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon (heroicon name)')
                                                    ->placeholder('heroicon-o-user'),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('leadership_team')
                                            ->label('Tim Kepemimpinan')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama')
                                                    ->required(),
                                                Forms\Components\TextInput::make('position')
                                                    ->label('Jabatan')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi/Bio'),
                                                Forms\Components\Repeater::make('qualifications')
                                                    ->label('Kualifikasi')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('qualification')
                                                            ->label('Kualifikasi')
                                                            ->required(),
                                                    ]),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('organizational_culture')
                                            ->label('Budaya Organisasi')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Budaya')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required(),
                                                Forms\Components\TextInput::make('icon')
                                                    ->label('Icon (heroicon name)')
                                                    ->placeholder('heroicon-o-star'),
                                            ])
                                            ->columnSpanFull()
                                            ->collapsible(),
                                    ])
                                    ->collapsible(),
                            ]),

                        // TAB 6: STATISTIK & METRIK
                        Forms\Components\Tabs\Tab::make('📊 Statistik & Metrik')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\Section::make('Metrik Perusahaan')
                                    ->description('Data dan statistik penting untuk ditampilkan di website')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('years_experience')
                                                    ->label('Tahun Pengalaman')
                                                    ->numeric()
                                                    ->placeholder('50'),

                                                Forms\Components\TextInput::make('customers_served')
                                                    ->label('Jumlah Pelanggan')
                                                    ->numeric()
                                                    ->placeholder('150000'),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('water_quality_percentage')
                                                    ->label('Persentase Kualitas Air')
                                                    ->numeric()
                                                    ->step(0.01)
                                                    ->placeholder('99.00'),

                                                Forms\Components\TextInput::make('service_availability')
                                                    ->label('Ketersediaan Layanan')
                                                    ->placeholder('24/7'),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Nama Perusahaan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanySettings::route('/'),
            'create' => Pages\CreateCompanySetting::route('/create'),
            'edit' => Pages\EditCompanySetting::route('/{record}/edit'),
        ];
    }
}
