<?php
include "../koneksi/koneksi.php";

if(isset($_POST['submit'])){
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];

    // Periksa apakah NIS atau Nama sudah ada di database
    $checkData = mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran WHERE nis = '$nis' OR nama = '$nama'");
    if(mysqli_num_rows($checkData) > 0) {
        echo "<script>alert('Data telah ada')</script>";
    } else {
        $getMaxId = mysqli_query($koneksi, "SELECT MAX(RIGHT(id_pendaftaran, 5)) AS id FROM tb_pendaftaran");
        $d = mysqli_fetch_object($getMaxId);
        $generateId = 'P'.date('Y').sprintf("%05s", $d->id + 1);

        $data = $generateId . "', '" . date('Y-m-d') . "'";
        //proses insert
        $insert = mysqli_prepare($koneksi, "INSERT INTO tb_pendaftaran (id_pendaftaran,  nis, kelas, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, id_sekbid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert, 'sssssssssss', $data, $_POST['nis'], $_POST['kelas'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['alamat'], $_POST['id_sekbid']);
        $result = mysqli_stmt_execute($insert);


        if($insert){
            echo '<script>window.location="succes.php?id='.$generateId.'"</script>';
        }else{
            echo 'Gagal'.mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html> 
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Anggota Baru Online</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/calonpeserta.css">
    </head>
    <body>
        <section class="box-formulir">
        <h2>Pendaftaran Anggota Baru</h2>

        <form action="" method="post">
            <div class="box">
                <table  class="table-form">
                <tr>
                        <td>NIS:</td>
                        <td>:</td>
                        <td><input type="text" name="nis" class="input-control"></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><input type="text" name="kelas" class="input-control"></td>
                    </tr>
                </table>
            </div>

            <h3>Data Diri Calon Anggota</h3>
            <div class="box">
                <table  class="table-form">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><input type="text" name="nama" class="input-control"></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><input type="text" name="tempat_lahir" class="input-control"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><input type="date" name="tanggal_lahir" class="input-control"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><input type="radio" name="jenis_kelamin" class="input-control" value="laki-laki">Laki-Laki &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="jenis_kelamin" class="input-control" value="perempuan">Perempuan</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td>
                            <select name="agama" class="input-control">
                                <option value="">--Pilih--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Khonghucu">Khonghucu</option>
                                <option value="Budha">Budha</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Lengkap</td>
                        <td>:</td>
                        <td><textarea name="alamat" class="input-control"></textarea></td>
                    </tr>
                    <tr>
                        <td>Sekbid</td>
                        <td>:</td>
                        <td><input type="text" name="id_sekbid" class="input-control"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" name="submit" class="btn-daftar" value="Daftar Sekarang"></td>
                    </tr>
                </table>
            </div>
            
        </form>
        </section>
    </body>
</html>
