<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_siswa";
$where = "username = '$_SESSION[username]'";
$link = "?menu=home";

if (isset($_POST['change'])) {
  if ($_POST['password'] == $_POST['con_password']) {
    $pass = base64_encode($_POST['password']);
    $isi = "password = '$pass'";

    $oop->update($con, $table, $isi, $where, $link);
    }
}
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-4" style="margin: auto;">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Change Password</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label class="form-control-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Masukan Password Baru">
              </div>
              <div class="form-group">
                <label class="form-control-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="con_password" placeholder="Konfirmasi Password Baru">
              </div>
              <div class="text-center">
              <button type="submit" name="change" class="btn btn-success"><i class="fa fa-upload"></i> Change</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>