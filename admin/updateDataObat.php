<?php
include_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = $_POST['no'];
    $nama_obat = htmlentities($_POST['nama_obat'], ENT_QUOTES);
    $stok = htmlentities($_POST['stok'], ENT_QUOTES);
    $satuan = htmlentities($_POST['satuan'], ENT_QUOTES);
    $tanggal_masuk = htmlentities($_POST['tanggal_masuk'], ENT_QUOTES);

    $queryUpdate = "UPDATE obat SET nama_obat='$nama_obat', stok='$stok', satuan='$satuan', tanggal_masuk='$tanggal_masuk' WHERE no = $no";

    mysqli_query($db, $queryUpdate);
}else{
    header('HTTP/1.1 404 Not found');
}
?>