<?php

session_start();
require_once "../LoginKoneksi.php";
$HOST = "localhost";
$PASSWORD = "";
$USER = "root";
$DB = "kalender";
$pengguna = $_SESSION['username'];
$conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
if (!$conn->get_connection_stats())
    die("Failed");
// if (!isset($_GET['tgl'])) {
//     header("location:../index.php");
// }
$id = $_GET['id'];
$tgl = $_GET['tgl'];
$sql = "SELECT * FROM kegiatan WHERE id = " . $_GET['id'] . " AND username =" . "'".$pengguna."'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $old_nama = $row['nama'];
    $old_tglMulai = $row['tglMulai'];
    $old_tglSelesai = $row['tglSelesai'];
    $old_durasi = explode(" ", $row['durasi']);
    $old_lokasi = $row['lokasi'];
    $old_level = $row['level'];
    $old_gambar = $row['gambar'];
}
$sql = "UPDATE `kegiatan` SET 
gambar = 'pp'
WHERE id =$id AND username = '$pengguna'"
;
mysqli_query($conn, $sql);


unlink($old_gambar);
header("location:update.php?id=$id&tgl=$tgl");

