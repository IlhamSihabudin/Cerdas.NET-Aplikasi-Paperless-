<?php 
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');

$tgl_daftar = date('Y-m-d');
$oop = new oop();
$link = "?menu=input_siswa";
@$where = "nis = '$_POST[nis]'";
@$whereGet = "nis = '$_GET[id]'";
$table = "tb_siswa";

if (isset($_POST['simpan'])) {
    @$password = base64_encode($_POST['nis']);

    $isi = "nis = '$_POST[nis]', nama = '$_POST[nama]', jk = '$_POST[jk]', kd_rombel = '$_POST[rombel]', kd_rayon = '$_POST[rayon]', username = '$_POST[nis]', password = '$password', rekomendasi = 'ya', tgl_daftar='$tgl_daftar'";

    $oop->insertSelect($con, $table, $isi, $where, $link);
}

if (isset($_GET['hapus'])) {

  $oop->delete($con, $table, $whereGet, $link);
}

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $whereGet);

  if ($data['jk'] == "laki-laki") {
    $l = "selected";
    $p = "";
  }elseif ($data['jk'] == "perempuan") {
    $l = "";
    $p = "selected";
  }

  $sql = mysqli_query($con, "SELECT * FROM tb_rombel");
  $rombel = mysqli_num_rows($sql);

  $sql1 = mysqli_query($con, "SELECT * FROM tb_rayon");
  $rayon = mysqli_num_rows($sql1);
}

if (isset($_POST['edit'])) {
  @$password = base64_encode($_POST['nis']);

    $isi = "nama = '$_POST[nama]', jk = '$_POST[jk]', kd_rombel = '$_POST[rombel]', kd_rayon = '$_POST[rayon]', rekomendasi = 'ya', tgl_daftar='$tgl_daftar'";
    
    $oop->update($con, $table, $isi, $whereGet, $link);
}

?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <?php if (isset($_GET['edit'])) { ?>
              <h3 class="h2">Edit Siswa</h3>
            <?php }else{ ?>
              <h3 class="h2">Input Siswa</h3>
            <?php } ?>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">NIS</label>
                    <?php if (isset($_GET['edit'])) { ?>
                      <input type="number" class="form-control" name="nis" placeholder="Masukan nis" min="0" required readonly value="<?= @$data['nis'] ?>">
                    <?php }else{ ?>
                      <input type="number" class="form-control" name="nis" placeholder="Masukan nis" min="0" required>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= @$data['nama'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Jenis Kelamin</label>
                    <select name="jk" class="form-control input-material">
                      <option value="" disabled selected>Pilih Jenis Kelamin</option>
                      <option value="laki-laki" <?= @$l ?>>Laki-Laki</option>
                      <option value="perempuan" <?= @$p ?>>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Rombel</label>
                    <select name="rombel" class="form-control" required>
                      <option value="" disabled selected>Pilih Salah Satu</option>
                      <?php 
                        $tampil = $oop->selectAll($con, "tb_rombel");
                        if ($tampil == "") { ?>
                          <option value=""></option>
                      <?php }else{ 
                            foreach ($tampil as $row) { 
                              if (@$data['kd_rombel'] == $row['kd_rombel']) { ?>
                                <option value="<?= $row['kd_rombel'] ?>" selected><?= $row['rombel'] ?></option>
                              <?php }else{?>
                                <option value="<?= $row['kd_rombel'] ?>"><?= $row['rombel'] ?></option>
                      <?php   }
                            }
                          } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Rayon</label>
                    <select name="rayon" class="form-control" required>
                      <option value="" disabled selected>Pilih Salah Satu</option>
                      <?php 
                        $tampil = $oop->selectAll($con, "tb_rayon");
                        if ($tampil == "") { ?>
                          <option value=""></option>
                      <?php }else{ 
                        foreach ($tampil as $row) { 
                          if (@$data['kd_rayon'] == $row['kd_rayon']) { ?>
                                <option value="<?= $row['kd_rayon'] ?>" selected><?= $row['rayon'] ?></option>
                              <?php }else{?>
                                <option value="<?= $row['kd_rayon'] ?>"><?= $row['rayon'] ?></option>
                      <?php   }
                           }
                      } ?>
                    </select>
                  </div>
                  <p class="text-danger">*username dan password default adalah nis</p>
                </div>
                <div class="text-center col-lg-12">
                  <?php if (isset($_GET['edit'])) { ?>
                    <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-upload"> </i> Edit</button>
                  <?php }else{ ?>
                    <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"> </i> Simpan</button>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h2">Daftar Siswa</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Rombel</th>
                        <th>Rayon</th>
                        <th>Tanggal Daftar</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $tampil = $oop->selectAll($con,"daftar_siswa");
                      if ($tampil == "") { ?>
                      <tr>
                        <td colspan="7">Nothing</td>
                      </tr>
                      <?php }else{
                        foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['nis'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['jk'] ?></td>
                          <td><?= $row['rombel'] ?></td>
                          <td><?= $row['rayon'] ?></td>
                          <td><?= $row['tgl_daftar'] ?></td>
                          <td>
                            <a href="?menu=input_siswa&edit&id=<?= $row['nis'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=input_siswa&hapus&id=<?= $row['nis'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                          </td>
                        </tr>
                        <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>