<?php
class Produk {
    private $conn;
    private $table = "produk";

    public $id;
    public $kode;
    public $nama;
    public $satuan;
    public $harga;
    public $gambar;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua produk
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil produk by ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah produk baru
    public function insert() {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table} (kode, nama, satuan, harga, gambar) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$this->kode, $this->nama, $this->satuan, $this->harga, $this->gambar]);
    }

    // Update produk
    public function update() {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table} 
            SET kode=?, nama=?, satuan=?, harga=?, gambar=? 
            WHERE id=?
        ");
        return $stmt->execute([$this->kode, $this->nama, $this->satuan, $this->harga, $this->gambar, $this->id]);
    }

    // Hapus produk
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
