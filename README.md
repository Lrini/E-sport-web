🕹️ E-sport Web
Proyek E-sport Web adalah aplikasi berbasis Laravel 8 yang digunakan untuk mengelola data acara e-sport. Aplikasi ini sudah dilengkapi dengan CRUD menggunakan modal, integrasi DataTables untuk menampilkan data secara interaktif, serta tampilan berbasis Tailwind CSS.

✨ Fitur Utama
📌 Halaman Acara: CRUD (Create, Read, Update, Delete) dengan modal.

📊 DataTables: Menampilkan data acara dengan fitur pencarian, sorting, dan pagination.

🔐 Login & Auth: Sistem login dan autentikasi dasar.

🎨 Tailwind CSS: Tampilan modern dan responsif.

⚙️ Laravel Framework: Struktur MVC yang rapi dan mudah dikembangkan.

📂 Struktur Proyek
app/ → Logic aplikasi (controller, model).

resources/views/ → Tampilan Blade (halaman acara, login, dll).

routes/web.php → Routing aplikasi.

public/ → Asset publik (CSS, JS).

database/ → Migrasi dan seeding.

🚀 Instalasi
Clone repository:

bash
git clone https://github.com/Lrini/E-sport-web.git
cd E-sport-web
Install dependencies:

bash
composer install
npm install && npm run dev
Copy file .env.example menjadi .env:

bash
cp .env.example .env
Generate key aplikasi:

bash
php artisan key:generate
Setup database di .env, lalu jalankan migrasi:

bash
php artisan migrate
Jalankan server:

bash
php artisan serve
🖥️ Penggunaan
Buka http://127.0.0.1:8000 di browser.

Login menggunakan akun yang sudah dibuat.

Kelola data acara melalui halaman Acara.

Tambah data menggunakan modal form.

Data akan otomatis tampil di DataTables dengan fitur pencarian dan sorting.

🛠️ Teknologi yang Digunakan
Laravel 8

PHP

JavaScript

Blade Template

Tailwind CSS

Yajra DataTables
