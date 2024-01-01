<?php
    include '../koneksi/koneksi.php';

    if(isset($_GET['id'])){
        $delete = mysqli_query($koneksi, "DELETE FROM tb_pendaftaran WHERE id_pendaftaran='".$_GET['id']."' ");
        echo '<script>window.location="data-peserta"</script>';
    }

?>