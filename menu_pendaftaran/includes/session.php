<?php
session_start();
$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT `username`, `nama`, `foto` FROM `user_pendaf` WHERE `id_user` = $id_user");
while ($data = mysqli_fetch_row($query)) {
  $username = $data[0];
  $nama = $data[1];
}

if (!isset($id_user)) {
  header("Location: ../daftar/index.php");
  exit();
}
?>
