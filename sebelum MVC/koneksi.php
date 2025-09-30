<?php

$conn = mysqli_connect("localhost", "root", "12345", "farm");

function baca($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function tambah() {
    global $conn;

    $foto = $_POST['gambar'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO Produk VALUES ( 
                NULL, 
                '$foto', 
                '$kode',
                '$nama', 
                '$satuan', 
                '$harga' 
            )";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function ubah() {
    global $conn;

    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    $query = "UPDATE Produk SET
                kode = '$kode',
                nama = '$nama',
                satuan = '$satuan',
                harga = '$harga'
              WHERE id = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    $query = "DELETE FROM Produk WHERE id = $id";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
