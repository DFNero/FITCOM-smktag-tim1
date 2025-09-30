<?php
// Pastikan variabel selalu ada agar count() aman
$produks = $produks ?? [];
?>

<!DOCTYPE html>
<html lang="id" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <title>CRUD TIM 1 - Sistem Manajemen Produk</title>

  <style>
    :root { --primary:#667eea; --secondary:#764ba2; --danger:#f56565; --success:#48bb78; --radius:14px; --transition:all .3s ease; }
    body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#f5f7fa,#c3cfe2); min-height:100vh; }
    .navbar { background:linear-gradient(135deg,var(--primary),var(--secondary)); }
    .navbar-brand { font-weight:700; color:#fff!important; }
    .hero-title { font-size:clamp(1.5rem,4vw,2.3rem); font-weight:700; background:linear-gradient(135deg,var(--primary),var(--secondary)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
    .modern-card { border-radius:var(--radius); box-shadow:0 6px 18px rgba(0,0,0,0.1); background:#fff; }
    .modern-table th { background:#f8fafc; font-size:.85rem; text-transform:uppercase; }
    .modern-table td { vertical-align:middle; }
    .product-image { width:100px; height:100px; object-fit:cover; border-radius:8px; display:block; margin:0 auto; }
    .btn-modern { border-radius:8px; font-weight:600; transition:var(--transition); }
    .btn-edit { background:var(--success); color:#fff; }
    .btn-edit:hover { background:#38a169; }
    .btn-delete { background:var(--danger); color:#fff; }
    .btn-delete:hover { background:#c53030; }
    .dark-toggle { cursor:pointer; color:#fff; font-size:1.2rem; }
    .dark-mode { background:#1a202c!important; color:#f7fafc; }
    .dark-mode .modern-card { background:#2d3748; }
    .dark-mode .modern-table th { background:#4a5568; color:#fff; }

    @media screen and (max-width:768px){
      table thead{display:none;}
      table,table tbody,table tr,table td{display:block;width:100%;}
      table tr{margin-bottom:1rem;border:1px solid #ddd;border-radius:12px;padding:12px;background:#fff;box-shadow:0 3px 6px rgba(0,0,0,0.05);}
      table td{text-align:right;padding-left:50%;position:relative;border:none;border-bottom:1px solid #eee;}
      table td:last-child{border-bottom:none;}
      table td::before{content:attr(data-label);position:absolute;left:15px;width:45%;text-align:left;font-weight:600;color:#444;}
      .product-image{width:100%;max-width:220px;height:auto;max-height:180px;margin-bottom:8px;object-fit:cover;}
    }

    /* Dark mode global */
    .dark-mode {
      background: #1a202c !important;
      color: #f7fafc; /* teks default jadi putih */
    }

    /* Khusus text-muted biar putih di dark */
    .dark-mode .text-muted {
      color: #f8f9fa !important;
    }

    

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-cubes me-2"></i>CRUD TIM 1</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <span class="nav-link text-white" id="darkModeToggle"><i class="fas fa-moon"></i></span>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main -->
  <div class="container py-4">
    <div class="text-center mb-4">
      <h1 class="hero-title"><i class="fas fa-boxes me-2"></i>Sistem Manajemen Produk</h1>
      <p class="text-muted">Kelola produk anda dengan mudah, cepat, dan modern.</p>
    </div>

    <div class="modern-card p-3">
      <div class="row g-2 align-items-center mb-3">
        <div class="col-md-6 d-flex align-items-center gap-2">
          <h5 class="mb-0"><i class="fas fa-table me-2"></i>Data Produk</h5>
          <span class="badge bg-primary"><?= count($produks) ?> Produk</span>
        </div>
        <div class="col-md-6 d-flex gap-2">
          <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari produk...">
          <a href="index.php?url=produk/tambah" class="btn btn-modern btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah
          </a>
        </div>
      </div>

      <?php if (!empty($produks)): ?>
      <div class="table-responsive">
        <table class="table modern-table table-hover align-middle mb-0" id="produkTable">
          <thead>
            <tr>
              <th class="text-center">Gambar</th>
              <th class="text-center">Kode</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Satuan</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($produks as $produk): ?>
            <tr>
              <td data-label="Gambar" class="text-center">
               <img src="/FITCOM-webPRO-tim1/public/assets/img/<?= $produk['gambar']; ?>" 
     class="product-image" 
     alt="<?= $produk['nama']; ?>">

              </td>
              <td data-label="Kode" class="text-center"><span class="badge bg-info"><?= $produk['kode']; ?></span></td>
              <td data-label="Nama" class="text-center"><?= $produk['nama']; ?></td>
              <td data-label="Satuan" class="text-center"><?= $produk['satuan']; ?></td>
              <td data-label="Harga" class="text-center fw-bold text-success">Rp <?= number_format($produk['harga'],0,',','.'); ?></td>
              <td data-label="Aksi" class="text-center">
                <a href="index.php?url=produk/edit/<?= $produk['id']; ?>" class="btn btn-sm btn-edit btn-modern">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="index.php?url=produk/hapus/<?= $produk['id']; ?>" onclick="return confirm('Yakin hapus produk ini?');" class="btn btn-sm btn-delete btn-modern">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
        <p class="text-center text-muted mb-0">Belum ada produk.</p>
      <?php endif; ?>
    </div>
  </div>

  <script src="../public/assets/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('darkModeToggle').addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');
      this.querySelector('i').classList.toggle('fa-moon');
      this.querySelector('i').classList.toggle('fa-sun');
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
      let filter = this.value.toLowerCase();
      document.querySelectorAll("#produkTable tbody tr").forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? "" : "none";
      });
    });
  </script>
</body>
</html>
