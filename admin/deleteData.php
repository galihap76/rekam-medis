<?php
include_once '../config/koneksi.php';
$queryDelete = "DELETE FROM pasien WHERE id = " . $_GET['id'];
mysqli_query($db, $queryDelete);
?>