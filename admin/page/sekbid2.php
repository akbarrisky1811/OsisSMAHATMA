<?php 
  /* Edit */
  if (isset($_POST["submit-edit"])) {
    if (!empty($_POST["nama"])&&!empty($_POST["deskripsi"])&&!empty($_POST["jumlah"])&&!empty($_POST["id_sekbid"])) {
      $id_sekbid     = $_POST["id_sekbid"];
      $nama          = $_POST["nama"];
      $deskripsi     = $_POST["deskripsi"];
      $jumlah        = $_POST["jumlah"];
          mysqli_query($koneksi,"UPDATE `sekbid` SET `nama`='$nama',`deskripsi`='$deskripsi',`jumlah`='$jumlah' WHERE `id_sekbid`='$id_sekbid'");
          $berhasil = "Seksi Bidang berhasil di edit";
        }
    } 

  /* Edit Logo*/  
  // if (isset($_POST["submit-logo"])) {
  //   if(!empty($_POST["id_dept"])) {
  //     $id_dept =$_POST["id_dept"];
  //     if (isset($_FILES['logo'])) {
  //       $file_tmp   = $_FILES['logo']['tmp_name'];
  //       $file_name  = $_FILES['logo']['name']; 
  //       $file_exp   = explode('.',$file_name);
  //       $file_ext   = end($file_exp);
  //       $nama_file  = $id_user.".".$file_ext;
  //       $direktori  = 'assets/img/logo/'.$nama_file;
  //       if(move_uploaded_file($file_tmp,$direktori)){ 
  //         mysqli_query($koneksi,"UPDATE `departemen` SET `logo`='$nama_file' WHERE `id_dept`='$id_dept'");
  //         $berhasil="Logo berhasil diupload";
  //       }
  //     }
  //     else{
  //     $gagal="Logo gagal diupload";
  //     }
  //   }
  // }
?> 
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                      <h2>Pengaturan User</h2>
                      <button type="button" class="btn btn-outline-primary btn-sm mx-3" data-toggle="modal" data-target="#tambahUser" style="height: fit-content;">
                        Edit Seksi Bidang
                      </button>
                    </div>
                    <p class="mb-md-0">Edit Seksi Bidang.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="card">
            <div class="card-body">
              <h4 class="card-title">Data Seksi Bidang</h4>
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
                          <th>Departemen</th>
                          <th>Deskripsi</th>
                          <th>Jumlah</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          //query sql
                          $no = 1;
                          $sql = "SELECT * FROM `sekbid` ORDER BY `id_sekbid` DESC"; 
                          $query = mysqli_query($koneksi,$sql); 
                          while($data = mysqli_fetch_array($query)){ 
                             $id_sekbid   = $data["id_sekbid"]; 
                             $nama      = $data["nama"];
                             $deskripsi = $data["deskripsi"];
                             $jumlah    = $data["jumlah"];
                            //  $logo      = $data["logo"];
                            //  if (empty($logo)) {$logo="default.png";}
                        ?>
                        <tr>
                          <td class="td-nomer"><?= $no ?></td>
                          <td>
                            <img src="assets/img/logo/<?= $logo ?>" class="rounded-circle img-logo mr-2" style="height:16px;width:16px">
                            <span><?= $nama ?></span>
                          </td>
                          <td><?= $deskripsi ?></td>
                          <td><?= $jumlah ?></td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm btn-table" title="Edit" data-toggle="modal" data-target="#editSekbid" onclick='editSekbid(<?php echo  '"'.$id_sekbid.'"' ?>)'><i class="mdi mdi-pencil"></i></button>
                            <p id="<?= $id_user ?>" class="d-none"><?php echo $nama.','.$deskripsi.','.$jumlah ?></p>
                            
                        </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="modal fade" id="editDepartemen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-pencil"></i> Edit Departemen</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control form-control-sm" id="eNama" name="nama" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control form-control-sm" id="eDeskripsi" name="deskripsi" placeholder="Deskripsi..." required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" class="form-control form-control-sm" id="eJumlah" name="jumlah" placeholder="Jumlah..." required>
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

          

          <script type="text/javascript">
            function editDepartemen(idsekbid){
              var dataSekbid = (document.getElementById(idSekbid).textContent).split(",");
              document.getElementById("eId").value = idSekbid;
              document.getElementById("eNama").value = dataSekbid[0];
              document.getElementById("eDeskripsi").value = dataSekbid[1];
              document.getElementById("eJumlah").value = dataSekbid[2];
            }
            function editLogo(iddept){
              document.getElementById("eIdLogo").value = iddept;
            }

          </script>