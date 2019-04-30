<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$link = "?menu=akun_guru";
@$where = "nik = '$_POST[nik]'";
@$whereGet = "nik = '$_GET[id]'";
$table = "tb_guru";
@$nik = $_GET['id'];

if (isset($_GET['nonaktifkan'])) {
  $isi = "status = 'nonaktif'";
  $oop->update($con, $table, $isi, $whereGet, $link);
}
if (isset($_GET['aktifkan'])) {
  $isi = "status = 'aktif'";
  $oop->update($con, $table, $isi, $whereGet, $link);
}

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $whereGet);
}

if (isset($_POST['edit'])) {
  $password = base64_encode($_POST['password']);
  $isi = "username = '$nik', password = '$password'";

  $oop->update($con, $table, $isi, $whereGet, $link);
}

if (isset($_POST['reset'])) {
  if (isset($_GET['edit'])) {
    $password = base64_encode($nik);
    $isi1 = "username = '$nik', password = '$password', status = 'aktif'";

    $oop->update($con, $table, $isi1, $whereGet, $link);
  }else{
    echo "<script>alert('Pilih Akun Dahulu')</script>";
  }
}
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header d-flex align-items-center">
              <h3 class="h2">Edit Akun Guru</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label class="form-control-label">Username</label>
                  <input type="text" class="form-control" value="<?= @$data['username'] ?>" readonly required>
                </div>
                <?php if (isset($_GET['edit'])) { ?>
                <div class="form-group">
                  <label class="form-control-label">Password</label>
                  <input type="text" class="form-control" name="password" value="<?= base64_decode($data['password']) ?>" required>
                </div>
                <?php }else{ ?>
                <div class="form-group">
                  <label class="form-control-label">Password</label>
                  <input type="text" class="form-control" readonly required>
                </div>
                <?php } ?>
              <button type="submit" class="btn btn-success col-lg-12" name="edit" style="margin: 1px;"><i class="fa fa-upload"></i> Edit</button>
            </form>
            <form method="post">
              <button type="submit" class="btn btn-danger col-lg-12" name="reset" style="margin: 1px;"><i class="fa fa-mail-reply"></i> Reset Default</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center">
              <h3 class="h2">List Guru</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $tampil = $oop->selectAll($con,$table);
                      if ($tampil == "") { ?>
                      <tr>
                        <td colspan="6">Nothing</td>
                      </tr>
                      <?php }else{
                        foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['nik'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['username'] ?></td>
                          <td><?= $row['password'] ?></td>
                          <td>
                            <?php if ($row['status'] == "aktif") { ?>
                              <a href="?menu=akun_guru&nonaktifkan&id=<?= $row['nik'] ?>" class="btn btn-info">Nonaktifkan</a>
                            <?php }else{ ?>
                              <a href="?menu=akun_guru&aktifkan&id=<?= $row['nik'] ?>" class="btn btn-secondary">Aktifkan</a>
                            <?php } ?>
                          </td>
                          <td>
                            <a href="?menu=akun_guru&edit&id=<?= $row['nik'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                        </tr>
                        <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>