<?php
  if (isset($_POST["submit-password"])) {
    if (!empty($_POST["passl"])&&!empty($_POST["passb"])&&!empty($_POST["passk"])) {
      $passl = MD5($_POST['passl']);
      $passb = MD5($_POST['passb']); 
      $passk = MD5($_POST['passk']); 

      //get password 
      $query = mysqli_query($koneksi, "SELECT `password` FROM `user` WHERE `id_user`='$id_user'"); 
      while($data = mysqli_fetch_row($query)){ $pass = $data[0];}

      if ($passl!=$pass){$pl="salah";}
      if ($passb==$pass){$pb="sama";}
      if ($passb!=$passk){$pk="salah";}
      if (empty($pl)&&empty($pb)&&empty($pk)) {
        //echo "pass  = ".$pass."<br>passl = ".$passl."<br>passb = ".$passb."<br>passk = ".$passk."<br>";
        $password = $passb;
        mysqli_query($koneksi,"UPDATE `user` SET `password`='$password' WHERE `id_user`='$id_user'");
        $notif="editberhasil";
      }
    }
  }
?>

          <section class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Password</h4>
                  <?php
                    if (!empty($notif)&&$notif=="editberhasil") { ?>
                      <div class="alert alert-success" role="alert">
                        <p>Password berhasil diedit</p>
                      </div>
                    <?php }
                  ?>
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="passl">Password Lama</label>
                      <input type="password" class="form-control" id="passl" name="passl" placeholder="Masukkan password lama" required>
                      <?php
                        if (!empty($pl)&&$pl=="salah") { ?>
                          <p class="text-danger">Password lama salah!</p>
                        <?php }
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="passb">Password Baru</label>
                      <input type="password" class="form-control" id="passb" name="passb" placeholder="Masukkan password baru" required>
                      <?php
                        if (!empty($pb)&&$pb=="sama") { ?>
                          <p class="text-danger">Password baru tidak boleh sama dengan password lama!</p>
                        <?php }
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="passk">Konfirmasi Password baru</label>
                      <input type="password" class="form-control" id="passk" name="passk" placeholder="Masukkan password konfirmasi" required>
                      <?php
                        if (!empty($pk)&&$pk=="salah") { ?>
                          <p class="text-danger">Password konfirmasi salah!</p>
                        <?php }
                      ?>
                    </div>
                    <div class="row">
                      <button type="submit" name="submit-password" class="btn btn-primary mr-2 ml-auto">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>