<?php  
  include('../koneksi/koneksi.php'); 
  include('includes/session.php');
  date_default_timezone_set("Asia/Jakarta"); 
  if (isset($_GET["page"])) {
	  $page = $_GET["page"]; 
	  //pemanggilan ke halaman-halaman menu admin 
	  $admin_page = array("logout");
	  if  (in_array($page, $admin_page)) {
	    include("page/$page.php");
	  }
	}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Daftar | OSIS SMA Hang Tuah 5 Sidoarjo<?= ucfirst($page) ?></title>
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <?php include("includes/head.php"); ?>
</head>
<body>
  <div class="container-scroller">
    <?php include("includes/navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include("includes/sidebar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper pt-4">
          
          <?php  
            if (isset($_GET["page"])) {
              $page = $_GET["page"]; 
              //pemanggilan ke halaman-halaman menu admin 
              $admin_page = array(
                "logout", "profil", "password", "daftar_anggota", "dasboard"
              );
              if  (in_array($page, $admin_page)) {
                //$pagee = str_replace("-", "", $page);
                include("page/$page.php");
              }else{echo "Page not found!";}
            }
            else{ include("page/dasboard.php"); }   
          ?>

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

