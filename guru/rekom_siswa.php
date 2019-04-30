<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$link = "?menu=rekom_siswa";

if (!empty($_GET['rombel'])) {
$isi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_rombel WHERE rombel='$_GET[rombel]'"));
$kd_rombel = $isi['kd_rombel'];
$rombel = $isi['rombel'];

}

if (isset($_POST['reset'])) {
  $link1 = "?menu=rekom_siswa&rombel=$rombel";
  $where = "kd_rombel = '$kd_rombel'";
  $isi = "rekomendasi = 'ya'";
  $oop->update($con, "tb_siswa", $isi, $where, $link1);
}
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Filter</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="form-control-label">Filter Menurut Rombel</label>
                <select name="rombel" class="form-control" required>
                  <?php if (!empty($_GET['rombel'])) { ?>
                    <option value="<?= $kd_rombel ?>" disabled selected><?= $rombel ?></option>
                  <?php }else{ ?>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                  <?php }

                  $tampil = $oop->selectAll($con, "tb_rombel");
                  if ($tampil == "") { ?>
                      <option value="" disabled>Tidak Ada Rombel</option>
                  <?php }else{ 
                   foreach ($tampil as $rombel) { ?>
                      <option value="<?= $rombel['rombel'] ?>"><?= $rombel['rombel'] ?></option>
                      <?php }
                  } ?>
                </select>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary" name="go"><i class="fa "></i> Go</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  
<?php 
if (isset($_POST['go'])) {
  echo "<script>document.location.href='?menu=rekom_siswa&rombel=$_POST[rombel]'</script>";
}

if (!empty($_GET['rombel'])) { ?>
  
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Rekomendasi Ulangan Siswa</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th rowspan="2">NIS</th>
                      <th rowspan="2">Nama Siswa</th>
                      <th rowspan="2">Jenis Kelamin</th>
                      <th rowspan="2">Rombel</th>
                      <th rowspan="2">Rayon</th>
                      <th colspan="2">Rekomendasi</th>
                    </tr>
                    <tr>
                      <th>Ya</th>
                      <th>Tidak</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM daftar_siswa WHERE rombel = '$_GET[rombel]'");
                    $cek = mysqli_num_rows($query);
                    if ($cek == 0) { ?>
                    <tr>
                      <td colspan="7">Nothing</td>
                    </tr>
                    <?php }else{
                      while ($row = mysqli_fetch_array($query)) {
                          if ($row['rekomendasi'] == "ya") {
                            $ya = "checked";
                            $tidak = "";
                          }elseif ($row['rekomendasi'] == "tidak") {
                            $ya = "";
                            $tidak = "checked";
                          }
                        ?>
                        <tr>
                          <td><?= $row['nis'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['jk'] ?></td>
                          <td><?= $row['rombel'] ?></td>
                          <td><?= $row['rayon'] ?></td>
                          <td>
                            <input type="radio" name="recom<?= $row['nis'] ?>" value="ya" class="checkbox-template" <?= @$ya ?>>
                          </td>
                          <td>
                            <input type="radio" name="recom<?= $row['nis'] ?>" value="tidak" class="checkbox-template" <?= @$tidak ?>>
                          </td>
                        </tr>
                        <?php
                        $whereUp = "nis = '$row[nis]'"; 
                        if (@$_POST['recom' . $row['nis']] == 'ya') {
                          $field = "rekomendasi = 'ya'";
                        }else{
                          $field = "rekomendasi = 'tidak'";
                        }

                        if (isset($_REQUEST['simpan'])) {
                          $oop->update($con, "tb_siswa", $field, $whereUp, $link);
                        }
                        ?>
                        <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-danger" name="reset"><i class="fa fa-rotate-left"></i> Setelan Awal</button>
                <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"></i> Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

<?php } ?>
    </div>
  </div>
</section>