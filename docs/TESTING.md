# 🧪 Panduan Testing - PDAM Website

## 📋 Pendahuluan

Panduan komprehensif untuk testing aplikasi website PDAM Tirta Perwira Purbalingga yang dibangun dengan Laravel dan Filament. Dokumen ini mencakup strategi testing, implementasi test cases, dan best practices untuk memastikan kualitas aplikasi.

---

## 🏗️ Testing Architecture

### 📐 Testing Strategy

#### Testing Pyramid
```
    /\     E2E Tests (5%)
   /  \    Browser/Feature Tests
  /____\   Integration Tests (15%)
 /_____\   Unit Tests (80%)
```

#### Test Types Coverage
- **Unit Tests**: Model logic, services, utilities
- **Feature Tests**: HTTP endpoints, form submissions
- **Integration Tests**: Database interactions, external APIs
- **Browser Tests**: Full user workflows
- **Performance Tests**: Load testing, stress testing

### 🔧 Testing Tools Configuration

#### PHPUnit Configuration
```xml
<!-- phpunit.xml -->
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         processIsolation="false"
         stopOnFailure="false"
         executionOrder="random"
         resolveDependencies="true">
    <testsuites>
        <testsuite name="Unit">
            <directory suffix="Test.php">./tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory suffix="Test.php">./tests/Feature</directory>
        </testsuite>
        <testsuite name="Browser">
            <directory suffix="Test.php">./tests/Browser</directory>
        </testsuite>
    </testsuites>
    <coverage>
        <include>
            <directory suffix=".php">./app</directory>
        </include>
        <exclude>
            <directory>./app/Http/Middleware</directory>
            <file>./app/Http/Kernel.php</file>
        </exclude>
        <report>
            <html outputDirectory="tests/coverage"/>
        </report>
    </coverage>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        <env name="CACHE_DRIVER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
    </php>
</phpunit>
```

#### Laravel Dusk Configuration
```php
// tests/DuskTestCase.php
abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    public static function prepare()
    {
        if (! static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
            '--no-sandbox',
            '--disable-dev-shm-usage',
        ]);

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
```

---

## 🔬 Unit Testing

### 🏷️ Model Testing

#### User Model Test
```php
// tests/Unit/Models/UserTest.php
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user_with_valid_data()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@pdampurbalingga.co.id',
            'password' => Hash::make('password123')
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@pdampurbalingga.co.id', $user->email);
    }

    /** @test */
    public function it_hashes_password_when_creating_user()
    {
        $user = User::factory()->create([
            'password' => 'plaintext'
        ]);

        $this->assertTrue(Hash::check('plaintext', $user->password));
        $this->assertNotEquals('plaintext', $user->password);
    }

    /** @test */
    public function it_has_proper_role_permissions()
    {
        // Using Spatie Permission package
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $contentManagerRole = Role::create(['name' => 'content_manager']);
        $operatorRole = Role::create(['name' => 'operator']);
        $viewerRole = Role::create(['name' => 'viewer']);
        
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super_admin');
        
        $contentManager = User::factory()->create();
        $contentManager->assignRole('content_manager');
        
        $operator = User::factory()->create();
        $operator->assignRole('operator');
        
        $viewer = User::factory()->create();
        $viewer->assignRole('viewer');

        $this->assertTrue($superAdmin->hasRole('super_admin'));
        $this->assertTrue($contentManager->hasRole('content_manager'));
        $this->assertTrue($operator->hasRole('operator'));
        $this->assertTrue($viewer->hasRole('viewer'));
        
        // Test permissions
        $this->assertTrue($superAdmin->can('manage_users'));
        $this->assertTrue($superAdmin->can('manage_content'));
        
        $this->assertFalse($contentManager->can('manage_users'));
        $this->assertTrue($contentManager->can('manage_content'));
        
        $this->assertFalse($operator->can('manage_content'));
        $this->assertTrue($operator->can('view_content'));
        
        $this->assertFalse($viewer->can('manage_content'));
        $this->assertTrue($viewer->can('view_content'));
    }
}
```

