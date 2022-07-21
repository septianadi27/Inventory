<?php 
include '../conn.php';

//$kode_barang=$_POST['kode_brg'];
$kategori=$_POST['kategori'];
$nama_barang=$_POST['nama_brg'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];
$stock=$_POST['stock'];

//get jumlah barang
$tampil = mysqli_query($koneksi, "select * from barang where kategori = '$kategori'");
$temp_jml_barang = mysqli_num_rows($tampil);
$jumlah_barang=str_pad($temp_jml_barang+1, 5, "0", STR_PAD_LEFT);  // produces "0001"
//get singkatan kategori
$temp_kategori=strtoupper(substr($kategori, 0, 3));

//gabung singkatan kategori + jumlah barang
$kode_barang=$temp_kategori.$jumlah_barang;

$query = mysqli_query($koneksi,"INSERT INTO `barang` (`kode_barang`, `kategori`, `nama_barang`, `satuan`, `harga`, `stock`) VALUES ('$kode_barang', '$kategori', '$nama_barang', '$satuan', $harga, $stock)");

if ($query){
    header("Location:../brg-masuk/");
} else {
    header("Location:../brg-masuk/");
}
 
?>