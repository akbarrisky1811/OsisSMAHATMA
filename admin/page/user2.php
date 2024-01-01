<?php 
  /* Tambah */ 
  if (isset($_POST["submit-tambah"])) {
    if (!empty($_POST["nama"])&&!empty($_POST["username"])&&!empty($_POST["password"])&&!empty($_POST["jabatan"])&&!empty($_POST["level"])) {
      $nama       = $_POST["nama"];
      $username   = $_POST["username"];
      $password   = MD5($_POST["password"]);
      $jabatan    = $_POST["jabatan"];
      $level      = $_POST["level"];
      if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `user` WHERE `username`='$username'"))=="0") {
        $sql_t = "INSERT INTO `user` (`nama`, `username`, `password`, `level`, `jabatan`)
                  VALUES ('$nama', '$username', '$password', '$level', '$jabatan')";
        mysqli_query($koneksi,$sql_t);
        $berhasil = "Akun berhasil ditambahkan";
      } else {$gagal = "Username telah terpakai";}
    }else {$gagal = "Semua data wajib diisi!";}
  }

  /* Edit */
  if (isset($_POST["submit-edit"])) {
    if (!empty($_POST["nama"])&&!empty($_POST["username"])&&!empty($_POST["jabatan"])&&!empty($_POST["level"])&&!empty($_POST["id_user"])&&!empty($_POST["username_lama"])) {
      $id_user       = $_POST["id_user"];
      $nama          = $_POST["nama"];
      $username      = $_POST["username"];
      $username_lama = $_POST["username_lama"];
      $jabatan       = $_POST["jabatan"];
      $level         = $_POST["level"];

      if ($username==$username_lama) {
        mysqli_query($koneksi,"UPDATE `user` SET `nama`='$nama',`username`='$username',`level`='$level',`jabatan`='$jabatan' WHERE `id_user`='$id_user'");
        if (!empty($_POST["password"])) {
          $password      = MD5($_POST["password"]);
          mysqli_query($koneksi,"UPDATE `user` SET `password`='$password' WHERE `id_user`='$id_user'");
        }
        $berhasil = "Akun berhasil diedit";
      }

      if ($username!=$username_lama) {
        if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `user` WHERE `username`='$username'"))=="0") {
          mysqli_query($koneksi,"UPDATE `user` SET `nama`='$nama',`username`='$username',`level`='$level',`jabatan`='$jabatan' WHERE `id_user`='$id_user'");
          if (!empty($_POST["password"])) {
            $password      = MD5($_POST["password"]);
            mysqli_query($koneksi,"UPDATE `user` SET `password`='$password' WHERE `id_user`='$id_user'");
          }
          $berhasil = "Akun berhasil di edit";
        } else {$gagal = "Username telah terpakai";}
      }
    } 
  }

  /* Edit Foto*/  
  if (isset($_POST["submit-foto"])) {
    if(!empty($_POST["id_user"])) {
      $id_user =$_POST["id_user"];
      if (isset($_FILES['foto'])) {
        $file_tmp   = $_FILES['foto']['tmp_name'];
        $file_name  = $_FILES['foto']['name']; 
        $file_exp   = explode('.',$file_name);
        $file_ext   = end($file_exp);
        $nama_file  = $id_user.".".$file_ext;
        $direktori  = 'assets/img/profil/'.$nama_file;
        if(move_uploaded_file($file_tmp,$direktori)){ 
          mysqli_query($koneksi,"UPDATE `user` SET `foto`='$nama_file' WHERE `id_user`='$id_user'");
          $berhasil="Foto berhasil diupload";
        }
      }
      else{
      $gagal="Foto gagal diupload";
      }
    }
  }

  /* Hapus User*/ 
  if (isset($_POST["submit-hapus"])) {
    if (!empty($_POST["id_user"])) {
      $id_user =$_POST["id_user"];
      mysqli_query($koneksi,"DELETE from `user` where `id_user` = '$id_user'");
      //get foto
      $query_f = mysqli_query($koneksi,"SELECT `foto` FROM `user` WHERE `id_user`='$id_user'"); 
      if(mysqli_num_rows($query_f)!="0"){ 
        while($data_f = mysqli_fetch_row($query_f)){ 
          $foto = $data_f[0]; 
          //menghapus foto 
          unlink("assets/img/profil/$foto"); 
        } 
      }
      $berhasil= "Akun berhasil dihapus";
    }
  } 
