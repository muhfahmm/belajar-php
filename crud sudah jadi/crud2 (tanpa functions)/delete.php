<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

// Ambil id dari URL
$id = $_GET['id'];

// Jalankan query DELETE langsung
mysqli_query($db, "DELETE FROM tb_siswa WHERE id = $id");

// Cek apakah data berhasil dihapus
if (mysqli_affected_rows($db) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus');
            document.location.href = 'index.php';
        </script>
    ";
}
