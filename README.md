# Visitor Management System

Recreated from the provided BCA Visitor Management System documentation. The documented project uses PHP Laravel, MySQL and XAMPP and includes login, dashboard, visitor registration, check-out, visitor lists and filtering.

Link of the website:

https://visitor-management-system-production-b3cc.up.railway.app/

## Requirements
- PHP 8.2+
- Composer
- XAMPP (Apache + MySQL)

## Installation
1. Extract this folder.
2. Open terminal in the project folder.
3. Run `composer install`.
4. Copy `.env.example` to `.env`.
5. Create a MySQL database named `vms` in phpMyAdmin.
6. Run `php artisan key:generate`.
7. Run `php artisan migrate --seed`.
8. Run `php artisan serve`.
9. Open `http://127.0.0.1:8000/login`.

## Demo login
Username: `admin`
Password: `admin123`

## Main features
- Login / Logout
- Dashboard
- Add Visitor
- Duplicate active visitor prevention
- Unique Receipt ID
- Check Out by Receipt ID
- Active / Checked Out status
- All visitor records
- Search and date/status filters
- MySQL persistence