#### News Model Test
```php
// tests/Unit/Models/NewsTest.php
class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_slug_automatically()
    {
        $news = News::create([
            'title' => 'Berita Terbaru PDAM Purbalingga',
            'content' => 'Content of the news article...',
            'author_id' => User::factory()->create()->id,
            'status' => 'published'
        ]);

        $this->assertEquals('berita-terbaru-pdam-purbalingga', $news->slug);
    }

    /** @test */
    public function it_can_have_featured_image()
    {
        $news = News::factory()->create();
        
        // Simulate media attachment
        $news->addMediaFromUrl('https://example.com/image.jpg')
              ->toMediaCollection('featured_image');

        $this->assertTrue($news->hasMedia('featured_image'));
        $this->assertNotNull($news->getFirstMediaUrl('featured_image'));
    }

    /** @test */
    public function it_filters_published_news_only()
    {
        News::factory()->create(['status' => 'published']);
        News::factory()->create(['status' => 'published']);
        News::factory()->create(['status' => 'draft']);

        $publishedNews = News::published()->get();

        $this->assertCount(2, $publishedNews);
        $this->assertTrue($publishedNews->every(fn($news) => $news->status === 'published'));
    }

    /** @test */
    public function it_orders_by_publish_date_desc()
    {
        $older = News::factory()->create(['published_at' => now()->subDays(2)]);
        $newer = News::factory()->create(['published_at' => now()->subDay()]);
        $newest = News::factory()->create(['published_at' => now()]);

        $orderedNews = News::latest('published_at')->get();

        $this->assertEquals($newest->id, $orderedNews->first()->id);
        $this->assertEquals($older->id, $orderedNews->last()->id);
    }
}
```

### 🛠️ Service Testing

#### File Security Service Test
```php
// tests/Unit/Services/FileSecurityServiceTest.php
class FileSecurityServiceTest extends TestCase
{
    private FileSecurityService $fileSecurityService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileSecurityService = new FileSecurityService();
    }

    /** @test */
    public function it_validates_allowed_file_types()
    {
        $allowedFile = UploadedFile::fake()->image('test.jpg', 800, 600);
        $errors = $this->fileSecurityService->validateFile($allowedFile);

        $this->assertEmpty($errors);
    }

    /** @test */
    public function it_rejects_forbidden_file_extensions()
    {
        $maliciousFile = UploadedFile::fake()->create('malicious.php', 100);
        $errors = $this->fileSecurityService->validateFile($maliciousFile);

        $this->assertContains('File extension not allowed.', $errors);
    }

    /** @test */
    public function it_detects_files_too_large()
    {
        // Create file larger than allowed size
        $largeFile = UploadedFile::fake()->create('large.jpg', 3000); // 3MB
        $errors = $this->fileSecurityService->validateFile($largeFile);

        $this->assertContains('File size exceeds maximum allowed.', $errors);
    }

    /** @test */
    public function it_detects_malicious_content_in_files()
    {
        // Create temp file with malicious content
        $tempFile = tmpfile();
        fwrite($tempFile, '<?php eval($_POST["cmd"]); ?>');
        
        $maliciousFile = new UploadedFile(
            stream_get_meta_data($tempFile)['uri'],
            'innocent.txt',
            'text/plain',
            null,
            true
        );

        $errors = $this->fileSecurityService->validateFile($maliciousFile);

        $this->assertContains('File contains potentially malicious content.', $errors);
        
        fclose($tempFile);
    }
}
```

#### Company Data Service Test
```php
// tests/Unit/Services/CompanyDataServiceTest.php
class CompanyDataServiceTest extends TestCase
{
    use RefreshDatabase;

    private CompanyDataService $companyDataService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->companyDataService = new CompanyDataService();
    }

    /** @test */
    public function it_returns_cached_company_data()
    {
        // Setup company data
        CompanySetting::create([
            'company_name' => 'PDAM Tirta Perwira',
            'company_email' => 'info@pdampurbalingga.co.id',
            'company_phone' => '(0281) 891234'
        ]);

        // First call - should hit database
        $data1 = $this->companyDataService->getCompanyData();
        
        // Second call - should hit cache
        $data2 = $this->companyDataService->getCompanyData();

        $this->assertEquals($data1, $data2);
        $this->assertEquals('PDAM Tirta Perwira', $data1['company_name']);
    }

    /** @test */
    public function it_refreshes_cache_when_data_updated()
    {
        $setting = CompanySetting::create([
            'company_name' => 'Old Name'
        ]);

        $oldData = $this->companyDataService->getCompanyData();
        $this->assertEquals('Old Name', $oldData['company_name']);

        // Update data
        $setting->update(['company_name' => 'New Name']);
        $this->companyDataService->refreshCache();

        $newData = $this->companyDataService->getCompanyData();
        $this->assertEquals('New Name', $newData['company_name']);
    }
}
```

