<?php
	session_start(); 
	$id_user = $_SESSION['id_user'];
	$level = $_SESSION['level'];
	$query = mysqli_query($koneksi,"SELECT `username`, `nama`, `foto` FROM `user` WHERE `id_user` = $id_user"); 
  	while($data = mysqli_fetch_row($query)){ 
    	$username = $data[0]; 
    	$nama     = $data[1];
    	$foto     = $data[2];
  	}
    if (empty($foto)) {$foto="default.png";}
              
	if (!isset($id_user)||!isset($level)) {header("Location:../login/index.php");}
?>