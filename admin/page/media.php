<?php
  /* Edit Foto*/ 
  if (isset($_POST["submit-upload"])) {
    if (!empty($_FILES['files'])) {
      $tanggal    = date("Y-m-d");
      $file_tmp   = $_FILES['files']['tmp_name'];
      $file_name  = $_FILES['files']['name']; 
      $file_exp   = explode('.',$file_name);
      $file_ext   = end($file_exp);
      $direktori  = '../assets/uploads/'.$file_name;
      $query_f = mysqli_query($koneksi,"SELECT * FROM `file` WHERE `nama`='$file_name'"); 
      if(mysqli_num_rows($query_f)=="0"){ 
        if(move_uploaded_file($file_tmp,$direktori)){ 
          mysqli_query($koneksi,"INSERT INTO `file` SET `nama`='$file_name',`format`='$file_ext',`upload_by`='$id_user',`upload_at`='$tanggal' ");
          $berhasil="File berhasil diupload";
        }
      }else {$gagal="Nama file sudah dipakai";}
    }else{$gagal="File gagal diupload";}
  }

  /* Hapus User*/ 
  if (isset($_POST["submit-hapus"])) {
    if (!empty($_POST["id_file"])) {
      $id_file  = $_POST["id_file"];
      $query = mysqli_query($koneksi,"SELECT * FROM `file` WHERE `id_file`='$id_file'"); 
      while($data = mysqli_fetch_array($query)){$nama   = $data["nama"];} 
      mysqli_query($koneksi,"DELETE from `file` where `id_file` = '$id_file'");
      unlink("../assets/uploads/".$nama); 
      $berhasil = "File berhasil dihapus";
    }
  } 
?> 
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                      <h2>Media File</h2>
                      <button type="button" class="btn btn-outline-primary btn-sm ml-3" data-toggle="modal" data-target="#uploadFile" style="height: fit-content;">
                        Upload
                      </button>
                    </div>
                    <p class="mb-md-0">Upload dan Hapus File.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="card">
            <div class="card-body">
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
              <div id="" class="row mediafile">
                <?php 
                  $sql = "SELECT * FROM `file` ORDER BY `id_file` DESC"; 
                  $query = mysqli_query($koneksi,$sql); 
                  while($data = mysqli_fetch_array($query)){ 
                     $id_file   = $data["id_file"]; 
                     $nama      = $data["nama"];
                     $format    = $data["format"];
                ?>
                <div class="col-md-2 col-6 py-2">
                  <button type="button" class="btn btn-light p-2 ml-auto" id="menu4" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                  <div class="dropdown-menu" aria-labelledby="menu4" x-placement="bottom-start" style="position: absolute; transform: translate3d(113px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="#" onclick='copyLink(<?php echo  '"'.$nama.'"' ?>);'>Copy Link</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusFile" onclick='hapusFile(<?php echo  '"'.$id_file.'"' ?>);'>Hapus</a>
                  </div>
                  <img class="rounded of-cover shadow" id="media-<?= $id_file ?>" src="../assets/uploads/<?= $nama ?>" onload='setHeight(<?php echo  '"'.$id_file.'"' ?>)'>
                  <p id="<?= $id_file ?>" class="d-none"><?php echo $nama.','.$format ?></p>
                  <p class="text-center"><?= $nama ?></p>
                </div>
                <?php } ?>
              </div>
              
            </div>
          </section>

          <div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaLogo"><i class="mdi mdi-upload"></i> Upload Media</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="eIdFoto" name="id_user" required>
                    <div class="form-group">
                      <label>File</label>
                      <input type="file" name="files" class="file-upload-default" id="customFile">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload File">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary btn-sm" type="button">Upload</button>
                        </span>
                      </div>
                      <ul class="my-2">
                        <li class="text-danger">Files tidak boleh lebih dari 5 MB.</p></li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success" name="submit-upload" ><i class="mdi mdi-upload"></i><span> Upload</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>  

          <div class="modal fade" id="hapusFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaHapus"><i class="mdi mdi-delete-forever"></i> Hapus File</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="eIdHapus" name="id_file" required>
                    <div class="form-group">
                      <p class="" id="eDesc">Apakah anda yakin ingin menghapus?</p>
                    </div>
                    <div class="modal-footer p-0 pt-3">
                      <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-danger" name="submit-hapus" ><i class="mdi mdi-delete"></i><span> Hapus</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function setHeight(idfile){
              const height = document.getElementById("media-"+idfile).offsetWidth;
              document.getElementById("media-"+idfile).style.height = height+"px";
            }
          </script>
          <script type="text/javascript">
            function hapusFile(idfile){
              var dataFile = (document.getElementById(idfile).textContent).split(",");
              document.getElementById("eIdHapus").value = idfile;
              document.getElementById("eDesc").textContent = 'Apakah anda yakin ingin menghapus "'+dataFile[0]+'"?';
            }
          </script>
          <script type="text/javascript">
            function copyLink(nama){
              var el = document.createElement('textarea');
              // Set value (string to be copied)
              el.value = "assets/uploads/"+nama;
              // Set non-editable to avoid focus and move outside of view
              el.setAttribute('readonly', '');
              el.style = {position: 'absolute', left: '-9999px'};
              document.body.appendChild(el);
              // Select text inside element
              el.select();
              // Copy text to clipboard
              document.execCommand('copy');
              // Remove temporary element
              document.body.removeChild(el);
            }
          </script>