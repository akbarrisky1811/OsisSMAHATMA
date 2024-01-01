    <?php
      if (!empty($_POST["q"])) {$q=$_POST["q"];}
      else {$q="";}
    ?>
    <!-- SEARCH -->
    <section class="pt-8 pt-md-10">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <form class="rounded shadow mb-4" method="post">
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text border-0 pr-1">
                    <i class="fe fe-search"></i>
                  </span>
                </div>
                <input type="text" name="q"class="form-control border-0 px-1" aria-label="Search our blog..." placeholder="Search our blog..." <?php if (!empty($_POST["q"])) {echo 'value="'.$_POST["q"].'"';} ?>>
                <div class="input-group-append">
                  <span class="input-group-text border-0 py-0 pl-1 pr-3">
                    <a type="submit" class="btn btn-sm btn-dark text-warning" href="#"> Search</a>
                  </span>
                </div>
              </div>
            </form>
            <div class="d-none row align-items-center">
              <div class="col-auto">
                <h6 class="font-weight-bold text-uppercase text-muted mb-0">Tags:</h6>
              </div>
              <div class="col ml-n5">
                <?php 
                  $query = mysqli_query($koneksi,"SELECT * FROM `tag` ORDER BY `tag`"); 
                  while($data = mysqli_fetch_array($query)){
                    $id_tag  = $data["id_tag"];
                    $tag     = $data["tag"];
                ?>
                <a class="badge badge-pill badge-secondary-soft" href="index.php?page=blog&tag=<?= $id_tag ?>">
                  <span class="h6 text-uppercase"><?= $tag ?></span>
                </a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ARTICLES -->
    <section class="pt-4 pt-md-5 pb-md-12">
      <div class="container">
        <div class="row">
          <?php
            $sql = "SELECT * FROM `post` LEFT JOIN `user` ON `post`.`insert_by`=`user`.`id_user` 
                    WHERE `status`='publish' AND `judul` LIKE '%$q%' ORDER BY `id_post` DESC "; 
            $query = mysqli_query($koneksi,$sql); 
            while($data = mysqli_fetch_array($query)){
              $judul      = $data["judul"];
              $judul2       = "";
              for ($i=0; $i<35; $i++){
                if (empty($judul[$i])) { break; }
                else {$judul2 .= $judul[$i];}
              }
              if (strlen($judul)>35) {
                $judul2 .= "...";
              }
              
              $isi        = strip_tags($data["isi"]);
              $isi2       = "";
              for ($i=0; $i<200; $i++){
                if (empty($isi[$i])) { break; }
                else {$isi2 .= $isi[$i];}
              }
              if (strlen($isi)>200) {
                $isi2 .= "...";
              }
              
              $insert_at  = $data["insert_at"];
              $tanggal    = date_create("$insert_at");
              $author     = $data["nama"];
              $link       = $data["link"];
              $foto       = $data["foto"];
              if (empty($foto)) {$foto="default.png";}

              $thumbnail="assets/img/default.png";
              $doc = new DOMDocument();
              libxml_use_internal_errors(true);
              $doc->loadHTML($data["isi"]);
              $xpath = new DOMXPath($doc);
              $imgs = $xpath->query("//img");
              // for ($i=0; $i<$imgs->length; $i++){
              //   $img = $imgs->item($i);
              //   $thumbnail = $img->getAttribute("src");
              // }
              $img = $imgs->item(0);
              $thumbnail = $img->getAttribute("src");
          ?>
          <div class="col-12 col-md-6 col-lg-4 d-flex my-5">
            <!-- Card -->
            <div class="card mb-6 mb-lg-0 shadow lift lift-lg">
              <!-- Image -->
              <a class="card-img-top" href="post=<?= $link ?>">
                <img src="<?= $thumbnail ?>" alt="..." class="card-img-top">
                <div class="position-relative">
                  <div class="shape shape-bottom shape-fluid-x svg-shim text-white">
                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0v240h2880V0h-720z" fill="currentColor"></path></svg>
                  </div>
                </div>
              </a>
              <!-- Body -->
              <a class="card-body" href="post=<?= $link ?>">
                <h4 style="font-weight:500"><?= $judul ?></h4>
                <p class="mb-0 text-muted d-none" style="font-size: medium"><?= $isi2 ?></p>
              </a>
              <!-- Meta -->
              <a class="card-meta mt-auto d-none" href="#">
                <hr class="card-meta-divider">
                <div class="avatar avatar-sm mr-2">
                  <img src="admin/assets/img/profil/<?= $foto ?>" alt="" class="avatar-img rounded-circle" style="object-position: top;">
                </div>
                <h6 class="text-uppercase text-muted mr-2 mb-0"><?= $author ?></h6>
                <p class="h6 text-uppercase text-muted mb-0 ml-auto">
                  <time datetime=""><?= date_format($tanggal,"d M") ?></time>
                </p>
              </a>
            </div>
          </div>
          <?php } ?>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
		<div class="position-relative">
      <div class="shape shape-bottom shape-fluid-x svg-shim text-black">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>
      </div>
    </div>