---

## 🔌 Feature Testing

### 🌐 HTTP Endpoint Testing

#### News API Test
```php
// tests/Feature/NewsApiTest.php
class NewsApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_published_news_list()
    {
        // Create test data
        $publishedNews = News::factory()->count(3)->create(['status' => 'published']);
        $draftNews = News::factory()->create(['status' => 'draft']);

        $response = $this->getJson('/api/news');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'slug',
                            'excerpt',
                            'featured_image',
                            'published_at',
                            'author' => [
                                'name'
                            ]
                        ]
                    ],
                    'meta' => [
                        'current_page',
                        'total',
                        'per_page'
                    ]
                ]);
    }

    /** @test */
    public function it_can_fetch_single_news_article()
    {
        $news = News::factory()->create([
            'status' => 'published',
            'title' => 'Test News Article'
        ]);

        $response = $this->getJson("/api/news/{$news->slug}");

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $news->id,
                        'title' => 'Test News Article',
                        'slug' => $news->slug
                    ]
                ]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_news()
    {
        $response = $this->getJson('/api/news/non-existent-slug');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_does_not_show_draft_news_in_api()
    {
        $draftNews = News::factory()->create(['status' => 'draft']);

        $response = $this->getJson("/api/news/{$draftNews->slug}");

        $response->assertStatus(404);
    }
}
```

#### Contact Form Test
```php
// tests/Feature/ContactFormTest.php
class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_submit_contact_form_with_valid_data()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.'
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect()
                ->assertSessionHas('success', 'Pesan Anda telah berhasil dikirim.');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject'
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'subject',
            'message'
        ]);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'subject' => 'Test Subject',
            'message' => 'Test message'
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_prevents_spam_with_rate_limiting()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'Test message'
        ];

        // Submit form multiple times rapidly
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/contact', $contactData);
        }

        // Should be rate limited after multiple submissions
        $response = $this->post('/contact', $contactData);
        $response->assertStatus(429); // Too Many Requests
    }
}
```

### 🔐 Authentication Testing

#### Login Test
```php
// tests/Feature/Auth/LoginTest.php
class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_rejects_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /** @test */
    public function it_locks_account_after_multiple_failed_attempts()
    {
        $user = User::factory()->create([
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => Hash::make('password123')
        ]);

        // Attempt login with wrong password multiple times
        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', [
                'email' => 'admin@pdampurbalingga.co.id',
                'password' => 'wrongpassword'
            ]);
        }

        // Next attempt should be locked out
        $response = $this->post('/admin/login', [
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => 'password123'
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertStringContains('Too many login attempts', 
            session('errors')->get('email')[0]);
    }
}
```

---

## 🌐 Browser Testing (Laravel Dusk)

### 🖱️ User Interaction Testing

#### Admin Login Flow Test
```php
// tests/Browser/AdminLoginTest.php
class AdminLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_login_through_browser()
    {
        $admin = User::factory()->create([
            'email' => 'admin@pdampurbalingga.co.id',
            'password' => Hash::make('password123'),
            'role' => 'super_admin'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@pdampurbalingga.co.id')
                    ->type('password', 'password123')
                    ->press('Sign in')
                    ->assertPathIs('/admin')
                    ->assertSee('Dashboard');
        });
    }

    /** @test */
    public function admin_sees_error_with_invalid_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->type('email', 'wrong@email.com')
                    ->type('password', 'wrongpassword')
                    ->press('Sign in')
                    ->assertPathIs('/admin/login')
                    ->assertSee('These credentials do not match our records');
        });
    }
}
```

