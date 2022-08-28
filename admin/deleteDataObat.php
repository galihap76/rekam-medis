<?php
include_once '../config/koneksi.php';
$queryDelete = "DELETE FROM obat WHERE no = " . $_GET['no'];
mysqli_query($db, $queryDelete);
?>