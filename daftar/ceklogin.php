<?php 
	include ('../koneksi/koneksi.php');
	if (isset($_POST["login"],$_POST["username"],$_POST["password"])) {
	    $username = $_POST["username"];
	    $password = MD5($_POST["password"]);

	    //cek username dan password 
        $sql = "select `id_user` from `user_pendaf` where `username`='$username' and `password`='$password'";
        $query = mysqli_query($koneksi, $sql); 
        $jumlah = mysqli_num_rows($query);

        if ($jumlah==1) {
         	session_start(); 
            while($data = mysqli_fetch_row($query)){ 
                $id_user = $data[0];
                $_SESSION['id_user']=$id_user;  
                header("Location:../menu_pendaftaran/dasboard"); 
            } 
        } else {header("Location:index.php?gagal=1");}
	} else {header("Location:index.php?gagal=1");}
?>