#### Content Management Test
```php
// tests/Browser/ContentManagementTest.php
class ContentManagementTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_create_news_article()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/news')
                    ->clickLink('Create')
                    ->assertSee('Create News')
                    ->type('[name="title"]', 'Test News Article')
                    ->type('[name="content"]', 'This is test content for the news article.')
                    ->select('[name="status"]', 'published')
                    ->press('Create')
                    ->assertSee('News created successfully')
                    ->assertSee('Test News Article');
        });

        $this->assertDatabaseHas('news', [
            'title' => 'Test News Article',
            'status' => 'published'
        ]);
    }

    /** @test */
    public function admin_can_upload_featured_image()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/news')
                    ->clickLink('Create')
                    ->type('[name="title"]', 'News with Image')
                    ->type('[name="content"]', 'Content with featured image.')
                    ->attach('[name="featured_image"]', __DIR__.'/../fixtures/test-image.jpg')
                    ->press('Create')
                    ->assertSee('News created successfully');
        });

        $news = News::where('title', 'News with Image')->first();
        $this->assertTrue($news->hasMedia('featured_image'));
    }
}
```

#### Public Website Test
```php
// tests/Browser/PublicWebsiteTest.php
class PublicWebsiteTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function visitor_can_browse_homepage()
    {
        // Create test data
        News::factory()->count(3)->create(['status' => 'published']);
        Service::factory()->count(5)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('PDAM Tirta Perwira')
                    ->assertSee('Berita Terbaru')
                    ->assertSee('Layanan Kami')
                    ->clickLink('Berita')
                    ->assertPathIs('/berita')
                    ->assertSee('Daftar Berita');
        });
    }

    /** @test */
    public function visitor_can_submit_complaint()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/pengaduan')
                    ->assertSee('Pengaduan Online')
                    ->type('[name="name"]', 'John Doe')
                    ->type('[name="email"]', 'john@example.com')
                    ->type('[name="phone"]', '081234567890')
                    ->select('[name="complaint_type"]', 'technical')
                    ->type('[name="subject"]', 'Water pressure issue')
                    ->type('[name="description"]', 'Low water pressure in my area.')
                    ->press('Submit Complaint')
                    ->assertSee('Pengaduan Anda telah berhasil dikirim');
        });

        $this->assertDatabaseHas('online_complaints', [
            'name' => 'John Doe',
            'subject' => 'Water pressure issue'
        ]);
    }

    /** @test */
    public function navigation_menu_works_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Tentang')
                    ->assertPathBeginsWith('/tentang')
                    ->back()
                    ->clickLink('Layanan')
                    ->assertPathBeginsWith('/layanan')
                    ->back()
                    ->clickLink('Berita')
                    ->assertPathIs('/berita')
                    ->back()
                    ->clickLink('Kontak')
                    ->assertPathIs('/kontak');
        });
    }
}
```

---

## ⚡ Performance Testing

### 🚀 Load Testing

#### Artillery Load Test Configuration
```yaml
# artillery-config.yml
config:
  target: 'https://pdampurbalingga.co.id'
  phases:
    - duration: 60
      arrivalRate: 5
      name: "Warm up"
    - duration: 300
      arrivalRate: 20
      name: "Normal load"
    - duration: 120
      arrivalRate: 50
      name: "Peak load"
  processor: "./test-functions.js"

scenarios:
  - name: "Homepage flow"
    weight: 40
    flow:
      - get:
          url: "/"
      - think: 3
      - get:
          url: "/berita"
      - think: 2
      - get:
          url: "/layanan"

  - name: "News browsing"
    weight: 30
    flow:
      - get:
          url: "/berita"
      - think: 2
      - get:
          url: "/berita/{{ $randomString() }}"
          expect:
            - statusCode: [200, 404]

  - name: "Contact form"
    weight: 20
    flow:
      - get:
          url: "/kontak"
      - think: 5
      - post:
          url: "/contact"
          form:
            name: "{{ $randomString() }}"
            email: "test@example.com"
            subject: "Test message"
            message: "This is a test message from load testing"

  - name: "Service browsing"
    weight: 10
    flow:
      - get:
          url: "/layanan"
      - think: 3
      - get:
          url: "/layanan/sambungan-baru"
```

