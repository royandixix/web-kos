<?php
session_start();
require 'config/fungsi.php';

// membatasai halaman login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'login.php';
     </script>";
    exit;
}
$_SESSION = [];
session_start();
session_destroy();
header("location: login.php");
