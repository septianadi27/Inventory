<?php 
include '../conn.php';

//$kode_barang=$_POST['kode_brg'];
$kategori=$_POST['kategori'];
$nama_barang=$_POST['nama_brg'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];
$stock=$_POST['stock'];

//get date
$temp_date=date('dmy-his');

//get singkatan kategori
$temp_kategori=strtoupper(substr($kategori, 0, 3));

//gabung singkatan kategori + jumlah barang
$kode_barang=$temp_kategori.'-'.$temp_date;

$query = mysqli_query($koneksi,"INSERT INTO `barang` (`kode_barang`, `kategori`, `nama_barang`, `satuan`, `harga`, `stock`) VALUES ('$kode_barang', '$kategori', '$nama_barang', '$satuan', $harga, $stock)");

if ($query){
    header("Location:../stock/");
} else {
    header("Location:../stock/");
}
 
?>