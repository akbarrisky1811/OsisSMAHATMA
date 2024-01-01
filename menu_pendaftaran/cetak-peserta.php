<?php
    include "../koneksi/koneksi.php";
?>
<!DOCTYPE html> 
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anggota yang Terdaftar</title>
    <link rel="stylesheet" type = "text/css" href="../assets/css/calonanggota.css">
    <script>
        window.print();
    </script>
    </head>
    <body>
        <h2>List Anggota Terdaftar</h2><br><br>
        <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pendaftaran</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat Peserta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $list_peserta=mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran");
                            while ($row=mysqli_fetch_array($list_peserta)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['id_pendaftaran']?></td>
                            <td><?php echo $row['nis']?></td>
                            <td><?php echo $row['kelas']?></td>
                            <td><?php echo $row['nm_peserta']?></td>
                            <td><?php echo $row['tmp_lahir'].','.$row['tgl_lahir'] ?></td>
                            <td><?php echo $row['jk']?></td>
                            <td><?php echo $row['agama']?></td>
                            <td><?php echo $row['almt_peserta']?></td>
                        </tr>
                        <?php 
                        }?>
                    </tbody>
                </table>

    </body>
</html>