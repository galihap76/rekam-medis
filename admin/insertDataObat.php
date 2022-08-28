<?php
include_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_obat = htmlentities($_POST['nama_obat'], ENT_QUOTES);
    $stok = htmlentities($_POST['stok'], ENT_QUOTES);
    $satuan = htmlentities($_POST['satuan'], ENT_QUOTES);
    $tanggal_masuk = htmlentities($_POST['tanggal_masuk'], ENT_QUOTES);

    mysqli_query($db, "INSERT INTO obat VALUES('', '$nama_obat', '$stok', '$satuan', '$tanggal_masuk')");

}else{
    header('HTTP/1.1 404 Not found');
}
?>