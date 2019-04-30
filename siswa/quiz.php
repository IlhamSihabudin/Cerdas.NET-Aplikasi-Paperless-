<?php
unset($_SESSION['pkt_soal']);
unset($_SESSION['no']);
unset($_SESSION['soal']);
unset($_SESSION['gambar']);
unset($_SESSION['opsi_a']);
unset($_SESSION['opsi_b']);
unset($_SESSION['opsi_c']);
unset($_SESSION['opsi_d']);
unset($_SESSION['opsi_e']);
unset($_SESSION['jawaban']);
unset($_SESSION['user_jawaban']);
unset($_SESSION['jenis_quiz']);
unset($_SESSION['mulai']);

include '../config/koneksi.php';
include '../library/controllers.php';
$oop = new oop();

$quiz = "Ulangan";
if(isset($_POST['btn_ulangan'])){
  $quiz = "Ulangan";
}
if(isset($_POST['btn_perbaikan'])){
  $quiz = "Perbaikan";
}
if(isset($_POST['btn_latihan'])){
  $quiz = "Latihan";
}

?>

<form method="post">
  <section class="forms"> 
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6" style="margin: auto;">
          <div class="card">
            <div class="card-title col-lg-12">
              <div class="row text-center">
                <button type="submit" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 btn btn-info" style="padding: 10px;color : white; border-radius: 0" name="btn_ulangan">
                  <i class="fa fa-star" style="font-size: 26pt"></i><br>
                  <h4>Ulangan</h4>
                </button>
                <button type="submit" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 btn btn-danger" style="padding: 10px;color : white; border-radius: 0;" name="btn_perbaikan">
                  <i class="fa fa-puzzle-piece" style="font-size: 26pt"></i><br>
                  <h4>Perbaikan</h4>
                </button>
                <button type="submit" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 btn btn-success" style="padding: 10px;color : white; border-radius: 0;" name="btn_latihan">
                  <i class="fa fa-pencil" style="font-size: 26pt"></i><br>
                  <h4>Latihan</h4>
                </button>
              </div>
            </div>
        </form>
        <form method="post">
            <div class="card-body">
              <div class="form-group">
                <label class="form-control-label" style="font-size: 14pt">Pilih Jenis <?= @$quiz ?></label>
                <select name="jenis" class="form-control" required>
                  <option value="" disabled selected>Pilih Salah Satu</option>
                  <?php $query = mysqli_query($con, "SELECT * FROM tb_quiz WHERE jenis = '$quiz' AND status = 'aktif'");
                  $cek = mysqli_num_rows($query);
                  if ($cek == 0) { ?>
                  <option value="" disabled>Tidak Ada Quiz</option>
                  <?php }else{
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <option value="<?= $row['pkt_soal'] ?>"><?= $row['nama_quiz'] ?></option>
                    <?php   }
                  } ?>
                </select>
              </div>
              <div class="text-right">
                <?php if ($quiz == "Ulangan") { ?>
                <button type="submit" class="btn btn-info" name="btnUlangan">Mulai Ulangan</button>
                <?php }elseif ($quiz == "Perbaikan") { ?>
                <button type="submit" class="btn btn-danger" name="btnPerbaikan">Mulai Perbaikan</button>
                <?php }elseif ($quiz == "Latihan") { ?>
                <button type="submit" class="btn btn-success" name="btnLatihan">Mulai Latihan</button>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<?php

if (isset($_POST['btnUlangan'])) {
  $_SESSION['pkt_soal'] = $_POST['jenis'];
  $_SESSION['jenis_quiz'] = "Ulangan";

    $cek_rekom = $oop->selectWhere($con, "tb_siswa", "username = '$_SESSION[username]'");
    if ($cek_rekom['rekomendasi'] == "ya") {
      $cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_hasil WHERE jenis_quiz = 'Ulangan' AND pkt_soal = '$_POST[jenis]'"));
      if ($cek > 0) {
        echo "<script>alert('Anda Sudah Melakukan Ulangan');document.location.href='?menu=quiz'</script>";
      }else{
        echo "<script>document.location.href='?menu=verifikasi'</script>";
      }
    }else{
      echo "<script>alert('Anda Tidak Di Rekomendasi');document.location.href='?menu=quiz'</script>";
    }
}

if (isset($_POST['btnPerbaikan'])) {
  $_SESSION['pkt_soal'] = $_POST['jenis'];
  $_SESSION['jenis_quiz'] = "Perbaikan";

  echo "<script>document.location.href='?menu=verifikasi'</script>";
}

if (isset($_POST['btnLatihan'])) {
  $_SESSION['pkt_soal'] = $_POST['jenis'];
  $_SESSION['jenis_quiz'] = "Latihan";

  echo "<script>document.location.href='?menu=verifikasi'</script>";
}
 ?>