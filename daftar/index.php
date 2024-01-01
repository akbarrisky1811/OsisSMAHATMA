
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Admin</title>
  <?php include("includes/head.php"); ?>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="assets/images/logo.png" alt="logo">
              </div>
              <!-- <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Login to continue.</h6> -->
              <form class="pt-3" method="post" action="ceklogin.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="username"  autocomplete=’off’ placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>

                <?php 
                  if (isset($_GET["gagal"])&&$_GET["gagal"]=="1") {?>
                    <div class="alert alert-danger" role="alert">
                      <p>Username/Password Salah!</p>
                    </div>
                  <?php }
                ?>
                <div class="mt-3">
                  <button type="submit" name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
                 <div class="form-footer mt-2">
                        <p> Belum punya account? <a href="register.php">Register</a></p>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php include("includes/script.php"); ?>
</body>

</html>
