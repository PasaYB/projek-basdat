<div style="font-family: sans-serif; line-height: 1.6;">

  <h1 style="font-size: 28px; margin-bottom: 10px;">🍽️ Sistem Pengelolaan Stok Restoran (Implementasi Basis Data + Laravel)</h1>

  <p>
    Aplikasi berbasis <strong>Laravel</strong> yang dikembangkan untuk memenuhi tugas mata kuliah 
    <strong>Implementasi Basis Data</strong>.  
    Proyek ini mengimplementasikan sistem pengelolaan stok restoran yang dirancang untuk memperbaiki 
    pencatatan bahan baku yang selama ini masih dilakukan secara manual.
  </p>

  <h2>📌 Latar Belakang Studi Kasus</h2>
  <p>
    Pengelolaan stok di restoran masih banyak dilakukan secara manual, sehingga sering terjadi:
  </p>
  <ul>
    <li>Kesalahan pencatatan atau kehilangan data.</li>
    <li>Duplikasi data pada bahan baku.</li>
    <li>Kesulitan melacak riwayat bahan masuk dan keluar.</li>
    <li>Pembuatan laporan yang lama dan tidak akurat.</li>
  </ul>

  <p>
    Maka dibutuhkan sebuah <strong>basis data terstruktur</strong> dan aplikasi pendukung untuk:
  </p>
  <ul>
    <li>Memastikan data lebih akurat dan konsisten.</li>
    <li>Mengotomatiskan pencatatan transaksi.</li>
    <li>Melacak stok secara lebih jelas.</li>
    <li>Menghasilkan laporan dengan cepat dan dapat diaudit.</li>
  </ul>

  <h2>✨ Tujuan & Fungsionalitas Sistem</h2>
  <p>
    Aplikasi ini dibuat menggunakan <strong>Laravel</strong> untuk mempermudah integrasi basis data, logika bisnis, 
    dan pengelolaan data dalam satu sistem terstruktur.  
    Fitur utama meliputi:
  </p>
  <ul>
    <li><strong>Pencatatan Bahan Masuk</strong> — termasuk jumlah, tanggal, dan harga dihitung otomatis.</li>
    <li><strong>Pencatatan Bahan Keluar</strong> — mencatat penggunaan bahan dan mengurangi stok.</li>
    <li><strong>Manajemen Stok</strong> — stok bertambah dan berkurang sesuai transaksi.</li>
    <li><strong>Perhitungan Harga</strong> — sistem menghitung total biaya bahan masuk secara otomatis.</li>
    <li><strong>Integrasi Basis Data</strong> — memanfaatkan migration, model, dan relasi Laravel.</li>
  </ul>

  <h2>🛠️ Teknologi yang Digunakan</h2>
  <ul>
    <li><strong>Laravel</strong> — framework backend utama.</li>
    <li><strong>MySQL / MariaDB</strong> — basis data penyimpanan.</li>
    <li><strong>Blade Template</strong> — tampilan frontend sederhana.</li>
    <li>Migration, Seeder, Model, dan Controller Laravel.</li>
  </ul>

  <h2>📁 Isi & Struktur Proyek</h2>
  <ul>
    <li>Migration tabel bahan baku, transaksi masuk, transaksi keluar.</li>
    <li>Model Laravel yang merepresentasikan entitas basis data.</li>
    <li>Controller untuk pengelolaan transaksi dan stok.</li>
    <li>Blade View untuk input data dan tampilan laporan sederhana.</li>
    <li>Dokumentasi logika dan struktur data.</li>
  </ul>

  <h2>🚀 Cara Menggunakan</h2>

  <h3>1. Clone Repository</h3>
  <pre style="background:#f6f8fa;padding:12px;border-radius:6px;">
git clone https://github.com/PasaYB/projek-basdat
cd projek-basdat
  </pre>

  <h3>2. Install Dependencies Laravel</h3>
  <pre style="background:#f6f8fa;padding:12px;border-radius:6px;">
composer install
npm install
  </pre>

  <h3>3. Setup Environment</h3>
  <pre style="background:#f6f8fa;padding:12px;border-radius:6px;">
cp .env.example .env
php artisan key:generate
  </pre>

  <h3>4. Migrasi Database</h3>
  <pre style="background:#f6f8fa;padding:12px;border-radius:6px;">
php artisan migrate
  </pre>

  <h3>5. Jalankan Server</h3>
  <pre style="background:#f6f8fa;padding:12px;border-radius:6px;">
php artisan serve
  </pre>

  <p>Akses aplikasi melalui:<br>
    <code>http://localhost:8000</code>
  </p>

  <h2>📌 Status Revisi (Penting)</h2>
  <p>
    Saat ini terdapat revisi terkait <strong>integrasi tracking stok</strong>:
  </p>
  <ul>
    <li>Data stok <strong>belum sepenuhnya dapat ditracking otomatis</strong> berdasarkan riwayat transaksi.</li>
    <li>Fitur integrasi transaksi ➝ stok <strong>belum diperbaiki / ditambahkan</strong>.</li>
    <li>Update akan dilakukan untuk memperbaiki alur perhitungan stok.</li>
  </ul>

  <div style="
      background:#fff3cd;
      border-left:6px solid #ffca2c;
      padding:12px 16px;
      margin:20px 0;
      border-radius:4px;
    ">
    <strong>Status Revisi:</strong> 🔧 <em>Done</em>
    <strong>Fitur Selanjutnya:</strong> <em>Slug URL, Stock record tracking details</em>
  </div>

  <hr>

</div>
