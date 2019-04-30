<?php 
include '../config/koneksi.php';

if (isset($_POST['change'])) {
  if ($_POST['password'] == $_POST['con_password']) {
    $user = base64_encode($_POST['username']);
    $pass = base64_encode($_POST['password']);

    $query = mysqli_query($con, "UPDATE tb_admin SET username = '$user', password = '$pass' WHERE 1");
    if ($query) {
        echo "<script>alert('Akun Berhasil Di Update');document.location.href='?menu=home'</script>";
      }else{
        echo "<script>alert('Terjadi Kesalahan!!')</script>";
      }
  }else{
    echo "<script>alert('Password Tidak Sama')</script>";
  }
}
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-6" style="margin: auto;">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Change Profile Admin</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label class="form-control-label">Username</label>
                <input type="password" class="form-control" name="username" placeholder="Masukan Username Baru">
              </div>
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