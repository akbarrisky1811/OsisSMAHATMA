<?php 
  if (isset($_POST["submit-trash"])) {
    if (!empty($_POST["id_post"])) {
      $id_post  = $_POST["id_post"];
      mysqli_query($koneksi,"UPDATE `post` SET `status`='trash' WHERE `id_post`='$id_post'");
      $berhasil = "Post berhasil diedit";
    }else {$gagal = "Semua data wajib diisi!";}
  }
  if (isset($_POST["submit-delete"])) {
    if (!empty($_POST["id_post"])) {
      $id_post  = $_POST["id_post"];
      mysqli_query($koneksi,"DELETE FROM `post` WHERE `id_post`='$id_post'");
      $berhasil = "Post berhasil dihapus";
    }else {$gagal = "Semua data wajib diisi!";}
  }
?> 
          <style type="text/css">
            .card-title {text-transform: none !important; font-weight: 400 !important}
          </style>
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <div class="row m-0">
                      <h2>Semua Post</h2>
                      <a href="post-new" type="button" class="btn btn-outline-primary btn-sm ml-3" style="height: fit-content;">
                        Tambah Post
                      </a>
                    </div>
                    <p class="mb-md-0">Tambah, Edit dan Delete Post.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="card">
            <div class="card-body">
              <h4 class="mb-4">
                <span class="card-title"><a href="post">All</a> 
                  (<?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `post`")) ?>) | </span>
                <span class="card-title"><a href="post_type-publish">Published</a> 
                  (<?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `post` WHERE `status`='publish'")) ?>) | </span>
                <span class="card-title"><a href="post_type-draft">Draft</a> 
                  (<?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `post` WHERE `status`='draft'")) ?>) | </span>
                <span class="card-title"><a href="post_type-trash">Trash</a> 
                  (<?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `post` WHERE `status`='trash'")) ?>)</span>
              </h4>
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
              <?php 
                if (isset($_GET["berhasil"])&&$_GET["berhasil"]==1) { ?>
                  <div class="alert alert-success col-12" role="alert">
                    <p>Postingan berhasil dibuat</p>
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
                          <th>Judul</th>
                          <th>Author</th>
                          <!-- <th>Tags</th> -->
                          <th>Views</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          //query sql
                          $no = 1;
                          $sql = "SELECT * FROM `post` LEFT JOIN `user` ON `post`.`insert_by`=`user`.`id_user`"; 
                          if (isset($_GET["post_type"])) { 
                            $post_type=$_GET["post_type"]; 
                            $sql .= " WHERE `post`.`status` LIKE '$post_type'";
                          }
                          $sql .= " ORDER BY `id_post` DESC";
                          $query = mysqli_query($koneksi,$sql); 
                          while($data = mysqli_fetch_array($query)){ 
                            $id_post = $data["id_post"]; 
                            $judul   = $data["judul"]; 
                            $author  = $data["nama"];
                            $views   = $data["views"];
                            $date    = $data["update_at"];
                            $status  = $data["status"];
                            $link    = $data["link"];
                        ?>
                        <tr>
                          <td class="td-nomer"><?= $no ?></td>
                          <td><?= $judul ?></td>
                          <td><?= $author ?></td>
                          <!-- <td></td> -->
                          <td><?= $views ?></td>
                          <td>
                              <p style="text-transform: capitalize;">
                                <?php if ($status=="publish") {echo "Published";} else {echo $status;} ?>
                              </p>
                          </td>
                          <td><?= $date ?></td>
                          <td>
                            <p id="<?= $id_post ?>" class="d-none"><?php echo $judul; ?></p>
                            <a href="post-edit-id-<?= $id_post ?>" type="button" class="btn btn-primary btn-sm btn-table" title="Edit"><i class="mdi mdi-pencil"></i></a>
                            <?php 
                              if ($status=="publish") { ?>
                                <a href="../post=<?= $link ?>" type="button" target="_blank" class="btn btn-primary btn-sm btn-table" title="Lihat Postingan"><i class="mdi mdi-eye"></i></a>
                              <?php } if ($status=="publish"||$status=="draft") {?>
                                <button type="button" class="btn btn-danger btn-sm btn-table" title="Hapus" data-toggle="modal" data-target="#hapusPost" onclick='hapusPost(<?php echo '"'.$id_post.'"' ?>)'><i class="mdi mdi-delete"></i></button>
                              <?php } if ($status=="trash") {?>
                                <button type="button" class="btn btn-danger btn-sm btn-table" title="Hapus permanent" data-toggle="modal" data-target="#deletePost" onclick='deletePost(<?php echo '"'.$id_post.'"' ?>)'><i class="mdi mdi-delete-forever"></i></button>
                              <?php }
                            ?>
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

          <div class="modal fade" id="hapusPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaLogo"><i class="mdi mdi-delete"></i> Pindahkan ke Sampah</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="eIdPost" name="id_post" required>
                    <div class="form-group">
                      <p class="" id="eDesc">Apakah anda yakin ingin menghapus?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark btn-light" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-outline-danger" name="submit-trash" ><i class="mdi mdi-delete"></i><span> Trash</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eNamaLogo"><i class="mdi mdi-delete-forever"></i> Hapus Postingan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="d-none" id="dId" name="id_post" required>
                    <div class="form-group">
                      <p class="" id="dDesc">Apakah anda yakin ingin menghapus?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark btn-light" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger" name="submit-delete" ><i class="mdi mdi-delete-forever"></i><span> Hapus</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function hapusPost(idpost){
              var dataPost = (document.getElementById(idpost).textContent).split(",");
              document.getElementById("eIdPost").value = idpost;
              document.getElementById("eDesc").textContent = 'Apakah anda yakin ingin memindahkan "'+dataPost[0]+'" ke sampah?';
            }
            function deletePost(idpost){
              var dataPost = (document.getElementById(idpost).textContent).split(",");
              document.getElementById("dId").value = idpost;
              document.getElementById("dDesc").textContent = 'Apakah anda yakin ingin menghapus "'+dataPost[0]+'"?';
            }
          </script>