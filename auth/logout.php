<?php
session_start();
$_SESSION=[];
session_unset();
session_destroy();

setcookie('sess_id', '', time() - 3600, "/");
setcookie('auth', '', time() - 3600, "/");

header("Location: login.php");
exit;

?>