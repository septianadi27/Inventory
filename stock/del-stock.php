<?php
// include database connection file
include_once "../conn.php";

//cek login session
if (empty($_SESSION['username'])) {
    header("Location:../");
}

//cek admin
if ($_SESSION['role'] !== 'admin') {
    header("Location:../stock/");
}

// Get id from URL to delete that user
$kode = $_GET['kode'];

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM barang WHERE kode_barang = '$kode'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:../stock/");