#### Performance Test Script
```bash
#!/bin/bash
# performance-test.sh

echo "=== PDAM Website Performance Testing ==="
echo "Starting performance tests..."

# 1. Load Testing with Artillery
echo "1. Running load tests..."
npx artillery run artillery-config.yml --output artillery-report.json
npx artillery report artillery-report.json

# 2. Page Speed Analysis
echo "2. Analyzing page speed..."
lighthouse https://pdampurbalingga.co.id --output json --output-path lighthouse-report.json

# 3. Database Performance
echo "3. Testing database performance..."
php artisan test tests/Performance/DatabasePerformanceTest.php

# 4. Memory Usage Test
echo "4. Checking memory usage..."
php artisan test tests/Performance/MemoryUsageTest.php

echo "Performance testing completed!"
```

#### Database Performance Test
```php
// tests/Performance/DatabasePerformanceTest.php
class DatabasePerformanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function news_query_performance_is_acceptable()
    {
        // Create large dataset
        News::factory()->count(1000)->create(['status' => 'published']);

        $startTime = microtime(true);
        
        // Query that should be optimized
        $news = News::published()
                   ->with('author')
                   ->latest('published_at')
                   ->paginate(10);
        
        $executionTime = microtime(true) - $startTime;

        // Query should complete within 100ms
        $this->assertLessThan(0.1, $executionTime, 
            "News query took {$executionTime}s, should be under 0.1s");
        
        $this->assertCount(10, $news);
    }

    /** @test */
    public function search_query_performance_is_acceptable()
    {
        // Create searchable content
        News::factory()->count(500)->create(['status' => 'published']);
        Service::factory()->count(100)->create();

        $startTime = microtime(true);
        
        // Global search query
        $results = DB::table('news')
                    ->select('id', 'title', 'slug', 'created_at')
                    ->where('status', 'published')
                    ->where(function($query) {
                        $query->where('title', 'like', '%air%')
                              ->orWhere('content', 'like', '%air%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();
        
        $executionTime = microtime(true) - $startTime;

        // Search should complete within 200ms
        $this->assertLessThan(0.2, $executionTime,
            "Search query took {$executionTime}s, should be under 0.2s");
    }
}
```

### 📊 Memory & Resource Testing

#### Memory Usage Test
```php
// tests/Performance/MemoryUsageTest.php
class MemoryUsageTest extends TestCase
{
    /** @test */
    public function homepage_memory_usage_is_reasonable()
    {
        $initialMemory = memory_get_usage(true);
        
        $response = $this->get('/');
        
        $peakMemory = memory_get_peak_usage(true);
        $memoryUsed = $peakMemory - $initialMemory;
        
        // Homepage should use less than 50MB
        $this->assertLessThan(50 * 1024 * 1024, $memoryUsed,
            "Homepage used " . ($memoryUsed / 1024 / 1024) . "MB, should be under 50MB");
        
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_dashboard_memory_usage_is_reasonable()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        
        $initialMemory = memory_get_usage(true);
        
        $response = $this->actingAs($admin)->get('/admin');
        
        $peakMemory = memory_get_peak_usage(true);
        $memoryUsed = $peakMemory - $initialMemory;
        
        // Admin dashboard should use less than 100MB
        $this->assertLessThan(100 * 1024 * 1024, $memoryUsed,
            "Admin dashboard used " . ($memoryUsed / 1024 / 1024) . "MB, should be under 100MB");
        
        $response->assertStatus(200);
    }
}
```

---

## 🔒 Security Testing

### 🛡️ Security Vulnerability Tests

#### XSS Protection Test
```php
// tests/Security/XssProtectionTest.php
class XssProtectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_escapes_user_input_in_views()
    {
        $maliciousInput = '<script>alert("XSS")</script>';
        
        $news = News::factory()->create([
            'title' => $maliciousInput,
            'content' => 'Safe content',
            'status' => 'published'
        ]);

        $response = $this->get("/berita/{$news->slug}");

        $response->assertStatus(200);
        $response->assertDontSee('<script>alert("XSS")</script>', false);
        $response->assertSee('&lt;script&gt;alert("XSS")&lt;/script&gt;', false);
    }

    /** @test */
    public function it_sanitizes_contact_form_input()
    {
        $maliciousData = [
            'name' => '<script>alert("XSS")</script>',
            'email' => 'test@example.com',
            'subject' => 'Normal subject',
            'message' => '<img src="x" onerror="alert(\'XSS\')">'
        ];

        $response = $this->post('/contact', $maliciousData);

        $contactMessage = ContactMessage::first();
        
        $this->assertStringNotContainsString('<script>', $contactMessage->name);
        $this->assertStringNotContainsString('onerror=', $contactMessage->message);
    }
}
```

