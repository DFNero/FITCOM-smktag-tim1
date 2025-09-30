<?php
// app/views/produk/edit.php
// $produk dikirim dari controller
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<title>Edit Produk</title>
<style>
body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #4fc29eff, #9fbbd8ff); min-height: 100vh; }
.card { border-radius: 20px; backdrop-filter: blur(12px); background: rgba(255,255,255,0.9); }
.dark-mode { background: #1a202c !important; color: #f7fafc !important; }
.dark-mode .card { background: rgba(45,55,72,0.9); color: white; }
.form-control, .input-group-text { border-radius: 12px; }
.form-label { font-weight: 600; color: #4a5568; }
.dark-mode .form-label { color: #cbd5e0; }
.btn-custom { border-radius: 12px; font-weight: 600; transition: all 0.3s ease; }
.btn-update { background: #48bb78; color: white; }
.btn-update:hover { background: #38a169; }
.btn-cancel { border: 2px solid #a0aec0; color: #4a5568; }
.btn-cancel:hover { background: #edf2f7; }
.image-preview { max-height: 120px; margin-top: 10px; border-radius: 12px; display: block; }
.dark-toggle { cursor: pointer; color: white; font-size: 1.4rem; position: absolute; top: 20px; right: 20px; }
    /* Dark mode global */
    .dark-mode {
      background: #1a202c !important;
      color: #f7fafc; /* teks default jadi putih */
    }

    /* Khusus text-muted biar putih di dark */
    .dark-mode .text-muted {
      color: #f8f9fa !important;
    }

    .btn-cancel:hover {
    color: black !important;
    }

</style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<i class="fas fa-moon dark-toggle" id="darkModeToggle"></i>

<div class="card shadow-lg p-4" style="max-width: 550px; width: 100%;">
  <div class="card-header text-center bg-transparent border-0 mb-3">
    <h3 class="fw-bold text-success"><i class="fas fa-pen-to-square me-2"></i>Edit Produk</h3>
  </div>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $produk['id']; ?>">

      <div class="mb-3">
        <label for="kode" class="form-label">Kode Produk</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-barcode"></i></span>
          <input type="text" class="form-control" id="kode" name="kode" value="<?= $produk['kode']; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-box"></i></span>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk['nama']; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-cubes"></i></span>
          <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $produk['satuan']; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk['harga']; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
        <small class="text-muted">Gambar saat ini: <span class="fw-semibold"><?= $produk['gambar']; ?></span></small>
        <img id="preview" class="image-preview mt-2" src="/FITCOM-webPRO-tim1/public/assets/img/<?= $produk['gambar']; ?>" alt="Preview">
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="../public" class="btn btn-cancel btn-custom px-4"><i class="fas fa-times me-2"></i>Batal</a>
        <button type="submit" class="btn btn-update btn-custom px-4"><i class="fas fa-save me-2"></i>Update</button>
      </div>
    </form>
  </div>
</div>

<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click', function() {
  document.body.classList.toggle('dark-mode');
  this.classList.toggle('fa-moon');
  this.classList.toggle('fa-sun');
});

function previewImage(event) {
  const preview = document.getElementById('preview');
  preview.style.display = 'block';
  preview.src = URL.createObjectURL(event.target.files[0]);
}
</script>
</body>
</html>

