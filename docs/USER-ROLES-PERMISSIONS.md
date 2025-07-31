# 👥 User Management & Permissions

## 📋 Overview

Website PDAM menggunakan **Spatie Permission** package untuk mengelola user roles dan permissions. Ini memberikan fleksibilitas dalam mengatur akses user tanpa hardcode role field.

---

## 🏗️ Database Structure

### Tables
```sql
-- Users table (Laravel default)
users
├── id
├── name  
├── email
├── password
├── email_verified_at
├── created_at
└── updated_at

-- Spatie Permission tables
roles
├── id
├── name (super_admin, content_manager, operator, viewer)
├── guard_name
├── created_at
└── updated_at

permissions  
├── id
├── name (manage_users, manage_content, view_content, etc.)
├── guard_name
├── created_at
└── updated_at

model_has_roles (pivot table)
├── role_id
├── model_type (App\Models\User)
├── model_id (user_id)

model_has_permissions (pivot table)
├── permission_id  
├── model_type
├── model_id

role_has_permissions (pivot table)
├── permission_id
├── role_id
```

---

## 🎭 Role Structure

### Roles Defined
```php
// Available roles in the system
1. super_admin     - Full system access
2. content_manager - Content management only  
3. operator        - Daily operations
4. viewer          - Read-only access
```

### Permissions Structure
```php
// Permission categories
'users' => [
    'view_any_users',
    'view_users', 
    'create_users',
    'update_users',
    'delete_users'
],

'content' => [
    'view_any_news',
    'create_news',
    'update_news', 
    'delete_news',
    'publish_news'
],

'services' => [
    'view_any_services',
    'create_services',
    'update_services',
    'delete_services'
],

'settings' => [
    'view_settings',
    'update_settings'
]
```

---

## 💻 Implementation Examples

### Creating Users with Roles
```php
// Create user
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@pdampurbalingga.co.id', 
    'password' => Hash::make('password')
]);

// Assign role
$user->assignRole('content_manager');

// Assign multiple roles
$user->assignRole(['content_manager', 'operator']);

// Check if user has role
if ($user->hasRole('super_admin')) {
    // User is super admin
}

// Check permission
if ($user->can('create_news')) {
    // User can create news
}
```

### Role Management in Filament
```php
// In UserResource.php
public function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name'),
            TextInput::make('email'),
            Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload(),
        ]);
}
```

### Checking Permissions in Controllers
```php
// In NewsController.php
public function create()
{
    if (!auth()->user()->can('create_news')) {
        abort(403, 'Unauthorized');
    }
    
    // Continue with creation logic
}

// Using middleware
Route::group(['middleware' => ['permission:create_news']], function () {
    Route::post('/news', [NewsController::class, 'store']);
});
```

---

## 🔧 Artisan Commands

### Managing Roles & Permissions
```bash
# Create roles
php artisan tinker
> Spatie\Permission\Models\Role::create(['name' => 'super_admin']);
> Spatie\Permission\Models\Role::create(['name' => 'content_manager']);

# Create permissions  
> Spatie\Permission\Models\Permission::create(['name' => 'create_news']);
> Spatie\Permission\Models\Permission::create(['name' => 'manage_users']);

# Assign permission to role
> $role = Spatie\Permission\Models\Role::findByName('content_manager');
> $role->givePermissionTo('create_news');

# Assign role to user
> $user = App\Models\User::find(1);
> $user->assignRole('super_admin');
```

### Checking User Roles
```bash
php artisan tinker

# Get all users with their roles
> App\Models\User::with('roles')->get();

# Get specific user roles
> $user = App\Models\User::find(1);
> $user->roles->pluck('name');

# Get user permissions
> $user->getAllPermissions()->pluck('name');
```

---

## 🛡️ Security Considerations

### Best Practices
1. **Least Privilege**: Give users minimum required permissions
2. **Role Segregation**: Separate roles for different functions
3. **Regular Audit**: Review user permissions regularly
4. **Permission Gates**: Use Laravel gates for complex logic

### Permission Gates Example
```php
// In AuthServiceProvider.php
public function boot()
{
    Gate::define('manage-sensitive-data', function ($user) {
        return $user->hasRole('super_admin') && 
               $user->email_verified_at !== null;
    });
}

// Usage in controllers
if (Gate::allows('manage-sensitive-data')) {
    // Allow access
}
```

---

## 🚀 Migration from Simple Roles

If migrating from simple role field to Spatie Permission:

```php
// Migration script
public function up()
{
    // Create roles
    $roles = ['super_admin', 'content_manager', 'operator', 'viewer'];
    foreach ($roles as $role) {
        Role::create(['name' => $role]);
    }
    
    // Migrate existing users
    User::chunk(100, function ($users) {
        foreach ($users as $user) {
            if (isset($user->role)) {
                $user->assignRole($user->role);
            }
        }
    });
    
    // Drop old role column
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
```

---

## 📚 Resources

- [Spatie Permission Documentation](https://spatie.be/docs/laravel-permission)
- [Laravel Authorization](https://laravel.com/docs/authorization)
- [Filament User Resource](https://filamentphp.com/docs/panels/resources)

---

**Last Updated**: July 31, 2025  
**Package Version**: Spatie Permission v6.x
