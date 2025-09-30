<?php
// public/index.php
require_once "../app/controllers/ProdukController.php";

$controller = new ProdukController();

// Ambil route dari query string
$uri = $_GET['url'] ?? '';

// Routing sederhana
if (preg_match("/^produk\/edit\/(\d+)$/", $uri, $matches)) {
    $controller->edit($matches[1]);
} elseif ($uri === 'produk/tambah') {
    $controller->tambah();
} elseif (preg_match("/^produk\/hapus\/(\d+)$/", $uri, $matches)) {
    $controller->hapus($matches[1]);
} else {
    $controller->index();
}
