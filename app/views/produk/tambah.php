<?php
// app/views/produk/tambah.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">

<title>Tambah Produk</title>
<style>
body { font-family: Tahoma, sans-serif; background: linear-gradient(135deg, #5665a7ff, #baa6cfff); min-height: 100vh;
  background-repeat: no-repeat;   
  background-size: cover;      
  background-position: center;    
  background-attachment: fixed; }
.card { border-radius: 20px; backdrop-filter: blur(12px); background: rgba(255,255,255,0.9); }
.dark-mode { background: #1a202c !important; color: #f7fafc !important; }
.dark-mode .card { background: rgba(45,55,72,0.9); color: white; }
.form-control, .input-group-text { border-radius: 12px; }
.form-label { font-weight: 600; color: #4a5568; }
.dark-mode .form-label { color: #cbd5e0; }
.btn-custom { border-radius: 12px; font-weight: 600; transition: all 0.3s ease; }
.btn-save { background: #48bb78; color: white; }
.btn-save:hover { background: #38a169; }
.btn-cancel { border: 2px solid #a0aec0; color: #4a5568; }
.btn-cancel:hover { background: #edf2f7; }
.image-preview { max-height: 120px; margin-top: 10px; border-radius: 12px; display: none; }
.dark-toggle { cursor: pointer; color: white; font-size: 1.4rem; position: absolute; top: 20px; right: 20px; }

.btn-cancel:hover {
  color: black !important;
}

#themeIcon svg {
  color: white !important;
}

</style>
</head>
<body>

<span id="darkModeToggle" class="dark-toggle" style="z-index:1050;">
  <span id="themeIcon">
    <!-- moon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
      class="bi bi-moon-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 
      3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 
      0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 
      0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
    </svg>
  </span>
</span>


<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">


<div class="card shadow-lg p-4" style="max-width: 550px; width: 100%;">
  <div class="card-header text-center bg-transparent border-0 mb-3">
      <h3 class="fw-bold text-primary d-inline-flex align-items-center justify-content-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
         <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
        </svg>
        Tambah Produk
      </h3>
    </div>

    <form method="POST" enctype="multipart/form-data">
      <!-- Kode Produk -->
      <div class="mb-3">
        <label for="kode" class="form-label">Kode Produk</label>
        <div class="input-group">
          <span class="input-group-text"><img src="../public/assets/icons/upc.svg" style="width: 20px;"></span>
          <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode produk" required>
        </div>
      </div>

      <!-- Nama Produk -->
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <div class="input-group">
          <span class="input-group-text"><img src="../public/assets/icons/box.svg" style="width: 20px;"></span>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama produk" required>
        </div>
      </div>

      <!-- Satuan -->
      <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <div class="input-group">
          <span class="input-group-text"><img src="../public/assets/icons/boxes.svg" style="width: 20px;"></span>
          <input type="text" class="form-control" id="satuan" name="satuan" placeholder="pcs, kg, liter" required>
        </div>
      </div>

      <!-- Harga -->
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga produk" style="width: 20px;" required>
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
        <a href="../public" class="btn btn-cancel btn-custom px-4 d-flex align-items-center justify-content-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg>
          <span>Batal</span>
        </a>

       <button type="submit" name="submit" class="btn btn-save btn-custom px-4 d-flex align-items-center justify-content-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-floppy2-fill" viewBox="0 0 16 16">
          <path d="M12 2h-2v3h2z"/>
          <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v13A1.5 1.5 0 0 0 1.5 16h13a1.5 1.5 0 0 0 1.5-1.5V2.914a1.5 1.5 0 0 0-.44-1.06L14.147.439A1.5 1.5 0 0 0 13.086 0zM4 6a1 1 0 0 1-1-1V1h10v4a1 1 0 0 1-1 1zM3 9h10a1 1 0 0 1 1 1v5H2v-5a1 1 0 0 1 1-1"/>
        </svg>  
        <span>Simpan</span>
      </button>

      </div>
    </form>

  </div>
</div>

<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
<script>
function previewImage(event) {
  const preview = document.getElementById('preview');
  preview.style.display = 'block';
  preview.src = URL.createObjectURL(event.target.files[0]);
}
</script>
<script src="../public/assets/js/theme.js"></script>
</body>
</html>
