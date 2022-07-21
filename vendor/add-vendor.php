<?php 
include '../conn.php';

//$kode_barang=$_POST['kode_brg'];
$nama_vendor=$_POST['nama_vendor'];
$alamat=$_POST['alamat_vendor'];
$int_value = (int) $_POST['contact'];
$contact='0'.$int_value;

//gabung singkatan VEN dan waktu
$temp_date=date('dmy-his');
$kode_vendor='VEN-'.$temp_date;

$query = mysqli_query($koneksi,"INSERT INTO `vendor` (`kode_vendor`, `nama_vendor`, `alamat`, `contact`) VALUES ('$kode_vendor', '$nama_vendor', '$alamat', '$contact')");

if ($query){
    header("Location:../vendor/");
} else {
    header("Location:../vendor/");
}
 
?>