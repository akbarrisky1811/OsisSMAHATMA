<?php
$tanggal = date("Y-m-d");
/* Edit */
if (isset($_POST["submit-edit"])) {
    if (!empty($_POST["id_pendaftaran"]) && !empty($_POST["nama"]) && !empty($_POST["id_pendaftaran"]) && !empty($_POST["kelas"]) && !empty($_POST["nis"]) && !empty($_POST["urutan"]))  {
        $id_anggota  = $_POST["id_anggota"];
        $nama        = $_POST["nama"];
        $id_sekbid   = $_POST["id_sekbid"];
        $jabatan     = $_POST["jabatan"];
        $tampil      = $_POST["tampil"];
        $urutan      = $_POST["urutan"];
        mysqli_query($koneksi, "UPDATE `tb_pendaftaran` SET `nama`='$nama',`id_sekbid`='$id_sekbid',`jabatan`='$jabatan',`tampil`='$tampil',`urutan`='$urutan',`update_by`='$id_user',`update_at`='$tanggal' 
      WHERE `id_anggota`='$id_anggota'");
        $berhasil = " Anggota berhasil diedit";
    } else {
        $gagal = "Semua data wajib diisi!";
    }
}

/* Edit Foto*/
//   if (isset($_POST["submit-foto"])) {
//     if(!empty($_POST["id_anggota"])) {
//       $id_anggota =$_POST["id_anggota"];
//       if (isset($_FILES['foto'])) {
//       $file_tmp   = $_FILES['foto']['tmp_name'];
//       $file_name  = $_FILES['foto']['name']; 
//       $file_exp   = explode('.',$file_name);
//       $file_ext   = end($file_exp);
//       $nama_file  = $id_anggota.".".$file_ext;
//       $direktori  = '../assets/img/foto/'.$nama_file;
//       if(move_uploaded_file($file_tmp,$direktori)){ 
//         mysqli_query($koneksi,"UPDATE `anggota` SET `foto`='$nama_file' WHERE `id_anggota`='$id_anggota'");
//         $berhasil="Foto berhasil diupload";
//       }
//     }
//     else{
//       $gagal="Foto gagal diupload";
//     }
//   }
// }

/* Hapus anggota*/
if (isset($_POST["submit-hapus"])) {
    if (!empty($_POST["id_pendaftaran"])) {
        $id_anggota = $_POST["id_pendaftaran"];
        mysqli_query($koneksi, "DELETE from `tb_pendaftaran` where `id_pendaftaran` = '$id_pendaftaran'");
        
        $berhasil = "Akun berhasil dihapus";
    }
}
?>
<section class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                        <h2>Bukti Pendaftaran</h2>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mx-3" data-toggle="modal" data-target="#tambahanggota" style="height: fit-content;">
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-body">
        <h4 class="card-title">Data Perndaftaran</h4>
        <?php
        if (isset($berhasil)) { ?>
            <div class="alert alert-success col-12" role="alert">
                <p><?= $berhasil ?></p>
            </div>
        <?php } else if (isset($gagal)) { ?>
            <div class="alert alert-danger col-12" role="alert">
                <p><?= $gagal ?></p>
            </div>
        <?php }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="data-alumni" class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Pendaftaran</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Sekbid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        //query sql
                        $no = 1;
                        $sql = "SELECT * FROM `tb_pendaftaran` ORDER BY `id_pendaftaran` DESC";
                        $query = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            $id_pendaftaran  = $data["id_pendaftaran"];
                            $nama            = $data["nama"];
                            $nis             = $data["nis"];
                            $tempat_lahir    = $data["tempat_lahir"];
                            $tanggal_lahir   = $data["tanggal_lahir"];
                            $jenis_kelamin   = $data["jenis_kelamin"];
                            $agama           = $data["agama"];
                            $alamat          = $data["alamat"];
                            $sekbid          = $data["id_sekbid"];
                            $kelas           = $data["kelas"];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?= $id_pendaftaran ?></td>
                                <td><?= $nis ?></td>
                                <td><?= $kelas ?></td>
                                <td><?= $nama ?></td>
                                <td><?= $tempat_lahir ?></td>
                                <td><?= $tanggal_lahir ?></td>
                                <td><?= $jenis_kelamin ?></td>
                                <td><?= $agama ?></td>
                                <td><?= $alamat ?></td>
                                <td><?= $sekbid ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-table" title="Edit" data-toggle="modal" data-target="#editpendaftar" onclick='editanggota("<?php echo $id_anggota ?>")'><i class="mdi mdi-pencil"></i></button>
                                    <p id="<?= $id_pendaftaran ?>" class="d-none"><?php echo $nama . ',' . $nis . ',' . $tempat_lahir . ',' . $tanggal_lahir . ',' . $jenis_kelamin . "," .$agama . ',' . $alamat. "," . $sekbid ?></p>
                                    <button type="button" class="btn btn-danger btn-sm btn-table" title="Hapus" data-toggle="modal" data-target="#hapusanggota" onclick='hapusanggota("<?php echo $id_pendaftaran ?>")'><i class="mdi mdi-delete-forever"></i></button>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="editanggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-pencil"></i> Edit anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" method="post">
                    <input type="hidden" class="d-none" id="eId" name="id_anggota">
                    <div class="form-group">
                        <div class="row m-0">
                            <div class="col-6 p-0 pr-2">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="eNama" name="nama" placeholder="Nama..." required>
                            </div>
                            <div class="col-6 p-0 pr-2">
                                <label for="sekbid">Sekbid Pilihan</label>
                                <select class="form-control form-control-sm" name="id_sekbid">
                                    <?php
                                    $query_dept = mysqli_query($koneksi, "SELECT * FROM `sekbid`");
                                    while ($data_dept = mysqli_fetch_array($query_dept)) {
                                        $id_sekbid;
                                    ?>
                                        <option class="eIdDept" value="<?= $data_dept["id_sekbid"] ?>"><?= $data_dept["nama"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row m-0">
                            <div class="col-7 p-0 pr-2">
                                <label for="jabatan">Kelas</label>
                                <input type="text" class="form-control form-control-sm" id="eJabatan" name="jabatan" placeholder="Ketua ..." required>
                            </div>
                            <div class="col-3 p-0 pr-2">
                                <label for="Agama">Agama</label>
                                <select class="form-control form-control-sm" name="Agama">
                                <option value="">--Pilih--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="katolik">Katolik</option>
                                <option value="Khonghucu">Khonghucu</option>
                                <option value="Budha">Budha</option>
                                </select>
                            </div>
                            <div class="col-2 p-0 pr-2">
                                <label for="urutan">NIS</label>
                                <input type="text" class="form-control form-control-sm" id="eUrutan" name="urutan" placeholder="Select..." required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row m-0">
                            <div class="col-7 p-0 pr-2">
                                <label for="jabatan">Kelas</label>
                                <input type="text" class="form-control form-control-sm" id="eJabatan" name="jabatan" placeholder="Ketua ..." required>
                            </div>
                            <div class="col-3 p-0 pr-2">
                                <label for="Agama">Agama</label>
                                <select class="form-control form-control-sm" name="Agama">
                                <option value="">--Pilih--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="katolik">Katolik</option>
                                <option value="Khonghucu">Khonghucu</option>
                                <option value="Budha">Budha</option>
                                </select>
                            </div>
                            <div class="col-2 p-0 pr-2">
                                <label for="urutan">NIS</label>
                                <input type="text" class="form-control form-control-sm" id="eUrutan" name="urutan" placeholder="Select..." required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row m-0">
                            <div class="col-7 p-0 pr-2">
                                <label for="jabatan">Kelas</label>
                                <input type="text" class="form-control form-control-sm" id="eJabatan" name="jabatan" placeholder="Ketua ..." required>
                            </div>
                            <div class="col-3 p-0 pr-2">
                                <label for="Jenis Kelamin">Jenis Kelamin</label>
                                <select class="form-control form-control-sm" name="Agama">
                                <option value="">--Pilih--</option>
                                <option value="Laki-Laki"><Laki-Laki></Laki-Laki></option>
                                <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-2 p-0 pr-2">
                                <label for="urutan">NIS</label>
                                <input type="text" class="form-control form-control-sm" id="eUrutan" name="urutan" placeholder="Select..." required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit-edit" class="btn btn-success"><i class="mdi mdi-content-save"></i><span> Simpan</span></button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="hapusanggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eNamaHapus"><i class="mdi mdi-delete-forever"></i> Hapus anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" method="post" enctype="multipart/formdata">
                    <input type="hidden" class="d-none" id="eIdHapus" name="id_anggota" required>
                    <div class="form-group">
                        <p class="" id="eDesc">Apakah anda yakin ingin menghapus pendaftar ?</p>
                    </div>
                    <div class="modal-footer p-0 pt-3">
                        <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger" name="submit-hapus"><i class="mdi mdi-delete-forever"></i><span> Hapus</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function editanggota(idanggota) {
        var dataanggota = (document.getElementById(idanggota).textContent).split(",");
        document.getElementById("eId").value = idanggota;
        document.getElementById("eNama").value = dataanggota[0];
        document.getElementById("eJabatan").value = dataanggota[2];
        document.getElementById("eUrutan").value = dataanggota[4];
        for (var i = 0; i < document.getElementsByClassName("eIdDept").length; i++) {
            if (document.getElementsByClassName("eIdDept")[i].value == dataanggota[1]) {
                document.getElementsByClassName("eIdDept")[i].selected = "true";
            }
        }
        for (var i = 0; i < document.getElementsByClassName("eTampil").length; i++) {
            if (document.getElementsByClassName("eTampil")[i].value == dataanggota[3]) {
                document.getElementsByClassName("eTampil")[i].selected = "true";
            }
        }

    }

    function hapusanggota(idanggota) {
        var dataanggota2 = (document.getElementById(idanggota).textContent).split(",");
        document.getElementById("eIdHapus").value = idanggota;
        document.getElementById("eDesc").textContent = 'Apakah anda yakin ingin menghapus "' + dataanggota2[0] + '"?';
    }

</script>