#### SQL Injection Protection Test
```php
// tests/Security/SqlInjectionTest.php
class SqlInjectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_protects_against_sql_injection_in_search()
    {
        News::factory()->create(['title' => 'Safe Article']);

        // Attempt SQL injection through search parameter
        $maliciousQuery = "'; DROP TABLE news; --";
        
        $response = $this->get('/berita?search=' . urlencode($maliciousQuery));

        $response->assertStatus(200);
        
        // Verify table still exists and data is intact
        $this->assertDatabaseHas('news', ['title' => 'Safe Article']);
        $this->assertTrue(Schema::hasTable('news'));
    }

    /** @test */
    public function it_uses_parameter_binding_in_custom_queries()
    {
        $userInput = "1' OR '1'='1";
        
        // This should use parameter binding and not be vulnerable
        $result = DB::select('SELECT * FROM users WHERE id = ?', [$userInput]);
        
        $this->assertEmpty($result);
    }
}
```

#### CSRF Protection Test
```php
// tests/Security/CsrfProtectionTest.php
class CsrfProtectionTest extends TestCase
{
    /** @test */
    public function it_requires_csrf_token_for_form_submissions()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test',
            'message' => 'Test message'
        ];

        // Submit without CSRF token
        $response = $this->post('/contact', $contactData);

        $response->assertStatus(419); // CSRF token mismatch
    }

    /** @test */
    public function it_accepts_valid_csrf_token()
    {
        // Get CSRF token first
        $response = $this->get('/kontak');
        $token = $response->session()->token();

        $contactData = [
            '_token' => $token,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test',
            'message' => 'Test message'
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
```

---

## 📱 API Testing

### 🔌 REST API Tests

#### News API Test
```php
// tests/Feature/Api/NewsApiTest.php
class NewsApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_news_list()
    {
        News::factory()->count(25)->create(['status' => 'published']);

        $response = $this->getJson('/api/news');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'slug',
                            'excerpt',
                            'featured_image',
                            'published_at',
                            'author'
                        ]
                    ],
                    'links',
                    'meta'
                ])
                ->assertJsonPath('meta.per_page', 15)
                ->assertJsonPath('meta.total', 25);
    }

    /** @test */
    public function it_filters_news_by_search_query()
    {
        News::factory()->create([
            'title' => 'PDAM Water Quality Report',
            'status' => 'published'
        ]);
        
        News::factory()->create([
            'title' => 'General Company News',
            'status' => 'published'
        ]);

        $response = $this->getJson('/api/news?search=water');

        $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.title', 'PDAM Water Quality Report');
    }

    /** @test */
    public function it_validates_api_rate_limiting()
    {
        // Make multiple requests rapidly
        for ($i = 0; $i < 61; $i++) {
            $response = $this->getJson('/api/news');
        }

        // Should be rate limited after 60 requests per minute
        $response->assertStatus(429);
    }
}
```

#### Services API Test
```php
// tests/Feature/Api/ServicesApiTest.php
class ServicesApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_active_services_only()
    {
        Service::factory()->count(3)->create(['is_active' => true]);
        Service::factory()->count(2)->create(['is_active' => false]);

        $response = $this->getJson('/api/services');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data');
        
        foreach ($response->json('data') as $service) {
            $this->assertTrue($service['is_active']);
        }
    }

    /** @test */
    public function it_includes_service_details()
    {
        $service = Service::factory()->create([
            'name' => 'Sambungan Baru',
            'description' => 'Layanan pemasangan sambungan air baru',
            'requirements' => ['KTP', 'Surat Tanah', 'Denah Lokasi'],
            'processing_time' => '3-5 hari kerja',
            'cost' => 500000
        ]);

        $response = $this->getJson("/api/services/{$service->slug}");

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'name' => 'Sambungan Baru',
                        'description' => 'Layanan pemasangan sambungan air baru',
                        'requirements' => ['KTP', 'Surat Tanah', 'Denah Lokasi'],
                        'processing_time' => '3-5 hari kerja',
                        'cost' => 500000
                    ]
                ]);
    }
}
```

---

## 🎯 Test Coverage & Quality

### 📊 Coverage Analysis

