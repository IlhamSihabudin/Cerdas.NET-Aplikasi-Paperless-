<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_guru";
$where = "username = '$_SESSION[username]'";
$link = "?menu=home";

$data = $oop->selectWhere($con, $table, $where);

  if ($data['jk'] == "laki-laki") {
    $l = "selected";
    $p = "";
  }elseif ($data['jk'] == "perempuan") {
    $l = "";
    $p = "selected";
  }

  @$lahir = explode("-", $data['tgl_lahir']);

if (isset($_POST['edit'])) {
  @$tgl_lahir = $_POST['tgl'] . "-" . $_POST['bulan'] . "-" . $_POST['tahun'];
  @$password = base64_encode($_POST['nik']);

  if (@$_POST['foto'] != "") {
    @$nama_file = $_FILES['foto']['name'];
    @$tmp_file = $_FILES['foto']['tmp_name'];
    @$type = $_FILES['foto']['type'];
      if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
        move_uploaded_file($tmp_file,"../foto/$nama_file");
      }else{
        echo "<script>alert('Masukan File Bertipe Foto');</script>"; 

      $isi = "nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$tgl_lahir', email = '$_POST[email]', alamat = '$_POST[alamat]', foto = '$nama_file'";
      }
    }else{
      $isi = "nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$tgl_lahir', email = '$_POST[email]', alamat = '$_POST[alamat]'";
    }
    $oop->update($con, $table, $isi, $where, $link);
  }
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
              <h3 class="h2">Edit Profile</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">NIK</label>
                      <input type="number" class="form-control" name="nik" placeholder="Masukan NIK" min="0" required readonly value="<?= @$data['nik'] ?>">
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
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Masukan Alamat"><?= @$data['alamat'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                  </div>
                </div>
                <div class="text-center col-lg-12">
                    <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-upload"> </i> Edit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>