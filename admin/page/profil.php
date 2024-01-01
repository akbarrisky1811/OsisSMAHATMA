<?php  
  if (isset($_POST["submit-profil"])) {
    if (isset($_POST['username'])&&isset($_POST['nama'])) {
      $username_baru = $_POST['username'];
      $nama_baru  	 = $_POST['nama']; 
      if ($username_baru!=$username) {
      	if (mysqli_num_rows(mysqli_query($koneksi, "SELECT `username` FROM `user` WHERE `username` = '$username_baru'"))==0) {
      		mysqli_query($koneksi,"UPDATE `user` SET `username`='$username_baru', `nama`='$nama_baru' WHERE `id_user`='$id_user'");
      		$berhasil="Data berhasil disimpan";
      	}else {$gagal="Username sudah terpakai";}
      }else {
      	mysqli_query($koneksi,"UPDATE `user` SET `username`='$username_baru', `nama`='$nama_baru' WHERE `id_user`='$id_user'");
      	$berhasil="Data berhasil disimpan";
      } 
    }
  }
  if (isset($_POST["submit-foto"])) {
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
      }else{
        $gagal="Foto gagal diupload";
      }
    }
  }
?> 

          <section class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body row">
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
                  <div class="col-md-3 px-2 m-3">
                  	<?php 
                  		$query = mysqli_query($koneksi,"SELECT `username`, `nama`, `foto` FROM `user` WHERE `id_user` = $id_user"); 
                      	while($data = mysqli_fetch_row($query)){ 
                         	$username = $data[0]; 
                         	$nama     = $data[1];
                         	$foto     = $data[2];
                      	}
                      	if (empty($foto)) {$foto="default.png";}
                  	?>
                    <img src="assets/img/profil/<?= $foto ?>" class="rounded-circle mx-auto img-profil" style="width: 200px; height:200px;">
                    <button type="button" class="btn btn-inverse-primary btn-rounded btn-social-icon" data-toggle="modal" data-target="#editFoto" style="left: 150px; top: 150px; position: absolute;">
                      <i class="mdi mdi-pencil-outline"></i>
                    </button>
                  </div>

                  <div class="col-md-6 my-3">
                    <h2 class="m-0">Profil pengguna</h2>
                    <hr>
                    <form class="forms-sample" method="post">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                      </div>
                      <div class="row">
                        <button type="submit" name="submit-profil" class="btn btn-primary mr-2 ml-auto">
                          <i class="mdi mdi-content-save"></i>
                          <span> Simpan</span>
                        </button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </section>

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