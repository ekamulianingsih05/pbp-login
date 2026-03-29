<?php
// mengaktifkan session php
session_start();

//menambahkan file koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form login atau index.php
//di bagian ini yg ditangkap harus sesuai dengan NAME yang ada pada field INPUT
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location: index.php");
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
//penambahan md5 adalah untuk melakukan enkripsi data password, agar sama pada sisi database
$plainPassword = isset($_POST['password']) ? $_POST['password'] : '';

if ($username === '' || $plainPassword === '') {
    header("location:index.php?pesan=gagal");
    exit;
}

$password = md5($plainPassword);

// menyeleksi data admin dengan username dan password yang sesuai
$stmt = mysqli_prepare($con, "SELECT id, username FROM tb_user WHERE username = ? AND password = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $row = mysqli_fetch_assoc($data);
    session_regenerate_id(true);
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['status'] = "login";
    header("location:dashboard.php");
    exit;
} else {
    header("location:index.php?pesan=gagal");
    exit;
}