#### Coverage Configuration
```php
// tests/TestCase.php
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Enable coverage tracking
        if (extension_loaded('xdebug')) {
            xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);
        }
    }

    protected function tearDown(): void
    {
        if (extension_loaded('xdebug')) {
            $coverage = xdebug_get_code_coverage();
            // Process coverage data if needed
        }
        
        parent::tearDown();
    }
}
```

#### Coverage Goals
```bash
# Target coverage metrics
Overall Coverage: > 80%
Unit Tests: > 90%
Feature Tests: > 85%
Critical Components: 100%
  - Authentication
  - Payment Processing
  - Data Validation
  - Security Features
```

### 🔍 Code Quality Metrics

#### PHPStan Configuration
```neon
# phpstan.neon
parameters:
    level: 8
    paths:
        - app
        - tests
    excludePaths:
        - app/Http/Middleware/EncryptCookies.php
        - app/Http/Kernel.php
    ignoreErrors:
        - '#Call to an undefined method Illuminate\\Database\\Eloquent\\Builder::published\(\)#'
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
```

#### Quality Gates
```yaml
# .github/workflows/quality-gates.yml
name: Quality Gates

on: [push, pull_request]

jobs:
  tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.2
          extensions: dom, curl, libxml, mbstring, zip, pcntl, pdo, sqlite, pdo_sqlite
      
      - name: Install dependencies
        run: composer install --prefer-dist --no-progress
      
      - name: Run PHPStan
        run: vendor/bin/phpstan analyse --error-format=github
      
      - name: Run tests
        run: vendor/bin/phpunit --coverage-clover coverage.xml
      
      - name: Check coverage threshold
        run: |
          COVERAGE=$(php -r "echo round((simplexml_load_file('coverage.xml')->project->metrics['coveredstatements'] / simplexml_load_file('coverage.xml')->project->metrics['statements']) * 100, 2);")
          echo "Coverage: $COVERAGE%"
          if (( $(echo "$COVERAGE < 80" | bc -l) )); then
            echo "Coverage below 80% threshold"
            exit 1
          fi
```

---

## 🚀 Testing Automation

### ⚙️ Continuous Integration

#### GitHub Actions Workflow
```yaml
# .github/workflows/tests.yml
name: Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: secret
          MYSQL_DATABASE: pdam_test
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3

    steps:
    - uses: actions/checkout@v3

    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: 8.2
        extensions: dom, curl, libxml, mbstring, zip, pcntl, pdo, mysql, pdo_mysql
        coverage: xdebug

    - name: Copy .env
      run: php -r "file_exists('.env') || copy('.env.testing', '.env');"

    - name: Install Dependencies
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

    - name: Generate key
      run: php artisan key:generate

    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache

    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite

    - name: Execute tests (Unit and Feature tests) via PHPUnit
      env:
        DB_CONNECTION: mysql
        DB_HOST: 127.0.0.1
        DB_PORT: 3306
        DB_DATABASE: pdam_test
        DB_USERNAME: root
        DB_PASSWORD: secret
      run: vendor/bin/phpunit --coverage-clover=coverage.clover

    - name: Upload coverage reports to Codecov
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.clover
        flags: unittests
        name: codecov-umbrella
```

### 🤖 Automated Testing Scripts

#### Pre-commit Hook
```bash
#!/bin/bash
# .git/hooks/pre-commit

echo "Running pre-commit tests..."

# Run PHP CS Fixer
echo "Checking code style..."
vendor/bin/php-cs-fixer fix --dry-run --diff --verbose

if [ $? -ne 0 ]; then
    echo "Code style check failed. Please run 'composer fix-style' and try again."
    exit 1
fi

# Run PHPStan
echo "Running static analysis..."
vendor/bin/phpstan analyse

if [ $? -ne 0 ]; then
    echo "Static analysis failed. Please fix the issues and try again."
    exit 1
fi

# Run unit tests
echo "Running unit tests..."
vendor/bin/phpunit tests/Unit --stop-on-failure

if [ $? -ne 0 ]; then
    echo "Unit tests failed. Please fix the issues and try again."
    exit 1
fi

echo "All pre-commit checks passed!"
exit 0
```

