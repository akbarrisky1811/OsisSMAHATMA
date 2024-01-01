<?php  

?>
          <section class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">/
                    <h2>Selamat datang, <? var_dump($nama) ?></h2>.
                    <p class="d-none mb-md-0">Your analytics dashboard template.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
          
          <section class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card" style="background-position: right; background-repeat: no-repeat; background-size: contain;">
                <div style="background-color: #ffffff50;">
                  <div class="card-body">
                    <p class="card-title">Overview</p>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-pin" style="transform: rotate(45deg);"></i>
                      <p class="mb-0 ml-1">Total Post : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `post`")) ?></p>
                    </div>
                    <?php
                      $views=0;
                      $query = mysqli_query($koneksi,"SELECT * FROM `post`"); 
                      while($data = mysqli_fetch_array($query)){ $views += $data["views"]; }
                    ?>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-eye"></i>
                      <p class="mb-0 ml-1">Total Post Views : <?= $views ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-account"></i>
                      <p class="mb-0 ml-1">Total Pendaftar : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `tb_pendaftaran`")) ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-tag"></i>
                      <p class="mb-0 ml-1">Total Tag : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `tag`")) ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-account"></i>
                      <p class="mb-0 ml-1">Total User : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `user`")) ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-lan"></i>
                      <p class="mb-0 ml-1">Total Seksi Bidang : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `sekbid`")) ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <i class="mdi mdi-account-multiple"></i>
                      <p class="mb-0 ml-1">Total Anggota : <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `anggota`")) ?></p>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </section>