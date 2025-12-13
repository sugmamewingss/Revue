## 🚀 Panduan Instalasi Revue

Selamat datang di **Revue**! 🎉
Panduan ini akan membantumu menjalankan project Revue secara lokal dengan lancar, bahkan kalau ini pertama kalinya kamu setup project Laravel.

---

## 📌 Prasyarat

Pastikan perangkatmu sudah terinstal:

* **PHP >= 8.1**
* **Composer**
* **MySQL / MariaDB**
* **Node.js & NPM** (disarankan Node 18+)
* **Web Server** (Laragon / XAMPP / Laravel Built-in Server)
* **Git**

> 💡 *Tips:* Laragon sangat direkomendasikan untuk Windows karena setup-nya simpel.

---

## 📥 1. Clone Repository

```bash
git clone https://github.com/username-kamu/revue.git
cd revue
```

---

## 📦 2. Install Dependency Backend (Laravel)

```bash
composer install
```

Jika terjadi error, pastikan `php.ini` mengaktifkan extension berikut:

* `openssl`
* `pdo_mysql`
* `mbstring`
* `fileinfo`

---

## 📦 3. Install Dependency Frontend

```bash
npm install
```

---

## ⚙️ 4. Konfigurasi Environment

Salin file environment:

```bash
cp .env.example .env
```

Lalu generate application key:

```bash
php artisan key:generate
```

---

## 🗄️ 5. Konfigurasi Database

Buka file `.env` lalu sesuaikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=revue
DB_USERNAME=root
DB_PASSWORD=
```

Buat database baru dengan nama **revue** melalui phpMyAdmin atau MySQL CLI.

---

## 🧱 6. Migrasi & Seeder Database

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan db:seed
```

> ⚠️ Jika terjadi error foreign key, pastikan urutan migrasi benar atau database bersih.

---

## 🎨 7. Compile Asset Frontend

```bash
npm run dev
```

Atau untuk production:

```bash
npm run build
```

---

## ▶️ 8. Menjalankan Aplikasi

### Opsi A: Laravel Built-in Server

```bash
php artisan serve
```

Akses di browser:

```
http://127.0.0.1:8000
```

### Opsi B: Laragon / XAMPP

Arahkan document root ke folder `public/`.

---

## 🔐 Akun Default (Jika Ada Seeder)

```text
Admin:
Email    : admin@revue.test
Password : password
```

---

## 🛠️ Troubleshooting Umum

**❌ Error key not set**

```bash
php artisan key:generate
```

**❌ Storage tidak bisa diakses**

```bash
php artisan storage:link
```

**❌ Permission error (Linux / Mac)**

```bash
chmod -R 775 storage bootstrap/cache
```

---

## 🧩 Struktur Project

Berikut struktur utama folder pada project **Revue**:

```bash
revue/
├── app/                # Logic utama aplikasi (Controller, Model, Middleware)
├── bootstrap/          # Bootstrap Laravel
├── config/             # File konfigurasi aplikasi
├── database/           # Migration, Seeder, Factory
├── public/             # Asset publik (CSS, JS, Image)
├── resources/          # Blade view, CSS, JS source
│   ├── views/          # Tampilan Blade
│   └── css & js        # Asset frontend
├── routes/             # Routing web & API
│   └── web.php
├── storage/            # File upload & cache
├── tests/              # Unit & Feature test
├── .env.example        # Contoh environment config
├── composer.json       # Dependency PHP
├── package.json        # Dependency frontend
└── artisan             # CLI Laravel
```

---

## ⭐ Fitur Utama

✨ **Autentikasi Pengguna**

* Register & Login custom
* Validasi form
* Notifikasi sukses & error

📚 **Manajemen Review Buku & Film**

* Tambah, edit, hapus review
* Rating personal
* Kategori buku & film

👤 **Profil Pengguna**

* Informasi akun
* Riwayat review

🛠️ **Role Management**

* User & Admin
* Hak akses berbeda

🎨 **UI Responsif**

* Desain modern
* User-friendly
* Implementasi dari Figma

---

## 🔄 Alur CRUD Berdasarkan Fitur

Bagian ini menjelaskan **di mana letak proses Create, Read, Update, Delete (CRUD)** untuk tiap fitur utama pada project **Revue**, agar mudah dipahami oleh developer lain maupun dosen penguji.

---

### 🔐 Autentikasi Pengguna

📁 **Controller**

```bash
app/Http/Controllers/Auth/
├── LoginController.php      # Login (Read session user)
├── RegisterController.php   # Register (Create user)
└── LogoutController.php     # Logout (Delete session)
```

📁 **Model**

```bash
app/Models/User.php
```

📁 **View**

```bash
resources/views/auth/
├── login.blade.php
└── register.blade.php
```

📁 **Route**

```bash
routes/web.php
```

---

### 📚 Review Buku & Film

📁 **Controller**

```bash
app/Http/Controllers/ReviewController.php
```

CRUD yang ditangani:

* **Create** → `store()` (menambah review)
* **Read** → `index()`, `show()` (menampilkan daftar & detail review)
* **Update** → `update()` (mengedit review)
* **Delete** → `destroy()` (menghapus review)

📁 **Model**

```bash
app/Models/Review.php
app/Models/Book.php
app/Models/Movie.php
```

📁 **View**

```bash
resources/views/reviews/
├── index.blade.php   # Read
├── create.blade.php  # Create
├── edit.blade.php    # Update
└── show.blade.php    # Detail
```

📁 **Route**

```php
Route::resource('reviews', ReviewController::class);
```

---

### 👤 Profil Pengguna

📁 **Controller**

```bash
app/Http/Controllers/ProfileController.php
```

CRUD yang ditangani:

* **Read** → `index()` / `show()` (menampilkan profil)
* **Update** → `update()` (mengubah data pengguna)

📁 **Model**

```bash
app/Models/User.php
```

📁 **View**

```bash
resources/views/profile/
├── index.blade.php
└── edit.blade.php
```

---

### 🛠️ Role & Admin Management

📁 **Controller**

```bash
app/Http/Controllers/Admin/
└── UserManagementController.php
```

CRUD yang ditangani:

* **Read** → Melihat seluruh user
* **Update** → Mengubah role user
* **Delete** → Menghapus user

📁 **Model**

```bash
app/Models/User.php
```

📁 **View**

```bash
resources/views/admin/users/
├── index.blade.php
└── edit.blade.php
```

📁 **Middleware**

```bash
app/Http/Middleware/IsAdmin.php
```

---

## 🎨 **Desain Figma Bisa Dilihat Disini!**

Link: [https://www.figma.com/design/VkQ3iz3qT775RdANxI33uf/REVUE_KELOMPOK-7?node-id=0-1&t=Ppo0IQj8rnlrxMlV-1](https://www.figma.com/design/VkQ3iz3qT775RdANxI33uf/REVUE_KELOMPOK-7?node-id=0-1&t=Ppo0IQj8rnlrxMlV-1)

---

## 📎 **Kontak Developer**

Instagram: **@deuphanide**
Email: **[ratnadevanida08@gmail.com](mailto:ratnadevanida08@gmail.com)**

Instagram: **@just.alfii**
Email: **[alfiperdiansyah@gmail.com](mailto:alfiperdiansyah@gmail.com)**

Instagram: **@rakapaksisp**
Email: **[rakapsatryaputra@gmail.com](mailto:rakapsatryaputra@gmail.com)**

---

## 📜 **Lisensi**

Proyek ini dirilis dengan lisensi **Copyright © 2025 by Kelompok 7 PAW TI-A**.

---

## ✨ Penutup
Terima kasih sudah menggunakan **Revue** ❤️
