# RENCANA IMPLEMENTASI ACTIVITY LOG PLUGIN
## Tanggal: 19 Juli 2025

### REKOMENDASI: RMSRAMOS/ACTIVITYLOG

## 🎯 MENGAPA RMSRAMOS/ACTIVITYLOG?

### Kelebihan untuk PDAM:
1. **UI Komprehensif** - Resource lengkap dengan timeline view
2. **Multi-language** - Support Bahasa Indonesia
3. **Professional Features** - Timeline, relationship manager, authorization
4. **Audit Ready** - Siap untuk compliance dan reporting
5. **Future-Proof** - Mendukung pengembangan report system

## 📋 RENCANA IMPLEMENTASI

### FASE 1: INSTALASI & SETUP DASAR (1 Minggu)

#### Step 1: Install Plugin
```bash
# Spatie Activity Log sudah terinstall, tinggal install plugin UI
composer require rmsramos/activitylog
php artisan activitylog:install
```

#### Step 2: Update AdminPanelProvider
```php
// app/Providers/Filament/AdminPanelProvider.php
use Rmsramos\Activitylog\ActivitylogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ActivitylogPlugin::make()
                ->label('Log Aktivitas')
                ->pluralLabel('Log Aktivitas')
                ->navigationGroup('Sistem')
                ->navigationIcon('heroicon-o-shield-check')
                ->navigationSort(10)
                ->authorize(fn() => auth()->user()->id === 1) // Sementara admin only
        ]);
}
```

#### Step 3: Enable Activity Logging pada Models
```php
// Update models yang perlu tracking:
// app/Models/CompanySetting.php
// app/Models/News.php  
// app/Models/Service.php
// app/Models/OnlineComplaint.php
// app/Models/ContactMessage.php

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class News extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Berita {$eventName}")
            ->useLogName('content_management');
    }
}
```

### FASE 2: RELATIONSHIP MANAGERS (1 Minggu)

#### Step 4: Add Activity Relationship ke Resources
```php
// app/Filament/Resources/NewsResource.php
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

public static function getRelations(): array
{
    return [
        ActivitylogRelationManager::class,
    ];
}
```

#### Step 5: Timeline Actions
```php
// Add timeline actions ke table resources
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;

public static function table(Table $table): Table
{
    return $table
        ->actions([
            ActivityLogTimelineTableAction::make('Activities')
                ->timelineIcons([
                    'created' => 'heroicon-m-plus',
                    'updated' => 'heroicon-m-pencil-square',
                    'deleted' => 'heroicon-m-trash',
                ])
                ->timelineIconColors([
                    'created' => 'success',
                    'updated' => 'warning', 
                    'deleted' => 'danger',
                ])
                ->limit(20),
        ]);
}
```

### FASE 3: KUSTOMISASI UNTUK PDAM (1 Minggu)

#### Step 6: Indonesian Language
```php
// Publish language files dan translate
php artisan vendor:publish --tag="activitylog-lang"

// resources/lang/id/activitylog.php
return [
    'created' => 'dibuat',
    'updated' => 'diperbarui', 
    'deleted' => 'dihapus',
    'restored' => 'dipulihkan',
    // dst...
];
```

#### Step 7: Custom Activity Descriptions
```php
// app/Models/OnlineComplaint.php
public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->setDescriptionForEvent(function(string $eventName) {
            return match($eventName) {
                'created' => "Pengaduan baru diterima: {$this->subject}",
                'updated' => "Status pengaduan diperbarui: {$this->subject}",
                'deleted' => "Pengaduan dihapus: {$this->subject}",
                default => "Pengaduan {$eventName}: {$this->subject}"
            };
        })
        ->useLogName('customer_service');
}
```

### FASE 4: ADVANCED FEATURES (1-2 Minggu)

#### Step 8: Log Categories
```php
// Kategorisasi logs untuk PDAM
- 'content_management' (News, Services, Company Settings)
- 'customer_service' (Complaints, Contact Messages)  
- 'administration' (User management, System settings)
- 'maintenance' (System maintenance activities)
```

#### Step 9: Custom Dashboard Widget
```php
// app/Filament/Widgets/ActivityOverview.php
class ActivityOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Aktivitas Hari Ini', Activity::whereDate('created_at', today())->count()),
            Stat::make('Content Updates', Activity::where('log_name', 'content_management')->whereDate('created_at', today())->count()),
            Stat::make('Customer Service', Activity::where('log_name', 'customer_service')->whereDate('created_at', today())->count()),
        ];
    }
}
```

## 🔧 KONFIGURASI LENGKAP

### Complete Plugin Configuration:
```php
ActivitylogPlugin::make()
    ->label('Log Aktivitas')
    ->pluralLabel('Log Aktivitas') 
    ->navigationGroup('Sistem')
    ->navigationIcon('heroicon-o-shield-check')
    ->navigationSort(10)
    ->navigationCountBadge(true)
    ->authorize(fn() => auth()->check()) // Semua admin bisa lihat
    ->translateSubject(fn($label) => __('models.' . $label))
    ->dateFormat('d/m/Y')
    ->datetimeFormat('d/m/Y H:i:s')
    ->isRestoreActionHidden(false) // Show restore for soft deletes
    ->isResourceActionHidden(false) // Show view action
    ->resourceActionLabel('Lihat Detail')
```

## 📊 MANFAAT UNTUK PDAM

### Immediate Benefits:
- ✅ **Audit Trail** - Track semua perubahan data
- ✅ **User Accountability** - Tahu siapa melakukan apa
- ✅ **Transparency** - Timeline view untuk management
- ✅ **Security** - Monitor aktivitas mencurigakan

### Long-term Benefits:
- ✅ **Compliance Ready** - Siap untuk audit eksternal
- ✅ **Report Foundation** - Basis untuk activity reports
- ✅ **Performance Insights** - Analisis pola penggunaan
- ✅ **Training Data** - Identifikasi training needs

## 🚀 NEXT STEPS

1. **Review & Approve** - Management review plan ini
2. **Schedule Implementation** - Set timeline untuk implementasi
3. **Backup Database** - Ensure data safety sebelum install
4. **Test in Staging** - Test semua fitur sebelum production
5. **User Training** - Train admin users tentang activity log

## 💰 ESTIMASI BIAYA

- **Development Time:** 3-4 minggu
- **Testing:** 1 minggu  
- **Training:** 0.5 minggu
- **Total:** 4.5 minggu development effort

**ROI:** Sangat tinggi untuk audit compliance dan operational transparency
