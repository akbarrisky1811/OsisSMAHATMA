<?php
    include "../koneksi/koneksi.php";

    $peserta = mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '".$_GET['id']."' ");

    $p = mysqli_fetch_object($peserta);

?>
<!DOCTYPE html> 
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Anggota Baru Online</title>
    <link rel="stylesheet" type = "text/css" href="../assets//css//calon.css">
    <script>
        window.print();
    </script>
    </head>
    <body>
        
        <h2>Bukti Pendaftaran</h2>
        <table class="table-bukti">
            <tr>
                <td>Kode Pendaftaran</td>
                <td>:</td>
                <td><?php echo $p->id_pendaftaran?></td>
            </tr>
            <tr>
                <td>Nomor Induk Siswa</td>
                <td>:</td>
                <td><?php echo $p->nis?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?php echo $p->kelas?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><?php echo $p->nm_peserta?></td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo $p->tmp_lahir.',' .$p->tgl_lahir?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo $p->jk?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?php echo $p->agama?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $p->almt_peserta?></td>
            </tr>
        </table>

    </body>
</html>