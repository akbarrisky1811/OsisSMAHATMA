<?php 
  /* Tambah */ 
  if (isset($_POST["submit-tambah"])) {
    if (!empty($_POST["tag"])) {
      $tag       = $_POST["tag"];
      mysqli_query($koneksi,"INSERT INTO `tag` (`tag`) VALUES ('$tag')");
      $berhasil = "Tag berhasil ditambahkan";
    }else {$gagal = "Semua data wajib diisi!";}
  }

  /* Edit */
  if (isset($_POST["submit-edit"])) {
    if (!empty($_POST["id_tag"])&&!empty($_POST["tag"])) {
      $id_tag = $_POST["id_tag"];
      $tag    = $_POST["tag"];
      mysqli_query($koneksi,"UPDATE `tag` SET `tag`='$tag' WHERE `id_tag`='$id_tag'");
      $berhasil = "Tag berhasil diedit";
    } 
  }

  /* Hapus */ 
  if (isset($_POST["submit-hapus"])) {
    if (!empty($_POST["id_tag"])) {
      $id_tag  = $_POST["id_tag"];
      mysqli_query($koneksi,"DELETE from `tag` where `id_tag` = '$id_tag'");
      $berhasil = "Tag berhasil dihapus";
    }
  } 
?> 
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                      <h2>Pengaturan Tag</h2>
                      <button type="button" class="btn btn-outline-primary btn-sm ml-3" data-toggle="modal" data-target="#tambahTag" style="height: fit-content;">
                        Tambah Tag
                      </button>
                    </div>
                    <p class="mb-md-0">Tambah, Edit dan Hapus Tag.</p>
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
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="data-alumni" class="table">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Tag</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          //query sql
                          $no = 1;
                          $sql = "SELECT * FROM `tag` ORDER BY `id_tag` DESC"; 
                          $query = mysqli_query($koneksi,$sql); 
                          while($data = mysqli_fetch_array($query)){ 
                             $id_tag    = $data["id_tag"]; 
                             $tag       = $data["tag"];
                        ?>
                        <tr>
                          <td class="td-nomer"><?= $no ?></td>
                          <td><?= $tag ?></td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm btn-table" title="Edit" data-toggle="modal" data-target="#editTag" onclick='editTag(<?php echo  '"'.$id_tag.'"' ?>)'><i class="mdi mdi-pencil"></i></button>
                            <p id="<?= $id_tag ?>" class="d-none"><?php echo $tag ?></p>
                            <button type="button" class="btn btn-danger btn-sm btn-table" title="Hapus" data-toggle="modal" data-target="#hapusTag" onclick='hapusTag(<?php echo  '"'.$id_tag.'"' ?>)'><i class="mdi mdi-delete-forever"></i></button>
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

          <div class="modal fade" id="tambahTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-tag"></i> Tambah Tag</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="tag">Nama Tag</label>
                      <input type="text" class="form-control form-control-sm" id="tag" name="tag" placeholder="Nama Tag..." required>
                    </div>
                    <div class="modal-footer p-0 pt-3">
                      <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-sm btn-success" name="submit-tambah"><i class="mdi mdi-check"></i><span> Submit</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-tag"></i> Edit Tag</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <input type="hidden" class="d-none" id="eIdTag" name="id_tag" required>
                      <label for="tag">Nama Tag</label>
                      <input type="text" class="form-control form-control-sm" id="eTag" name="tag" value="" required>
                    </div>
                    <div class="modal-footer p-0 pt-3">
                      <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-sm btn-success" name="submit-edit"><i class="mdi mdi-check"></i><span> Submit</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>  

          <div class="modal fade" id="hapusTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaHapus"><i class="mdi mdi-delete-forever"></i> Hapus Tag</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="eIdHapus" name="id_tag" required>
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
            function editTag(idtag){
              var dataTag = (document.getElementById(idtag).textContent).split(",");
              document.getElementById("eIdTag").value = idtag;
              document.getElementById("eTag").value = dataTag[0];
            }
            function hapusTag(idtag){
              var dataTag = (document.getElementById(idtag).textContent).split(",");
              document.getElementById("eIdHapus").value = idtag;
              document.getElementById("eDesc").textContent = 'Apakah anda yakin ingin menghapus "'+dataTag[0]+'"?';
            }
          </script>