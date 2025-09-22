<?php
require 'db.php';

$id = $_GET['id'];

// query hapus
mysqli_query($db, "DELETE FROM tb_siswa2 WHERE id = '$id' ");

header("Location: index.php");