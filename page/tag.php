<?php
  if (isset($_GET["link"])) {
    $link = $_GET["link"]; 
    $sql = "SELECT * FROM `post` LEFT JOIN `user` ON `post`.`insert_by`=`user`.`id_user` WHERE `link`='$link'"; 
    if (mysqli_num_rows(mysqli_query($koneksi, $sql))==1) { $valid = 1; }
    else{ $valid=0; }
  }
  else{ $valid=0; }
?>

<?php 
  if ($valid==1) { ?>
    <?php
      $query = mysqli_query($koneksi,$sql); 
      while($data = mysqli_fetch_array($query)){
        $judul      = $data["judul"];
        $isi        = $data["isi"];
        $insert_at  = $data["insert_at"];
        $tanggal    = date_create("$insert_at");
        $author     = $data["nama"];
        $link       = $data["link"];
        $views      = $data["views"];
        $views2     = $views+1;
        $foto       = $data["foto"];
        if (empty($foto)) {$foto="default.png";}
        mysqli_query($koneksi,"UPDATE `post` SET `views`='$views2' WHERE `link`='$link'");
      }
    ?>
    <!-- POST -->
    <section class="pt-8 pt-md-11 pb-12">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md">
            <a href="blog" class="font-weight-bold font-size-sm text-decoration-none text-dark mb-3">
              <i class="fe fe-arrow-left mr-3"></i> All Post
            </a>
            <h1 class="display-4 mb-2 text-dark"><?= $judul ?></h1>
            <p class="font-size-md text-gray-700 mb-5 mb-md-0">Posted by <?= $author ?>, <?= date_format($tanggal,"d M Y") ?></p>
          </div>
          <!-- <div class="col-auto">
            <a href="#!" class="btn btn-primary-soft mr-1">Refer a friend</a>
            <a href="#!" class="btn btn-primary">Apply</a>
          </div> -->
        </div>
        <div class="row">
          <div class="col-12">
            <hr class="my-6 my-md-8 border-gray-300">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-8 post">
            <?= $isi ?>
          </div>
          <div class="col-12 col-md-4">
            
            <div class="card mb-5" style="border: 1px solid #d9e2ef;">
              <div class="card-body">
                <h5 class="text-uppercase text-dark font-weight-bold">Popular Post</h5>
                <hr class="my-2">
                <?php
                  $query = mysqli_query($koneksi,"SELECT * FROM `post` WHERE `status`='publish' ORDER BY `views` DESC LIMIT 5"); 
                  while($data = mysqli_fetch_array($query)){
                    $judul     = $data["judul"];
                    $link      = $data["link"];
                ?>
                <a href="post=<?= $link ?>" class="text-reset font-size-sm"><?= $judul ?></a>
                <hr class="my-2">
                <?php } ?>
              </div>
            </div>
            <div class="d-none card mb-5" style="border: 1px solid #d9e2ef;">
              <div class="card-body">
                <h5 class="text-uppercase text-dark font-weight-bold">Tags</h5>
                <hr class="my-2">
                <?php 
                  $query = mysqli_query($koneksi,"SELECT * FROM `tag` ORDER BY `tag`"); 
                  while($data = mysqli_fetch_array($query)){
                    $id_tag  = $data["id_tag"];
                    $tag     = $data["tag"];
                ?>
                <a class="badge badge-pill badge-secondary-soft mb-2" href="index.php?page=blog%tag=<?= $id_tag ?>">
                  <span class="h6 text-uppercase"><?= $tag ?></span>
                </a>
                <?php } ?>
              </div>
            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
  <?php }else{ ?>
    <!-- ERROR 404 -->
    <section class="" id="post404" style="background-image: url(assets/uploads/Misaka9982_animeProfile.jpg);background-repeat: no-repeat;background-size: cover;background-position: center;">
      <div class="py-14" style="background-color: #ffffffcf;">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 text-center">
              <h2 class="font-weight-bold">Error 404</h2>
              <p class="font-size-lg text-muted">Postingan tidak ditemukan</p>
              <a href="#" onclick="history.back()" class="btn btn-sm btn-dark text-warning shadow lift">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } 
?>

		<div class="position-relative">
      <div class="shape shape-bottom shape-fluid-x svg-shim text-black">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>
      </div>
    </div>