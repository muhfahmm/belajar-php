<?php
require 'functions.php';

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM tb_siswa WHERE id = '$id' ");

Header("Location:table.php");
exit();