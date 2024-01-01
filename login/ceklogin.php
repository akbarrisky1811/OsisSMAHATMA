<?php 
	include ('../koneksi/koneksi.php');
	if (isset($_POST["login"],$_POST["username"],$_POST["password"])) {
	    $username = $_POST["username"];
	    $password = MD5($_POST["password"]);

	    //cek username dan password 
        $sql = "select `id_user`, `level` from `user` where `username`='$username' and `password`='$password'";
        $query = mysqli_query($koneksi, $sql); 
        $jumlah = mysqli_num_rows($query);

        if ($jumlah==1) {
         	session_start(); 
            while($data = mysqli_fetch_row($query)){ 
                $id_user = $data[0];
                $level = $data[1];
                $_SESSION['id_user']=$id_user; 
                $_SESSION['level']=$level; 
                header("Location:../admin/dashboard"); 
            } 
        } else {header("Location:index.php?gagal=1");}
	} else {header("Location:index.php?gagal=1");}
?>