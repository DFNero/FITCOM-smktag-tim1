<?php 
require 'koneksi.php';

if (isset($_POST['submit'])) {
  if (tambah($_POST) > 0) {
    echo "<script>alert('Produk berhasil ditambahkan');document.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Produk gagal ditambahkan');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <title>Tambah Produk</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #5665a7ff, #baa6cfff);
      min-height: 100vh;
    }
    .card {
      border-radius: 20px;
      backdrop-filter: blur(12px);
      background: rgba(255,255,255,0.9);
    }
    .dark-mode {
      background: #1a202c !important;
      color: #f7fafc !important;
    }
    .dark-mode .card {
      background: rgba(45,55,72,0.9);
      color: white;
    }
    .form-control, .input-group-text {
      border-radius: 12px;
    }
    .form-label {
      font-weight: 600;
      color: #4a5568;
    }
    .dark-mode .form-label { color: #cbd5e0; }
    .btn-custom {
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-save {
      background: #48bb78;
      color: white;
    }
    .btn-save:hover {
      background: #38a169;
    }
    .btn-cancel {
      border: 2px solid #a0aec0;
      color: #4a5568;
    }
    .btn-cancel:hover {
      background: #edf2f7;
    }
    .image-preview {
      max-height: 120px;
      margin-top: 10px;
      border-radius: 12px;
      display: none;
    }
    .dark-toggle {
      cursor: pointer;
      color: white;
      font-size: 1.4rem;
      position: absolute;
      top: 20px;
      right: 20px;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

  <!-- Dark Mode Toggle -->
  <i class="fas fa-moon dark-toggle" id="darkModeToggle"></i>

  <div class="card shadow-lg p-4" style="max-width: 550px; width: 100%;">
    <div class="card-header text-center bg-transparent border-0 mb-3">
      <h3 class="fw-bold text-primary"><i class="fas fa-plus-circle me-2"></i>Tambah Produk</h3>
    </div>
    <div class="card-body">

      <form method="POST" enctype="multipart/form-data">

        <!-- Kode Produk -->
        <div class="mb-3">
          <label for="kode" class="form-label">Kode Produk</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode produk" required>
          </div>
        </div>

        <!-- Nama Produk -->
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Produk</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-box"></i></span>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama produk" required>
          </div>
        </div>

        <!-- Satuan -->
        <div class="mb-3">
          <label for="satuan" class="form-label">Satuan</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="pcs, kg, liter" required>
          </div>
        </div>

        <!-- Harga -->
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga produk" required>
          </div>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar Produk</label>
          <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)" required>
          <img id="preview" class="image-preview mt-2" alt="Preview">
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index.php" class="btn btn-cancel btn-custom px-4"><i class="fas fa-times me-2"></i>Batal</a>
          <button type="submit" name="submit" class="btn btn-save btn-custom px-4"><i class="fas fa-save me-2"></i>Simpan</button>
        </div>
      </form>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // Dark Mode Toggle
    document.getElementById('darkModeToggle').addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');
      this.classList.toggle('fa-moon');
      this.classList.toggle('fa-sun');
    });

    // Image Preview
    function previewImage(event) {
      const preview = document.getElementById('preview');
      preview.style.display = 'block';
      preview.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
</body>
</html>
