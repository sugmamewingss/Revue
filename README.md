# 🎬📚 **REVUE** — Platform Review Buku & Film

Revue adalah aplikasi web berbasis **Laravel** yang berfungsi sebagai platform sosial komunitas untuk **menulis, membaca, dan mengelola review serta rating buku dan film** secara personal dan interaktif. Proyek ini dibangun dengan arsitektur **MVC (Model–View–Controller)**, sistem autentikasi custom, serta database relasional **MySQL/MariaDB**.

---

## 🚀 **Fitur Utama**

* 🔐 **Autentikasi Pengguna** (Register, Login, Logout)
* 👤 **Manajemen Profil User**
* ✍️ **CRUD Review Buku & Film**
* ⭐ **Sistem Rating**
* 💬 **Komentar pada Review**
* 🗂️ **Kategori Buku & Film**
* 🔎 **Pencarian Review**
* 🎨 **UI Modern (berdasarkan desain Figma)**

---

## 🧩 **Struktur Project**

Berikut struktur utama project Revue:

```bash
revue/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Logic CRUD & alur aplikasi
│   │   ├── Middleware/
│   ├── Models/                 # Model Eloquent (User, Review, dll)
│
├── database/
│   ├── migrations/             # Struktur tabel database
│   ├── seeders/                # Data dummy (opsional)
│
├── resources/
│   ├── views/                  # Blade templates (UI)
│   │   ├── auth/
│   │   ├── reviews/
│   │   ├── layouts/
│   │   └── components/
│
├── routes/
│   ├── web.php                 # Routing utama aplikasi
│
├── public/                     # Asset publik (CSS, JS, Image)
├── .env                        # Konfigurasi environment
├── composer.json
└── README.md
```

---

## ⚙️ **Panduan Instalasi & Setup Project**

Ikuti langkah-langkah berikut untuk menjalankan project secara lokal:

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/revue.git
cd revue
```

### 2️⃣ Install Dependency Backend

Pastikan **Composer** sudah ter-install.

```bash
composer install
```

### 3️⃣ Install Dependency Frontend (Jika Ada)

```bash
npm install
npm run dev
```

### 4️⃣ Konfigurasi Environment

Salin file `.env.example` menjadi `.env`

```bash
cp .env.example .env
```

Atur konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=revue
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ Generate App Key

```bash
php artisan key:generate
```

### 6️⃣ Migrasi Database

```bash
php artisan migrate
```

*(Opsional – jika tersedia seeder)*

```bash
php artisan db:seed
```

### 7️⃣ Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di browser:
👉 `http://127.0.0.1:8000`

---

## 🔄 **Penjelasan Letak CRUD Berdasarkan Fitur**

### 👤 **CRUD User & Autentikasi**

* **Controller**: `app/Http/Controllers/Auth/`
* **Model**: `app/Models/User.php`
* **View**: `resources/views/auth/`
* **Route**: `routes/web.php`

Fungsi:

* Register User
* Login & Logout
* Update Profil

---

### ✍️ **CRUD Review Buku & Film**

* **Controller**: `app/Http/Controllers/ReviewController.php`
* **Model**: `app/Models/Review.php`
* **View**: `resources/views/reviews/`
* **Route**: `routes/web.php`

Fungsi:

* Create Review
* Read Review (List & Detail)
* Update Review
* Delete Review

---

### ⭐ **Rating Review**

* **Controller**: `app/Http/Controllers/RatingController.php`
* **Model**: `app/Models/Rating.php`
* **Relasi**: `User ↔ Review`

---

### 💬 **Komentar Review**

* **Controller**: `app/Http/Controllers/CommentController.php`
* **Model**: `app/Models/Comment.php`
* **View**: `resources/views/reviews/show.blade.php`

---

### 🗂️ **Kategori Buku & Film**

* **Controller**: `app/Http/Controllers/CategoryController.php`
* **Model**: `app/Models/Category.php`
* **View**: `resources/views/categories/`

---

## 🎨 **Desain Figma Bisa Dilihat Disini!**

Link:
👉 [https://www.figma.com/design/VkQ3iz3qT775RdANxI33uf/REVUE_KELOMPOK-7?node-id=0-1&t=Ppo0IQj8rnlrxMlV-1](https://www.figma.com/design/VkQ3iz3qT775RdANxI33uf/REVUE_KELOMPOK-7?node-id=0-1&t=Ppo0IQj8rnlrxMlV-1)

---

## 🎬 **Review Fitur pada Revue!**

Link:
👉 https://drive.google.com/file/d/1Rt4_s-nnZM45RWlzEOHV1wlyJ8X1QIvr/view?usp=sharing

---

## 📎 **Kontak Developer**

**Instagram:** @deuphanide
**Email:** [ratnadevanida08@gmail.com](mailto:ratnadevanida08@gmail.com)

**Instagram:** @just.alfii
**Email:** [alfiperdiansyah@gmail.com](mailto:alfiperdiansyah@gmail.com)

**Instagram:** @rakapaksisp
**Email:** [rakapsatryaputra@gmail.com](mailto:rakapsatryaputra@gmail.com)

---

## 📜 **Lisensi**

Proyek ini dirilis dengan lisensi:

**Copyright © 2025 by Kelompok 7 PAW TI-A**

---

✨ Dibuat dengan Laravel, kopi, dan deadline ✨
