<?php
// koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$dbnm = 'belajar2';

$db = mysqli_connect($host,$user,$pass,$dbnm);

// fungsi table dan searching
function table ($data) {
    global $db;

    $result = mysqli_query($db, $data);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows [] = $row;
    }
    return $rows;
} 

// fungsi tambah
function add ($data) {
    global $db;
    //  ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data['nama']);
    $kelas = htmlspecialchars($data ['kelas']);
    $nomor = htmlspecialchars($data ['nomor']);
    $gender = htmlspecialchars($data ['gender']);
    $email = htmlspecialchars($data ['email']);

    // query INSERT DATA
    $query = "INSERT INTO tb_siswa VALUES
    ('','$nama', '$kelas', '$nomor', '$gender', '$email')
    ";
    mysqli_query($db,$query);
    return mysqli_affected_rows($db);
}

// fungsi delete
function delete ($id) {
    global $db;

    mysqli_query($db, "DELETE FROM tb_siswa WHERE id = $id");
    
    return mysqli_affected_rows($db);
}

// function edit
function update ($data) {
    global $db;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $kelas = htmlspecialchars($data ['kelas']);
    $nomor = htmlspecialchars($data ['nomor']);
    $gender = htmlspecialchars($data ['gender']);
    $email = htmlspecialchars($data ['email']);

    // query INSERT DATA
    $query =  "UPDATE tb_siswa SET
    nama = '$nama',
    kelas = '$kelas',
    nomor = '$nomor',
    gender = '$gender',
    email = '$email'
    WHERE id = $id
    ";
    mysqli_query ($db, $query);
    return mysqli_affected_rows($db);
}

// function searching
function cari ($keyword) {
    $query = "SELECT * FROM tb_siswa WHERE
    nama LIKE '%$keyword%' OR
    kelas LIKE '%$keyword%' OR
    nomor LIKE '%$keyword%' OR
    gender LIKE '%$keyword%' OR
    email LIKE '%$keyword%'
    ";
    return table ($query);
}

// function register
function register ($user) {
    global $db;

    $username = $user['username'];
    $password1 = mysqli_real_escape_string($db,$user['password1']);
    $password2 = mysqli_real_escape_string($db,$user['password2']);

    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT nama FROM tb_admin WHERE nama = '$username' ");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert ('username sudah terdaftar');
        </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password1 !== $password2) {
        echo "<script>
        alert ('password tidak sama');
        </script>";
        return false;
    }

    // enskripsi password
    $password1 = password_hash($password1, PASSWORD_DEFAULT);

    // menambahkan user ke dalam database
    mysqli_query($db, "INSERT INTO tb_admin VALUES
    ('', '$username', '$password1')"
    );
    return mysqli_affected_rows($db);
}