?> 
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                      <h2>Pengaturan User</h2>
                      <button type="button" class="btn btn-outline-primary btn-sm mx-3" data-toggle="modal" data-target="#tambahUser" style="height: fit-content;">
                        Tambah User
                      </button>
                    </div>
                    <p class="mb-md-0">Tambah, Edit dan Delete User.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="card">
            <div class="card-body">
              <h4 class="card-title">Data User</h4>
              <?php 
                if (isset($berhasil)) {?>
                  <div class="alert alert-success col-12" role="alert">
                    <p><?= $berhasil ?></p>
                  </div>
                <?php } else if (isset($gagal)) {?>
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
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Jabatan</th>
                          <th>Level</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          //query sql
                          $no = 1;
                          $sql = "SELECT * FROM `user` ORDER BY `id_user` DESC"; 
                          $query = mysqli_query($koneksi,$sql); 
                          while($data = mysqli_fetch_array($query)){ 
                             $id_user   = $data["id_user"]; 
                             $nama      = $data["nama"];
                             $username  = $data["username"];
                             $foto      = $data["foto"];
                             $jabatan   = $data["jabatan"];
                             $level     = $data["level"];
                             if (empty($foto)) {$foto="default.png";}
                        ?>
                        <tr>
                          <td class="td-nomer"><?= $no ?></td>
                          <td>
                            <img src="assets/img/profil/<?= $foto ?>" class="rounded-circle img-profil mr-2" style="height:16px;width:16px">
                            <span><?= $nama ?></span>
                          </td>
                          <td><?= $username ?></td>
                          <td><?= $jabatan ?></td>
                          <td><?= $level ?></td><td>
                            <button type="button" class="btn btn-primary btn-sm btn-table" title="Edit" data-toggle="modal" data-target="#editUser" onclick='editUser(<?php echo  '"'.$id_user.'"' ?>)'><i class="mdi mdi-pencil"></i></button>
                            <p id="<?= $id_user ?>" class="d-none"><?php echo $nama.','.$username.','.$jabatan.','.$level ?></p>
                            <button type="button" class="btn btn-primary btn-sm btn-table" title="Edit Foto" data-toggle="modal" data-target="#editFoto" onclick='editFoto(<?php echo  '"'.$id_user.'"' ?>)'><i class="mdi mdi-image-area"></i></button>
                            <button type="button" class="btn btn-danger btn-sm btn-table" title="Hapus"  data-toggle="modal" data-target="#hapusUser" onclick='hapusUser(<?php echo  '"'.$id_user.'"' ?>)'><i class="mdi mdi-delete-forever"></i></button>
                          </td>
                        </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-account-plus"></i> Tambah User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                      <div class="row m-0">
                        <div class="col-6 p-0 pr-2">
                          <label for="username">Username</label>
                          <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username..." required>
                        </div>
                        <div class="col-6 p-0 pr-2">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password..." minlength="6" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row m-0">
                        <div class="col-8 p-0 pr-2">
                          <label for="jabatan">Jabatan</label>
                          <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan" placeholder="Ketua Divisi..." required>
                        </div>
                        <div class="col-4 p-0 pr-2">
                          <label for="level">Level</label>
                          <select class="form-control form-control-sm" id="level" name="level">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="submit-tambah" class="btn btn-success"><i class="mdi mdi-check"></i><span> Submit</span></button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-pencil"></i> Edit User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post">
                    <input type="hidden" class="d-none" id="eId" name="id_user">
                    <input type="hidden" class="d-none" id="eUsernameLama" name="username_lama">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control form-control-sm" id="eNama" name="nama" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                      <div class="row m-0">
                        <div class="col-6 p-0 pr-2">
                          <label for="username">Username</label>
                          <input type="text" class="form-control form-control-sm" id="eUsername" name="username" placeholder="Username..." required>
                        </div>
                        <div class="col-6 p-0 pr-2">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password...">
                          <p class="text-danger">Kosongkan jika tidak ingin mengganti password</p>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row m-0">
                        <div class="col-8 p-0 pr-2">
                          <label for="jabatan">Jabatan</label>
                          <input type="text" class="form-control form-control-sm" id="eJabatan" name="jabatan" placeholder="Ketua Divisi..." required>
                        </div>
                        <div class="col-4 p-0 pr-2">
                          <label for="level">Level</label>
                          <select class="form-control form-control-sm" id="level" name="level">
                            <option class="eLevel" value="admin">Admin</option>
                            <option class="eLevel" value="superadmin">Superadmin</option>
                          </select>
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

          <div class="modal fade" id="hapusUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaHapus"><i class="mdi mdi-delete-forever"></i> Hapus User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/formdata">
                    <input type="hidden" class="d-none" id="eIdHapus" name="id_user" required>
                   <div class="form-grup">
                    <p class="" id="eDesc">Apakah anda yakin ingin menghapus user ? </p>
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

          <div class="modal fade" id="editFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaLogo"><i class="mdi mdi-image-area"></i> Edit Foto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="eIdFoto" name="id_user" required>
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" name="foto" class="file-upload-default" id="customFile">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary btn-sm" type="button">Upload</button>
                        </span>
                      </div>
                      <ul class="my-2">
                        <li class="text-danger">Foto harus berformat JPG atau PNG.</p></li>
                        <li class="text-danger">Foto tidak boleh lebih dari 500 KB.</li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="submit-foto" class="btn btn-success"><i class="mdi mdi-content-save"></i><span> Simpan</span></button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function editUser(iduser){
              var dataUser = (document.getElementById(iduser).textContent).split(",");
              document.getElementById("eId").value = iduser;
              document.getElementById("eNama").value = dataUser[0];
              document.getElementById("eUsername").value = dataUser[1];
              document.getElementById("eUsernameLama").value = dataUser[1];
              document.getElementById("eJabatan").value = dataUser[2];
              for (var i = 0; i < document.getElementsByClassName("eLevel").length ; i++) {
                if (document.getElementsByClassName("eLevel")[i].value==dataUser[3]) {
                  document.getElementsByClassName("eLevel")[i].selected = "true";
                }
              }
            }
            function hapusUser(iduser){
              document.getElementById("eIdHapus").value = iduser;
            }
            function editFoto(iduser){
              document.getElementById("eIdFoto").value = iduser;
            }

          </script>