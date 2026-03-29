<?php
//deklarasi variabel dimana ini adalah database kita
$db_username = "root"; //secara default menggunakan root
$db_hostname = "localhost"; //alamat database
$db_password = ""; //secara default password database adalah blank atau kosong, jika database kalian sudah diberikan password silahkan ditambahkan di dalam tanda ""
$db_name = "pbp-eka"; //nama database sesuai file pbp.sql
//--------------------------------
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    die("Koneksi database gagal : " . mysqli_connect_error());
}
// } else {
//     echo "Koneksi Berhasil";
// }
