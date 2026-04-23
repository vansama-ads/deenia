# 📊 Admin Panel Deenia - Panduan Lengkap

Dokumentasi ini menjelaskan sistem admin panel yang telah dibuat untuk Laravel project Deenia dengan authentication manual.

## 📁 File-File yang Dibuat

### 1. **Middleware**
- `app/Http/Middleware/AdminMiddleware.php` - Middleware untuk cek role admin

### 2. **Layout Blade**
- `resources/views/layouts/app.blade.php` - Layout untuk user biasa
- `resources/views/layouts/admin.blade.php` - Layout admin dengan sidebar

### 3. **Views Admin**
- `resources/views/admin/dashboard.blade.php` - Admin dashboard
- `resources/views/admin/users/index.blade.php` - List users
- `resources/views/admin/users/create.blade.php` - Form tambah user
- `resources/views/admin/users/show.blade.php` - Detail user
- `resources/views/admin/users/edit.blade.php` - Form edit user
- `resources/views/admin/chapters/index.blade.php` - Placeholder chapters
- `resources/views/admin/acts/index.blade.php` - Placeholder acts
- `resources/views/admin/lessons/index.blade.php` - Placeholder lessons

### 4. **View User**
- `resources/views/dashboard.blade.php` - User dashboard (update ke layout app)

### 5. **Controller**
- `app/Http/Controllers/UserController.php` - Update untuk handle admin & user routing
- `app/Http/Controllers/AuthController.php` - Update login redirect berdasarkan role

### 6. **Routes**
- `routes/web.php` - Update dengan route group admin

### 7. **Bootstrap**
- `bootstrap/app.php` - Register AdminMiddleware

---

## 🚀 Cara Menggunakan

### 1. **Testing Admin Panel**

**Sebagai Admin:**
```
1. Register akun baru atau gunakan akun existing
2. Masuk ke database dan ubah role menjadi 'admin'
   UPDATE users SET role = 'admin' WHERE id = 1;
3. Login di http://localhost:8000/login
4. Akan otomatis redirect ke http://localhost:8000/admin/dashboard
```

**Sebagai User Biasa:**
```
1. Login dengan akun yang role-nya 'user'
2. Akan redirect ke http://localhost:8000/dashboard
3. Jika coba akses /admin/* → akan di-redirect dengan error
```

### 2. **Route Structure**

**User Routes (Public, memerlukan login):**
```php
GET    /dashboard              → dashboard user
GET    /users                  → list users (public view)
GET    /users/create           → form tambah user
POST   /users                  → simpan user
GET    /users/{id}             → detail user
GET    /users/{id}/edit        → form edit user
PUT    /users/{id}             → update user
DELETE /users/{id}             → hapus user
```

**Admin Routes (memerlukan login + role admin):**
```php
GET    /admin/dashboard        → admin dashboard
GET    /admin/users            → list users (admin view)
GET    /admin/users/create     → form tambah user
POST   /admin/users            → simpan user
GET    /admin/users/{id}       → detail user
GET    /admin/users/{id}/edit  → form edit user
PUT    /admin/users/{id}       → update user
DELETE /admin/users/{id}       → hapus user
GET    /admin/chapters         → placeholder chapters
GET    /admin/acts             → placeholder acts
GET    /admin/lessons          → placeholder lessons
```

---

## 🎨 Layout & Sidebar

### Layout App (User Biasa)
- Navbar sederhana dengan nama user dan logout button
- Container dengan max-width 1200px
- Pesan success/error alert

### Layout Admin
- **Sidebar di kiri** (250px, warna gelap)
  - Branding "Admin Panel"
  - Menu dengan 5 item:
    - Dashboard
    - Users
    - Chapters
    - Acts
    - Lessons
  - Logout button di bawah
- **Main Content di kanan**
  - Topbar dengan judul halaman dan info user
  - Content area dengan max-width 100%
  - Alert message
  - Card-based layout

### Active Menu Highlight
Menu yang aktif akan memiliki:
```blade
@if(request()->routeIs('admin.dashboard')) active @endif
@if(request()->routeIs('admin.users.*')) active @endif
```

---

## 🔐 Middleware Admin

### Cara Kerja
```php
// File: app/Http/Middleware/AdminMiddleware.php
if (auth()->check() && auth()->user()->role === 'admin') {
    return $next($request);
}
return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses...');
```

### Menggunakan di Route
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Routes yang hanya bisa diakses admin
});
```

---

## 🔀 Login Redirect Berdasarkan Role

```php
// File: app/Http/Controllers/AuthController.php - login() method

