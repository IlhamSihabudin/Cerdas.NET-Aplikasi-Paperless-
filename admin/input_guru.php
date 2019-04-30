<?php 
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');

$tgl_daftar = date('Y-m-d');
$oop = new oop();
$link = "?menu=input_guru";
@$where = "nik = '$_POST[nik]'";
@$whereGet = "nik = '$_GET[id]'";
$table = "tb_guru";

if (isset($_POST['simpan'])) {
  @$nama_file = $_FILES['foto']['name'];
  @$tmp_file = $_FILES['foto']['tmp_name'];
  @$type = $_FILES['foto']['type'];
  if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
    move_uploaded_file($tmp_file,"../foto/$nama_file");

    @$tgl_lahir = $_POST['tgl'] . "-" . $_POST['bulan'] . "-" . $_POST['tahun'];
    @$password = base64_encode($_POST['nik']);
    $isi = "nik = '$_POST[nik]', nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$tgl_lahir', email = '$_POST[email]', alamat = '$_POST[alamat]', foto = '$nama_file', username = '$_POST[nik]', password = '$password', status = 'aktif', tgl_daftar='$tgl_daftar'";

    $oop->insertSelect($con, $table, $isi, $where, $link);
  }
  else{
    echo "<script>alert('Masukan File Bertipe Foto');</script>";      
  }
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

  @$lahir = explode("-", $data['tgl_lahir']);
}

if (isset($_POST['edit'])) {
  @$tgl_lahir = $_POST['tgl'] . "-" . $_POST['bulan'] . "-" . $_POST['tahun'];
  @$password = base64_encode($_POST['nik']);

  @$nama_file = $_FILES['foto']['name'];

  if (@$nama_file != "") {
    @$tmp_file = $_FILES['foto']['tmp_name'];
    @$type = $_FILES['foto']['type'];
    if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
      move_uploaded_file($tmp_file,"../foto/$nama_file");

      $isi = "nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$tgl_lahir', email = '$_POST[email]', alamat = '$_POST[alamat]', foto = '$nama_file', tgl_daftar='$tgl_daftar'";

      $oop->update($con, $table, $isi, $where, $link);
    }else{
      echo "<script>alert('Masukan File Bertipe Foto');</script>";      
    }
  }else{

    $isi = "nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$tgl_lahir', email = '$_POST[email]', alamat = '$_POST[alamat]', tgl_daftar='$tgl_daftar'";

    $oop->update($con, $table, $isi, $where, $link);
  }
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
              <h3 class="h2">Edit Guru</h3>
            <?php }else{ ?>
              <h3 class="h2">Input Guru</h3>
            <?php } ?>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">NIK</label>
                    <?php if (isset($_GET['edit'])) { ?>
                      <input type="number" class="form-control" name="nik" placeholder="Masukan NIK" min="0" required readonly value="<?= @$data['nik'] ?>">
                    <?php }else{ ?>
                      <input type="number" class="form-control" name="nik" placeholder="Masukan NIK" min="0" required>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= @$data['nama'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Jenis Kelamin</label>
                    <select name="jk" class="form-control input-material" required="">
                      <option value="" disabled selected>Pilih Jenis Kelamin</option>
                      <option value="laki-laki" <?= @$l ?>>Laki-Laki</option>
                      <option value="perempuan" <?= @$p ?>>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Tanggal Lahir</label>
                    <div class="row col-lg-12">
                      <select id="tgl" name="tgl" class="form-control col-lg-2" style="float: left;" required>
                        <option value="" disabled selected>Tgl</option>
                        <?php for ($i=1; $i <= 31; $i++) { 
                          if ($lahir[0] == $i) { ?>
                            <option value="<?= $i ?>" selected><?= $i ?></option>
                        <?php }else{ ?> 
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php }
                        } ?>
                      </select>  
                      <select id="bulan" name="bulan" class="form-control col-lg-7" style="float: left;" required>
                        <option value="" disabled selected>Bulan</option>
                        <?php for ($i=1; $i <= 12 ; $i++) { 
                          if ($lahir[1] == $i) {
                            @$bulan[$i] = "selected";
                          }else{
                            @$bulan[$i] = "";
                          }
                        } ?>
                        <option value="1" <?= @$bulan[1] ?>>Januari</option>
                        <option value="2" <?= @$bulan[2] ?>>Februari</option>
                        <option value="3" <?= @$bulan[3] ?>>Maret</option>
                        <option value="4" <?= @$bulan[4] ?>>April</option>
                        <option value="5" <?= @$bulan[5] ?>>Mei</option>
                        <option value="6" <?= @$bulan[6] ?>>Juni</option>
                        <option value="7" <?= @$bulan[7] ?>>Juli</option>
                        <option value="8" <?= @$bulan[8] ?>>Agustus</option>
                        <option value="9" <?= @$bulan[9] ?>>September</option>
                        <option value="10" <?= @$bulan[10] ?>>Oktober</option>
                        <option value="11" <?= @$bulan[11] ?>>November</option>
                        <option value="12" <?= @$bulan[12] ?>>Desember</option>
                      </select>
                      <select id="tahun" name="tahun" class="form-control col-lg-3" style="float: left;" required>
                        <option value="" disabled selected>Tahun</option>
                        <?php for ($t = 1968; $t <= 1997; $t++) { 
                          if ($lahir[2] == $t) {?>
                            <option value="<?= $t ?>" selected><?= $t ?></option>
                          <?php }else{ ?> 
                           <option value="<?= $t ?>"><?= $t ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="<?= @$data['email'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Masukan Alamat" required><?= @$data['alamat'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                  </div>
                  <p class="text-danger">*username dan password default adalah NIK</p>
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
            <h3 class="h2">Daftar Guru</h3>
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
                        <th>JK</th>
                        <th>Tgl Lahir</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Tanggal Daftar</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $tampil = $oop->selectAll($con,$table);
                      if ($tampil == "") { ?>
                      <tr>
                        <td colspan="9">Nothing</td>
                      </tr>
                      <?php }else{
                        foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['nik'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['jk'] ?></td>
                          <td><?= $row['tgl_lahir'] ?></td>
                          <td><?= $row['email'] ?></td>
                          <td><?= $row['alamat'] ?></td>
                          <td><img src="../foto/<?= $row['foto'] ?>" width="80px"></td>
                          <td><?= $row['tgl_daftar'] ?></td>
                          <td>
                            <a href="?menu=input_guru&edit&id=<?= $row['nik'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=input_guru&hapus&id=<?= $row['nik'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
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