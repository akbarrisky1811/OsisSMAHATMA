<?php
	$tanggal = date("Y-m-d");
	if (isset($_POST["submit-edit"])) {
    if (!empty($_POST["id_post"])&&!empty($_POST["judul"])&&!empty($_POST["isi"])&&!empty($_POST["status"])) {
      $id_post  = $_POST["id_post"];
      $judul    = $_POST["judul"];
      $isi   	  = $_POST["isi"];
      $status   = $_POST["status"];
      mysqli_query($koneksi,"UPDATE `post` SET `judul`='$judul',`isi`='$isi',`status`='$status',`update_by`='$id_user',`update_at`='$tanggal' WHERE `id_post`='$id_post'");
      mysqli_query($koneksi,"DELETE FROM `tag_post` WHERE `id_post`='$id_post'");
      if(!empty($_POST['tag'])){
        $tagg = $_POST['tag'];
        foreach ($tagg as $i){
          mysqli_query($koneksi,"INSERT INTO `tag_post` (`id_post`,`id_tag`,`insert_by`,`insert_at`,`update_by`,`update_at`) VALUES ('$id_post','$i','$id_user','$tanggal','$id_user','$tanggal')");
        }
      }
      $berhasil = "Post berhasil diedit";
    }else {$gagal = "Semua data wajib diisi!";}
  }
?>
<style type="text/css">
	.btn i {font-size: 14px}
	.card-body {padding: 16px !important}
	.card-title, .card {margin-bottom: 16px !important}
</style>
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
<form method="post">
  <?php
    if (isset($_GET["id_post"])) { $id_post = $_GET["id_post"]; }
    if (!isset($_GET["id_post"])) { $id_post = "0"; }
    $query = mysqli_query($koneksi,"SELECT * FROM `post` WHERE `id_post`='$id_post'"); 
    while($data = mysqli_fetch_array($query)){ 
      $judul  = $data["judul"]; 
      $isi    = $data["isi"];
      $link   = $data["link"];
      $status = $data["status"];
      if ($status=="publish") { $btnName = "Publish"; }
      if ($status=="draft") { $btnName = "Save Draft"; }
      if ($status=="trash") { $btnName = "Move to Trash"; }
    }
  ?>
<div class="row">
	<div class="col-md-8">

    <div class="form-group">
      <h3>Edit Postingan</h3>
      <input type="hidden" name="id_post" value="<?= $id_post ?>" required>
      <input type="text" class="form-control form-control-sm" id="judul" name="judul" placeholder="Judul postingan..." value="<?= $judul ?>" maxlength="90" required>
      <p class="mb-md-0 m-1 d-none"><b>Permalink : </b>http://</p>
    </div>
    <textarea class="d-none" id="summernoteExample" name="isi" required>
      <?= $isi ?>
    </textarea>
		
	</div>
	<div class="col-md-4">

		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Publishing</h4>
				<div class="form-group row m-0">
          <div class="form-check col-4 my-0">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="status" value="publish" onclick='setSubmit("publish")' <?php if ($status=="publish") {echo "checked";} ?>>
              Publish
            </label>
          </div>
          <div class="form-check col-4 my-0">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="status" value="draft" onclick='setSubmit("draft")' <?php if ($status=="draft") {echo "checked";} ?>>
              Draft
            </label>
          </div>
          <div class="form-check form-check-danger col-4 my-0">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="status" value="trash" onclick='setSubmit("trash")' <?php if ($status=="trash") {echo "checked";} ?>>
              Trash
            </label>
          </div>
        </div>
        <hr>
        <div class="row m-0">
        	<button type="submit" name="submit-edit" id="submitNew" class="btn btn-primary ml-auto"><?= $btnName ?></button>
        </div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Permalink</h4>
				<input type="text" class="form-control form-control-sm" value="<?= $link ?>" disabled>
			</div>
		</div>

		<div class="card">
      <div class="card-body">
        <h4 class="card-title">Tag</h4>
        <div class="form-group row m-0">
          <?php
            $sql = "SELECT `id_tag`, `tag` FROM `tag` ORDER BY `tag`"; 
            $query = mysqli_query($koneksi,$sql); 
            while($data = mysqli_fetch_array($query)){ 
              $id_tag  = $data["id_tag"]; 
              $tag     = $data["tag"];
              $id_postt = mysqli_num_rows(mysqli_query($koneksi, "SELECT `id_tag` FROM `tag_post` WHERE `id_post`='$id_post' AND `id_tag`='$id_tag'")); 
          ?>
          <div class="form-check col-6 my-0">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="tag[]" value="<?= $id_tag ?>" <?php if($id_postt!=0){echo "checked";} ?>><?= $tag ?>
            </label>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
		
	</div>

</div>
</form>

<script type="text/javascript">
  function setSubmit(data){
  	if (data=="publish") {
  		document.getElementById("submitNew").textContent = "Publish";
  		document.getElementById("submitNew").classList.add("btn-primary");
    	document.getElementById("submitNew").classList.remove("btn-outline-danger");
  	}
    if (data=="draft") {
    	document.getElementById("submitNew").textContent = "Save Draft";
    	document.getElementById("submitNew").classList.add("btn-primary");
    	document.getElementById("submitNew").classList.remove("btn-outline-danger");
    }
    if (data=="trash") {
    	document.getElementById("submitNew").textContent = "Move to Trash";
    	document.getElementById("submitNew").classList.remove("btn-primary");
    	document.getElementById("submitNew").classList.add("btn-outline-danger");
    }
  }
</script>
<script type="text/javascript">
	document.getElementById("judul").addEventListener("change",function(){
		var judul = document.getElementById("judul").value;
		var link = judul.replace(/[^a-z0-9]+/gi, '-').replace(/^-*|-*$/g, '').toLowerCase();
		document.getElementById("link").value = link;
	});
</script>