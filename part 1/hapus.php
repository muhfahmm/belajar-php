<?php
require 'db.php';

$id = $_GET['id'];

// Hapus data dari database
mysqli_query($db, "DELETE FROM tb_siswa WHERE id = $id");

// Redirect ke halaman utama
header("Location: home.php");
exit;
?>
