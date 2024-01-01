<?php 
$koneksi = mysqli_connect("localhost","root","","osis_smahatma"); 
// cek koneksi 
if (!$koneksi){ 
  die("Error koneksi: " . mysqli_connect_errno()); 
} 

?> 