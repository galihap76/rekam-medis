<?php
include_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nomor_identitas = htmlentities($_POST['nomor_identitas'], ENT_QUOTES);
    $nama_pasien = htmlentities($_POST['nama_pasien'], ENT_QUOTES);
    $jenis_kelamin = htmlentities($_POST['jenis_kelamin'], ENT_QUOTES);
    $alamat = htmlentities($_POST['alamat'], ENT_QUOTES);
    $no_telepon = htmlentities($_POST['no_telepon'], ENT_QUOTES);

    $queryUpdate = "UPDATE pasien SET nomor_identitas='$nomor_identitas', nama_pasien='$nama_pasien', jenis_kelamin='$jenis_kelamin', alamat='$alamat', no_telepon='$no_telepon' WHERE id = $id";

    mysqli_query($db, $queryUpdate);
}else{
    header('HTTP/1.1 404 Not found');
}
?>