  <?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

$oop = new oop();
$table = "tb_quiz";
@$where = "pkt_soal = '$_GET[id]'";
$link = "?menu=buat_quiz";
@$isi = "pkt_soal = '$_POST[pkt_soal]', nama_quiz = '$_POST[nama_quiz]', jenis = '$_POST[jenis]', lama_waktu = '$_POST[lama_waktu]', jumlah_soal = '$_POST[jumlah_soal]', tgl_upload = '$tgl', status = 'nonaktif'";

$cek_kode = mysqli_query($con, "select max(pkt_soal) from tb_quiz");
@$data = mysqli_fetch_array($cek_kode);
if ($data) {
  $nilaikode = substr($data[0], 1);
  $kode = (int) $nilaikode;
  $kode = $kode + 1;
  $kode_otomatis = "P".str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
  $kode_otomatis = "P0001";
}

if (isset($_POST['simpan'])) {

  $oop->insert($con, $table, $isi, $link);
}

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $where);

  if ($data['jenis'] == "ulangan") {
    $u = "selected";
    $p = "";
    $l = "";
  }elseif ($data['jenis'] == "perbaikan") {
    $u = "";
    $p = "selected";
    $l = "";
  }elseif ($data['jenis'] == "latihan") {
    $u = "";
    $p = "";
    $l = "selected";
  }
}

if (isset($_POST['ubah'])) {

  $oop->update($con, $table, $isi, $where, "?menu=list_quiz");
}
?>

