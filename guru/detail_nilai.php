<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
@$nis = $_GET['nis'];
@$rombel = $_GET['rombel'];
@$link = "?menu=detail_nilai&rombel=$rombel&nis=$nis";
@$where = "id_hasil = '$_GET[id]'";
$data_profile = $oop->selectWhere($con, "daftar_siswa", "nis = '$nis'");

if (isset($_GET['edit'])) {
  $data  = $oop->selectWhere($con, "tb_hasil", $where);
}

if (isset($_POST['edit'])) {
  $isi = "hasil = '$_POST[hasil]'";
  $oop->update($con, "tb_hasil", $isi, $where, $link);
}

if (isset($_GET['hapus'])) {
  $oop->delete($con, "tb_hasil", $where, $link);
}

if (isset($_POST['kembali'])) {
  echo "<script>document.location.href='?menu=nilai_siswa&rombel=$rombel'</script>";
}
 ?>

<section class="forms"> 
  <div class="container-fluid">
      <form method="POST">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Profil Siswa</h3>
          </div>
          <div class="card-body">
            <div class="row h4">
              <div class="col-lg-6">
                <table class="table">
                    <tr>
                      <td>NIS</td>
                      <td>:</td>
                      <td>
                        <?= $data_profile['nis'] ?>
                      </td>
                    </tr>
                    <tr>  
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                          <?= $data_profile['nama'] ?>
                        </td>
                    </tr>
                    <tr>  
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                          <?= $data_profile['jk'] ?>
                        </td>
                    </tr>
                </table>
              </div>
              <div class="col-lg-6">
                <table class="table">
                    <tr>
                      <td>Rombel</td>
                      <td>:</td>
                      <td>
                        <?= $data_profile['rombel'] ?>
                      </td>
                    </tr>
                    <tr>  
                        <td>Rayon</td>
                        <td>:</td>
                        <td>
                          <?= $data_profile['rayon'] ?>
                        </td>
                    </tr>    
                </table>
              </div>
            </div>  
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Edit Nilai</h3>
          </div>
          <div class="card-body">
            <?php if (isset($_GET['edit'])) { ?>
              <div class="form-group">
                <label class="form-control-label">Nilai</label>
                <input type="text" class="form-control" name="hasil" value="<?= $data['hasil'] ?>">
              </div>
            <?php }else{ ?>
              <div class="form-group">
                <label class="form-control-label">Nilai</label>
                <input type="text" class="form-control" disabled>
              </div>
            <?php } ?>
              <div class="form-group">
                <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-upload"></i> Edit</button>
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" name="kembali" class="btn btn-danger"><i class="fa fa-mail-reply"></i> Kembali</button>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Ulangan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Ulangan' AND nis = '$nis'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($ulangan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $ulangan['nama_quiz'] ?></td>
                            <td><?= $ulangan['hasil'] ?></td>
                            <td><?= $ulangan['tgl'] ?></td>
                            <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&edit&id=<?= $ulangan['id_hasil'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&hapus&id=<?= $ulangan['id_hasil'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                          </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Perbaikan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Perbaikan' AND nis = '$nis'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($perbaikan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $perbaikan['nama_quiz'] ?></td>
                            <td><?= $perbaikan['hasil'] ?></td>
                            <td><?= $perbaikan['tgl'] ?></td>
                            <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&edit&id=<?= $perbaikan['id_hasil'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&hapus&id=<?= $perbaikan['id_hasil'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                          </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Latihan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Latihan' AND nis = '$nis'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($latihan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $latihan['nama_quiz'] ?></td>
                            <td><?= $latihan['hasil'] ?></td>
                            <td><?= $latihan['tgl'] ?></td>
                            <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&edit&id=<?= $latihan['id_hasil'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=detail_nilai&rombel=<?= $rombel ?>&nis=<?= $nis ?>&hapus&id=<?= $latihan['id_hasil'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                          </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </form>
  </div>
</section>