if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    // Redirect berdasarkan role
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }

    return redirect()->route('dashboard')->with('success', 'Login berhasil!');
}
```

---

## 📝 Contoh: Menambah Route & Layout Admin Baru

### 1. Tambah Route untuk Chapters
```php
// routes/web.php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Existing routes...

    // Tambah chapter routes
    Route::resource('chapters', ChapterController::class);
});
```

### 2. Buat Controller
```php
php artisan make:controller ChapterController --resource
```

### 3. Buat Views dengan Layout Admin
```blade
// resources/views/admin/chapters/index.blade.php
@extends('layouts.admin')

@section('page-title', 'Kelola Chapters')
@section('title', 'Admin - Chapters')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">📚 Daftar Chapters</h2>
        </div>
        <!-- Content here -->
    </div>
@endsection
```

---

## 📊 UserController Smart Routing

UserController sudah di-update untuk automatically menentukan view path:

```php
/**
 * Menentukan view path berdasarkan route prefix
 */
private function getViewPath($view)
{
    if (strpos(request()->route()->getName(), 'admin.') === 0) {
        return 'admin.users.' . $view;
    }
    return 'users.' . $view;
}
```

**Hasil:**
- `/users` menggunakan view `users/index.blade.php`
- `/admin/users` menggunakan view `admin/users/index.blade.php`
- Sama controller, berbeda view!

---

## 🎯 Fitur Keamanan

✅ **Authentication Required** - Semua route memerlukan login  
✅ **Role Check** - Admin route hanya accessible untuk role 'admin'  
✅ **Session Regeneration** - Regenerate session setelah login/logout  
✅ **CSRF Protection** - Token CSRF di semua form  
✅ **Password Hashing** - Menggunakan Hash::make()  
✅ **Active Menu Detection** - Menu highlight berdasarkan current route  

---

## 🛠️ Customization

### 1. Ubah Warna Sidebar
Edit CSS di `layouts/admin.blade.php`:
```css
.sidebar {
    background: #1a1a2e; /* Ubah warna sini */
}

.sidebar-brand {
    color: #667eea; /* Ubah warna branding */
    border-color: #667eea;
}
```

### 2. Tambah Menu Item di Sidebar
```blade
<ul class="sidebar-menu">
    <!-- Menu existing -->
    
    <!-- Tambah menu baru -->
    <li>
        <a href="{{ route('admin.reports.index') }}" class="@if(request()->routeIs('admin.reports.*')) active @endif">
            <span>📈 Reports</span>
        </a>
    </li>
</ul>
```

### 3. Ubah Validasi User Create di Admin
```php
// UserController.php - store() method
if ($isAdmin) {
    $request->validate([
        'nickname' => 'required|string|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|in:user,admin',
        // Tambah validasi baru di sini
    ]);
}
```

---

## ✨ Tips & Trik

### 1. Cek Role di View
```blade
@if(auth()->user()->role === 'admin')
    <!-- Hanya tampil untuk admin -->
@endif
```

### 2. Cek Role di Controller
```php
if (auth()->user()->role === 'admin') {
    // Akses level admin
}
```

### 3. Cek Route Admin
```php
// Check apakah current route adalah admin route
if (strpos(request()->route()->getName(), 'admin.') === 0) {
    // Di admin panel
}
```

### 4. Redirect Ke Admin Dashboard
```php
return redirect()->route('admin.dashboard');
```

### 5. Gunakan Named Routes
```blade
{{-- User routes --}}
<a href="{{ route('users.index') }}">List Users</a>

{{-- Admin routes --}}
<a href="{{ route('admin.users.index') }}">Admin List Users</a>
```

---

## 🐛 Troubleshooting

### Masalah: Middleware tidak jalan
**Solusi:** Pastikan middleware sudah registered di `bootstrap/app.php`

### Masalah: View tidak ketemu
**Solusi:** UserController menggunakan `getViewPath()` untuk determine view. Pastikan folder struktur benar:
- `resources/views/users/index.blade.php` (user view)
- `resources/views/admin/users/index.blade.php` (admin view)

### Masalah: Sidebar menu tidak highlight
**Solusi:** Pastikan menggunakan `request()->routeIs()` yang correct

### Masalah: Admin tidak bisa akses /admin/*
**Solusi:** Update role di database ke 'admin':
```sql
UPDATE users SET role = 'admin' WHERE id = 1;
```

---

## 📚 Next Steps

Anda bisa menambahkan:
1. ✅ Chapter Management
2. ✅ Act Management
3. ✅ Lesson Management
4. ✅ Admin Reports/Analytics
5. ✅ User Activity Logs
6. ✅ Settings Page
7. ✅ Email Notifications
8. ✅ Backup Management

Setiap item bisa dibuat dengan:
1. Buat Controller (resource)
2. Buat Views dengan layout admin
3. Add routes ke admin group
4. Add menu item di sidebar

---

**Dibuat untuk pembelajaran Laravel Admin Panel Manual**