<form method="POST" enctype="multipart/form-data">
  <section class="forms"> 
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <?php if (isset($_GET['edit'])) { ?>
              <h3 class="h4">Edit Quiz</h3>
              <?php }else{ ?>
              <h3 class="h4">Input Quiz</h3>
              <?php } ?>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Paket Soal</label>
                    <?php if (isset($_GET['edit'])) { ?>
                      <input class="form-control" type="text" name="pkt_soal" value="<?= $data['pkt_soal'] ?>" readonly>
                    <?php }else{ ?>
                      <input class="form-control" type="text" name="pkt_soal" value="<?= @$kode_otomatis ?>" readonly>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Nama Quiz</label>
                    <input class="form-control" type="text" name="nama_quiz" value="<?= @$data['nama_quiz'] ?>" placeholder="Masukan Nama Quiz/Ulangan" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Jenis Quiz</label>
                    <select name="jenis" class="form-control" required>
                      <option value="" disabled selected>Pilih Salah Satu</option>
                      <option value="ulangan" <?= @$u ?>>Ulangan</option>
                      <option value="perbaikan" <?= @$p ?>>Perbaikan</option>
                      <option value="latihan" <?= @$l ?>>Latihan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Lama Waktu</label>
                    <input class="form-control" type="number" min="0" name="lama_waktu" value="<?= @$data['lama_waktu'] ?>" placeholder=" * Dalam Menit">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Jumlah Soal</label>
                    <input class="form-control" type="number" min="0" name="jumlah_soal" value="<?= @$data['jumlah_soal'] ?>" placeholder="Masukan Jumlah Soal">
                  </div>
                </div>



                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Daftar Soal</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table id="soal" class="table table-striped table-hover text-center">
                          <thead>
                            <tr>
                              <th>Soal</th>
                              <th>Gambar</th>
                              <th>Jawaban</th>
                              <th>Pilih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (isset($_GET['edit'])) { ?>
        
                              <?php
                              $query = mysqli_query($con, "SELECT * FROM tb_soal WHERE pkt_soal = '$_GET[id]'");
                                while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                  <td><?= $row['soal'] ?></td>
                                  <?php if ($row['gambar'] == "") { ?>
                                  <td>-</td>
                                  <?php }else{ ?>
                                  <td><img src="../foto/<?= $row['gambar'] ?>" width="80px"></td>
                                  <?php } ?>
                                  <td><?= $row['jawaban'] ?></td>
                                  <td>
                                    <input type="checkbox" name="checkbox<?= $row['kd_soal'] ?>" value="check" class="checkbox-template" checked>
                                  </td>
                                </tr>
                                <?php
                                $pkt = $_GET['id'];;
                                $whereUp = "kd_soal = '$row[kd_soal]'"; 
                                if (@$_POST['checkbox' . $row['kd_soal']] == 'check') {
                                  $field = "pkt_soal = '$pkt'";
                                }else{
                                  $field = "pkt_soal = ''";
                                }

                                if (isset($_REQUEST['ubah'])) {
                                  $oop->update($con, "tb_soal", $field, $whereUp, "?menu=list_quiz");
                                }
                                ?>
                                <?php }
                              //selectall
                              $query = mysqli_query($con, "SELECT * FROM tb_soal WHERE pkt_soal = ''");
                              $cek = mysqli_num_rows($query)
                              ;
                              if ($cek == 0) { ?>
                              <tr>
                                <td colspan="10"></td>
                              </tr>
                              <?php }else{
                                while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                  <td><?= $row['soal'] ?></td>
                                  <?php if ($row['gambar'] == "") { ?>
                                  <td>-</td>
                                  <?php }else{ ?>
                                  <td><img src="../foto/<?= $row['gambar'] ?>" width="80px"></td>
                                  <?php } ?>
                                  <td><?= $row['jawaban'] ?></td>
                                  <td>
                                    <input type="checkbox" name="checkbox<?= $row['kd_soal'] ?>" value="check" class="checkbox-template">
                                  </td>
                                </tr>
                                <?php
                                $pkt = $_GET['id'];
                                $whereUp = "kd_soal = '$row[kd_soal]'"; 
                                if (@$_POST['checkbox' . $row['kd_soal']] == 'check') {
                                  $field = "pkt_soal = '$pkt'";
                                }else{
                                  $field = "pkt_soal = ''";
                                }

                                if (isset($_REQUEST['ubah'])) {
                                  $oop->update($con, "tb_soal", $field, $whereUp, "?menu=list_quiz");
                                }
                                ?>
                                <?php }
                              } ?>

                            <?php }else{ ?>

                              <?php
                              $query = mysqli_query($con, "SELECT * FROM tb_soal WHERE pkt_soal = ''");
                              $cek = mysqli_num_rows($query)
                              ;
                              if ($cek == 0) { ?>
                              <tr>
                                <td colspan="10">Nothing</td>
                              </tr>
                              <?php }else{
                                while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                  <td><?= $row['soal'] ?></td>
                                  <?php if ($row['gambar'] == "") { ?>
                                  <td>-</td>
                                  <?php }else{ ?>
                                  <td><img src="../foto/<?= $row['gambar'] ?>" width="80px"></td>
                                  <?php } ?>
                                  <td><?= $row['jawaban'] ?></td>
                                  <td>
                                    <input type="checkbox" name="checkbox<?= $row['kd_soal'] ?>" value="check" class="checkbox-template">
                                  </td>
                                </tr>
                                <?php
                                $pkt = $kode_otomatis;
                                $whereUp = "kd_soal = '$row[kd_soal]'"; 
                                if (@$_POST['checkbox' . $row['kd_soal']] == 'check') {
                                  $field = "pkt_soal = '$pkt'";
                                }else{
                                  $field = "pkt_soal = ''";
                                }

                                if (isset($_REQUEST['simpan'])) {
                                  $oop->update($con, "tb_soal", $field, $whereUp, $link);
                                }
                                ?>
                                <?php }
                              } ?>

                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group text-center">
                    <?php if (isset($_GET['edit'])) { ?>
                    <button type="submit" class="btn btn-success" name="ubah"><i class="fa fa-upload"></i> Edit</button>
                    <?php }else{ ?>
                    <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"></i> Simpan</button>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
