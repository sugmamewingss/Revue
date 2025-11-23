---

# **Revue — Social Review Platform (Laravel Web App)**

Revue adalah aplikasi web berbasis Laravel yang dikembangkan sebagai platform komunitas untuk menulis, membaca, dan mengelola ulasan serta rating buku maupun film. Aplikasi ini dirancang responsif, mudah diinstal, dan cocok untuk mahasiswa, komunitas, serta pengguna umum yang ingin berbagi rekomendasi secara personal dan interaktif.

---

## 🎨 **Desain Figma Bisa Dilihat Disini!**
Link: https://www.figma.com/design/VkQ3iz3qT775RdANxI33uf/REVUE_KELOMPOK-7?node-id=0-1&t=Ppo0IQj8rnlrxMlV-1

---

## 🚀 **Fitur Utama**

### **1. Autentikasi Custom**

* Registrasi & login dengan validasi form.
* Notifikasi sukses/gagal.
* Tampilan UI mengikuti desain Figma (landing page, login, register).

### **2. Manajemen Profil Pengguna**

* Edit profil dan preferensi.
* Mengatur genre favorit.
* Mengelola koleksi buku/film pribadi.

### **3. CRUD Ulasan & Koleksi**

* Tambah, baca, edit, dan hapus ulasan.
* Mendukung ulasan untuk buku maupun film.
* Rating personal untuk setiap item.

### **4. Dashboard Aktivitas**

* Menampilkan daftar ulasan pengguna.
* Menunjukkan perkembangan koleksi dan aktivitas terbaru.

### **5. UI & UX**

* Blade template untuk modularisasi tampilan.
* Custom CSS untuk gaya visual profesional.
* Responsif di berbagai perangkat.

### **6. Footer Interaktif**

* Tautan langsung ke Instagram developer.

---

## 🧱 **Teknologi & Arsitektur**

* **Laravel Framework** (MVC Architecture)
* **MySQL/MariaDB** (Relational Database)
* **Blade Template Engine**
* **Custom CSS**
* **Resource Controller CRUD**
* **Figma** sebagai dasar desain UI

---

## 📂 **Struktur Proyek (Ringkas)**

```
/app
    /Http
        /Controllers
        /Middleware
/resources
    /views
        /auth
        /components
        /dashboard
        /reviews
/public
    /css
    /js
/database
    /migrations
/routes
    web.php
```

---

## ⚙️ **Instalasi & Setup**

### 1. Clone repository

```bash
git clone https://github.com/username/revue.git
cd revue
```

### 2. Install dependencies

```bash
composer install
npm install && npm run build
```

### 3. Konfigurasi environment

Duplikat file `.env`:

```bash
cp .env.example .env
```

Sesuaikan:

* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

### 4. Generate key

```bash
php artisan key:generate
```

### 5. Migrasi database

```bash
php artisan migrate
```

### 6. Jalankan server

```bash
php artisan serve
```

Aplikasi dapat diakses melalui
**[http://localhost:8000](http://localhost:8000)**

---

## 🧪 **Fitur Pengembangan**

* Mudah dikembangkan berkat pola MVC.
* Resource Controller mempermudah CRUD yang terstruktur.
* Relational database memungkinkan relasi item–genre–review–user.
* Foldering rapi untuk perluasan fitur di masa mendatang.

---

## 🧑‍💻 **Kontribusi**

Kontribusi sangat terbuka!
Silakan:

1. Fork repository
2. Buat branch baru
3. Buat pull request

---

## 📎 **Kontak Developer**

Instagram: **@deuphanide**
Email: **ratnadevanida08@gmail.com**
Instagram: **@just.alfii**
Email: **alfiperdiansyah@gmail.com**
Instagram: **@rakapaksisp**
Email: **rakapsatryaputra@gmail.com**

---

## 📜 **Lisensi**

Proyek ini dirilis dengan lisensi **MIT**.

---
