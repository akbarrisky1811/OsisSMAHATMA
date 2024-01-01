<?php  
  include('../koneksi/koneksi.php'); 
  include('includes/session.php');
  date_default_timezone_set("Asia/Jakarta"); 
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <?php include("includes/head.php"); ?>
</head>
<body>
  <div class="container-scroller">
    <?php include("includes/navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include("includes/sidebar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Selamat datang, <?= $nama ?></h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">INFO</p>
                  <p class="mb-4">Lorem ipsum dolor sit amet</p>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <?php include("includes/footer.php"); ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <?php include("includes/script.php"); ?>
</body>

</html>