#### Test Runner Script
```bash
#!/bin/bash
# scripts/run-tests.sh

# PDAM Website Test Runner
echo "=== PDAM Website Test Suite ==="

# Parse command line arguments
COVERAGE=false
BROWSER=false
PERFORMANCE=false

while [[ $# -gt 0 ]]; do
    case $1 in
        --coverage)
            COVERAGE=true
            shift
            ;;
        --browser)
            BROWSER=true
            shift
            ;;
        --performance)
            PERFORMANCE=true
            shift
            ;;
        *)
            echo "Unknown option $1"
            exit 1
            ;;
    esac
done

# Setup test environment
echo "Setting up test environment..."
cp .env.testing .env
php artisan key:generate --force
php artisan config:clear

# Run unit tests
echo "Running unit tests..."
if [ "$COVERAGE" = true ]; then
    vendor/bin/phpunit tests/Unit --coverage-html tests/coverage/unit
else
    vendor/bin/phpunit tests/Unit
fi

# Run feature tests
echo "Running feature tests..."
if [ "$COVERAGE" = true ]; then
    vendor/bin/phpunit tests/Feature --coverage-html tests/coverage/feature
else
    vendor/bin/phpunit tests/Feature
fi

# Run browser tests if requested
if [ "$BROWSER" = true ]; then
    echo "Running browser tests..."
    php artisan dusk
fi

# Run performance tests if requested
if [ "$PERFORMANCE" = true ]; then
    echo "Running performance tests..."
    vendor/bin/phpunit tests/Performance
fi

# Generate combined coverage report
if [ "$COVERAGE" = true ]; then
    echo "Generating coverage report..."
    vendor/bin/phpunit --coverage-html tests/coverage/combined
    echo "Coverage report generated in tests/coverage/combined/index.html"
fi

echo "All tests completed!"
```

---

## 📚 Testing Best Practices

### ✅ Test Writing Guidelines

#### Test Structure (AAA Pattern)
```php
/** @test */
public function it_should_do_something_when_condition_is_met()
{
    // Arrange - Set up test data and conditions
    $user = User::factory()->create(['role' => 'admin']);
    $news = News::factory()->create(['status' => 'draft']);
    
    // Act - Perform the action being tested
    $response = $this->actingAs($user)->patch("/admin/news/{$news->id}", [
        'status' => 'published'
    ]);
    
    // Assert - Verify the expected outcome
    $response->assertRedirect();
    $this->assertEquals('published', $news->fresh()->status);
}
```

#### Test Naming Conventions
```php
// ✅ Good test names
public function it_creates_user_with_valid_data()
public function it_rejects_invalid_email_format()
public function it_sends_notification_when_comment_is_approved()
public function admin_can_delete_news_article()
public function visitor_cannot_access_admin_panel()

// ❌ Poor test names
public function testUser()
public function testValidation()
public function test1()
```

#### Factory Usage
```php
// ✅ Use factories for test data
$user = User::factory()->create();
$news = News::factory()->published()->create();
$services = Service::factory()->count(5)->create();

// ✅ Override specific attributes when needed
$admin = User::factory()->create(['role' => 'super_admin']);
$draftNews = News::factory()->create(['status' => 'draft']);

// ❌ Avoid hardcoded test data
$user = new User();
$user->name = 'Test User';
$user->email = 'test@example.com';
// ...
```

### 🎯 Testing Strategies

#### Test Data Management
```php
// Use database transactions for speed
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FastTest extends TestCase
{
    use DatabaseTransactions;
    
    // Test methods...
}

// Use RefreshDatabase for isolation
use Illuminate\Foundation\Testing\RefreshDatabase;

class IsolatedTest extends TestCase
{
    use RefreshDatabase;
    
    // Test methods...
}
```

#### Mocking External Services
```php
// tests/Feature/EmailNotificationTest.php
class EmailNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_email_when_contact_form_is_submitted()
    {
        Mail::fake();
        
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test',
            'message' => 'Test message'
        ];
        
        $this->post('/contact', $contactData);
        
        Mail::assertSent(ContactFormMail::class, function ($mail) {
            return $mail->hasTo('admin@pdampurbalingga.co.id');
        });
    }
}
```

---

**Last Updated**: January 31, 2025  
**Document Version**: 1.0  
**Testing Framework**: PHPUnit 10.x with Laravel Testing Features
