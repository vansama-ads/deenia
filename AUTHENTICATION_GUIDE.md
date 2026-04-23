# Panduan Sistem Authentication Manual Laravel

## 📋 Daftar File yang Dibuat

### 1. **AuthController** (`app/Http/Controllers/AuthController.php`)
   - `showRegister()` - Tampilkan halaman register
   - `register()` - Proses registrasi user baru
   - `showLogin()` - Tampilkan halaman login
   - `login()` - Proses login user
   - `logout()` - Logout user

### 2. **Routes** (`routes/web.php`)
   - `GET /register` - Halaman form register
   - `POST /register` - Proses registrasi
   - `GET /login` - Halaman form login
   - `POST /login` - Proses login
   - `POST /logout` - Proses logout
   - `GET /dashboard` - Dashboard (memerlukan login)

### 3. **Blade Templates**
   - `resources/views/auth/register.blade.php` - Halaman register
   - `resources/views/auth/login.blade.php` - Halaman login
   - `resources/views/dashboard.blade.php` - Dashboard setelah login

## 🚀 Cara Menggunakan

### 1. **Registrasi Akun Baru**
   ```
   Buka: http://localhost:8000/register
   Isi form dengan:
   - Nama Pengguna (minimal 3 karakter)
   - Email (harus unik)
   - Password (minimal 6 karakter)
   - Konfirmasi Password
   ```

### 2. **Login**
   ```
   Buka: http://localhost:8000/login
   Isi dengan email dan password yang sudah terdaftar
   ```

### 3. **Setelah Login Berhasil**
   ```
   Akan diarahkan ke: http://localhost:8000/dashboard
   ```

### 4. **Logout**
   ```
   Klik tombol "Logout" di navbar dashboard
   ```

## 🔐 Fitur Keamanan

✅ **Password Hashing** - Menggunakan `Hash::make()`
✅ **Validasi Data** - Input validation dengan pesan error custom
✅ **Session Regeneration** - Regenerate session setelah login/logout untuk keamanan
✅ **CSRF Protection** - Token CSRF otomatis di semua form
✅ **Auth Middleware** - Route dashboard hanya bisa diakses jika sudah login

## 🔧 Cara Mengakses User yang Login

Di Controller atau Blade, gunakan:

```php
// Di Controller
$user = auth()->user(); // Dapatkan user yang login
$name = auth()->user()->nickname; // Dapatkan nama user

// Di Blade
{{ auth()->user()->nickname }} // Tampilkan nama user

// Cek apakah user sudah login
@if(auth()->check())
    // User sudah login
@else
    // User belum login
@endif
```

## 📝 Struktur User Model

Kolom-kolom yang tersimpan di database:
- `id` - ID user
- `nickname` - Nama pengguna
- `email` - Email
- `password` - Password (ter-hash)
- `role` - Role (user/admin)
- `created_at` - Tanggal registrasi
- `updated_at` - Tanggal update terakhir

## 🎯 Testing

Untuk testing, lakukan langkah berikut:

1. **Buka aplikasi** 
   ```
   http://localhost:8000
   ```

2. **Klik "Daftar"** atau ke `http://localhost:8000/register`

3. **Isi form registrasi** dan klik "Daftar"

4. **Otomatis login** dan masuk ke dashboard

5. **Klik "Logout"** untuk keluar

## 🛠️ Kustomisasi

### Ubah Validasi Registrasi
Edit `AuthController.php` di method `register()`:
```php
$validated = $request->validate([
    'nickname' => 'required|string|min:3|max:50',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|string|min:6|confirmed',
]);
```

### Ubah Pesan Error
Edit array pesan custom di `register()` atau `login()` method.

### Ubah Design
Edit CSS di template Blade:
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/dashboard.blade.php`

## ✨ Tips Tambahan

1. **Redirect ke login jika belum login**: Gunakan middleware `auth` di route
2. **Cek role user**: Tambahkan `role` saat validasi
3. **Remember me**: Tambahkan checkbox dan gunakan `Auth::attempt($credentials, $remember)`
4. **Email verification**: Gunakan `MustVerifyEmail` trait
5. **Password reset**: Implementasikan `ForgotPasswordController` dan `ResetPasswordController`

---
**Dibuat untuk pembelajaran Laravel Authentication Manual**
