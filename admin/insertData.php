<?php
include_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_identitas = htmlentities($_POST['nomor_identitas'], ENT_QUOTES);
    $nama_pasien = htmlentities($_POST['nama_pasien'], ENT_QUOTES);
    $jenis_kelamin = htmlentities($_POST['jenis_kelamin'], ENT_QUOTES);
    $alamat = htmlentities($_POST['alamat'], ENT_QUOTES);
    $no_telepon = htmlentities($_POST['no_telepon'], ENT_QUOTES);

    mysqli_query($db, "INSERT INTO pasien VALUES('', '$nomor_identitas', '$nama_pasien', '$jenis_kelamin', '$alamat', '$no_telepon')");
}else{
    header('HTTP/1.1 404 Not found');
}
?>