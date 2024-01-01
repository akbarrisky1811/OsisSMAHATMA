<?php
include '../koneksi/koneksi.php';
error_reporting(0); 
session_start();
if (isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
 

  if ($password == $cpassword) {
    $check_sql = "SELECT * FROM user_pendaf WHERE email='$email' OR username='$username'";
    $check_result = mysqli_query($koneksi, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
      echo "<script>alert('Data telah ada')</script>";
    } else {
      $sql = "INSERT INTO user_pendaf (nama, email, username, password) VALUES ('$nama', '$email', '$username', '$password')";
      $result = mysqli_query($koneksi, $sql);
      if ($result) {
        echo "<script>alert('Selamat, registrasi berhasil!')</script>";
        $nama = "";
        $username = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
        header("Location: index.php"); // Mengarahkan ke halaman index setelah registrasi berhasil
        exit();
      } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
      }
    }
  } else {
    echo "<script>alert('Password Tidak Sesuai')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>registrasi | Admin</title>
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
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nama" autocomplete="off" placeholder="Nama" value="<?php echo $nama; ?>">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="cpassword" placeholder="Konfirmasi Password">
                </div>
                <div classclass="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Regist</button>
                </div>
                <div class="form-footer mt-2">
                  <p>Belum punya akun? <a href="index.php">Masuk</a></p>
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
