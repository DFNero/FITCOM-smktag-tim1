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
  <title>CRUD TIM 1 - Sistem Manajemen Produk</title>

  <style>

    :root { --primary:#667eea; --secondary:#764ba2; --danger:#f56565; --success:#48bb78; --radius:14px; --transition:all .3s ease; }
    body { font-family: Tahoma, sans-serif; background:linear-gradient(135deg,#f5f7fa,#c3cfe2); min-height:100vh; }
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

    .dark-mode {
      background: #1a202c !important;
      color: #f7fafc;
    }

    .dark-mode .text-muted {
      color: #f8f9fa !important;
    }

    #themeIcon svg {
      color: white !important;
    }

    body {
      user-select: none;       
    }

    /* Hidupin lagi khusus table */
    table {
      user-select: text;       
    }


  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
          <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
        </svg>
        SMKTAG CRUD TIM 1
      </a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
      </button>
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <span class="nav-link text-white" id="darkModeToggle">
              <span id="themeIcon">
                <!-- moon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                  <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                </svg>
              </span>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main -->
  <div class="container py-4">
    <div class="text-center mb-4">
      <h1 class="hero-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-database-fill" id="themeIcon" viewBox="0 0 16 16">
          <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223"/>
          <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972"/>
          <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972"/>
          <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972"/>
        </svg>
        Sistem Manajemen Produk
      </h1>
      <p class="text-muted">Kelola produk anda dengan mudah, cepat, dan modern.</p>
    </div>

    <div class="modern-card p-3">
      <div class="row g-2 align-items-center mb-3">
        <div class="col-md-6 d-flex align-items-center gap-2">
          <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z"/>
            </svg>
            Data Produk
          </h5>
          <span class="badge bg-primary"><?= count($produks) ?> Produk</span>
        </div>
        <div class="col-md-6 d-flex gap-2">
          <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari produk...">
          <a href="index.php?url=produk/tambah" class="btn btn-modern btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill-add" viewBox="0 0 16 16">
              <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/>
              <path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905"/>
            </svg>
            Tambah
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
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-440h240v-160H200v160Zm0-240h560v-80H200v80Zm0 560q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v252q-19-8-39.5-10.5t-40.5.5q-21 4-40.5 13.5T684-479l-39 39-205 204v116H200Zm0-80h240v-160H200v160Zm320-240h125l39-39q16-16 35.5-25.5T760-518v-82H520v160Zm0 360v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T863-300L643-80H520Zm300-263-37-37 37 37ZM580-140h38l121-122-37-37-122 121v38Zm141-141-19-18 37 37-18-19Z"/></svg>
                </a>
                <a href="index.php?url=produk/hapus/<?= $produk['id']; ?>" onclick="return confirm('Yakin hapus produk ini?');" class="btn btn-sm btn-delete btn-modern">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/></svg>
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
    document.getElementById('searchInput').addEventListener('keyup', function() {
      let filter = this.value.toLowerCase();
      document.querySelectorAll("#produkTable tbody tr").forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? "" : "none";
      });
    });
  </script>
  <script src="../public/assets/js/theme.js"></script>
</body>
</html>
