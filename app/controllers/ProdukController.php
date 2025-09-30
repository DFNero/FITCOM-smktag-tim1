<?php
require_once "../config/database.php";
require_once "../app/models/Produk.php";

class ProdukController {
    private $db;
    private $produk;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->produk = new Produk($this->db);
    }

    // List semua produk
    public function index() {
        $produks = $this->produk->getAll();
        require __DIR__ . '/../views/produk/index.php';
    }

    // Tambah produk baru
    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produk->kode   = $_POST['kode'];
            $this->produk->nama   = $_POST['nama'];
            $this->produk->satuan = $_POST['satuan'];
            $this->produk->harga  = $_POST['harga'];

            // Handle upload gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
                $namaFile  = uniqid() . "_" . basename($_FILES['gambar']['name']);
                $tmpName   = $_FILES['gambar']['tmp_name'];

                // Path absolut ke folder public/assets/img
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/FITCOM-webPRO-tim1/public/assets/img/";

                // Pastikan folder ada
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Pindahkan file
                if (move_uploaded_file($tmpName, $targetDir . $namaFile)) {
                    $this->produk->gambar = $namaFile;
                } else {
                    die("⚠️ Gagal upload gambar ke folder: " . $targetDir);
                }
            } else {
                $this->produk->gambar = null;
            }

            $this->produk->insert();
            header("Location: index.php");
            exit;
        }
        include "../app/views/produk/tambah.php";
    }

    // Edit produk
    public function edit($id) {
        $produk = $this->produk->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produk->id     = $id;
            $this->produk->kode   = $_POST['kode'];
            $this->produk->nama   = $_POST['nama'];
            $this->produk->satuan = $_POST['satuan'];
            $this->produk->harga  = $_POST['harga'];

            // Handle upload gambar baru
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
                $namaFile  = uniqid() . "_" . basename($_FILES['gambar']['name']);
                $tmpName   = $_FILES['gambar']['tmp_name'];

                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/FITCOM-webPRO-tim1/public/assets/img/";

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($tmpName, $targetDir . $namaFile)) {
                    $this->produk->gambar = $namaFile;
                } else {
                    die("⚠️ Gagal upload gambar ke folder: " . $targetDir);
                }
            } else {
                // Kalau tidak ada upload baru, pakai gambar lama
                $this->produk->gambar = $produk['gambar'];
            }

            $this->produk->update();
            header("Location: index.php");
            exit;
        }
        include "../app/views/produk/edit.php";
    }

    // Hapus produk
    public function hapus($id) {
        $this->produk->delete($id);
        header("Location: index.php");
        exit;
    }
}
