# Pertemuan 8 – HMVC + Blade (Laravel 12 + nwidart/laravel-modules)

Aplikasi pendaftaran dengan dua modul:

- **Pendaftaran** – CRUD via AJAX (jQuery) + upload berkas (jpg/png/pdf, maks 2 MB).
- **UserManagement** – CRUD user (khusus role `admin`).

## Cara menjalankan

```bash
composer install
cp .env.example .env          # lewati jika .env sudah ada
php artisan key:generate      # lewati jika APP_KEY sudah terisi
php artisan storage:link      # wajib agar berkas yang diunggah bisa dibuka
php artisan migrate --seed
php artisan serve
```

Pastikan database `hmvc_blade` sudah dibuat di MySQL (lihat `DB_*` di `.env`).

## Akun contoh (hasil seeder)

| Role  | Email             | Password   |
|-------|-------------------|------------|
| Admin | admin@example.com | `password` |
| User  | user@example.com  | `password` |

## Struktur singkat

```
app/                 -> Auth, Dashboard, middleware role, model User
Modules/Pendaftaran/ -> controller, request, model, routes, view
Modules/UserManagement/
resources/views/     -> layout bersama (app, guest) + halaman auth & dashboard
```

## Menjalankan test

```bash
php artisan test
```
