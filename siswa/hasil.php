<?php
if (@$_SESSION['quiz'] != "begin") {
  echo "<script>document.location.href='?menu=quiz'</script>";
}

include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

$nilai = 0;
$oop = new oop();
$data = $oop->selectWhere($con, "tb_quiz", "pkt_soal = '$_SESSION[pkt_soal]'");
$jumlah = $data['jumlah_soal'];
for ($i=1; $i <= $jumlah ; $i++) {
  @$user_jawaban = $_SESSION['user_jawaban'][$i];
  @$jawaban = $_SESSION['jawaban'][$i]; 
  if ($user_jawaban == $jawaban) {
    $nilai = $nilai + 1; 
  }
}

$akhir = $nilai / $jumlah * 100;
$nilai_akhir = number_format($akhir);

if ($_SESSION['jenis_quiz'] == "Ulangan") {
  $cek = $oop->selectCount($con, "tb_hasil", "pkt_soal = '$_SESSION[pkt_soal]' AND nis = '$_SESSION[username]'");
  if ($cek == 0) {
    $isi = "nis = '$_SESSION[username]', jenis_quiz = '$_SESSION[jenis_quiz]', pkt_soal = '$_SESSION[pkt_soal]', hasil = '$nilai_akhir', tgl = '$tgl'";
    $sql = mysqli_query($con, "INSERT INTO tb_hasil SET $isi");
  }
}else{
  $isi = "nis = '$_SESSION[username]', jenis_quiz = '$_SESSION[jenis_quiz]', pkt_soal = '$_SESSION[pkt_soal]', hasil = '$nilai_akhir', tgl = '$tgl'";
  $sql = mysqli_query($con, "INSERT INTO tb_hasil SET $isi");
}



if (isset($_POST['back'])) {
  $link = "?menu=quiz";
    echo "<script>document.location.href='$link'</script>";
}

if (isset($_POST['analisis'])) {
  $link = "?menu=analisis_soal";
    echo "<script>document.location.href='$link'</script>";
}
?>

<form method="post">
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-4" style="margin: auto; margin-top: 2%">
        <div class="card text-center">
          <div class="card-body">
            <?php if ($nilai_akhir < 75) { ?>
              <div class="text-center text-danger"> 
                <div class="form-group">
                  <i class="fa fa-frown-o" style="font-size: 60pt"></i>
                </div>
                <div class="form-group">
                  <h1>Maaf</h1>
                </div>
                <div class="form-group">
                  <h1 style="font-size: 100pt"><?= $nilai_akhir ?></h1>
                </div>
                <div class="form-group">
                  <?php if ($_SESSION['jenis_quiz'] == "Ulangan") { ?>
                    <p class="text-secondary" style="font-size: 14pt">Maaf Anda Harus Remedial</p>
                  <?php }elseif ($_SESSION['jenis_quiz'] == "Perbaikan") { ?>
                    <p class="text-secondary" style="font-size: 14pt">Maaf Anda Harus Remedial Lagi</p>
                  <?php }elseif ($_SESSION['jenis_quiz'] == "Latihan") { ?>
                    <p class="text-secondary" style="font-size: 14pt">Jangan Menyerah Coba Lagi</p>
                  <?php } ?>
                </div>
              </div>
            <?php }else{ ?>
              <div class="text-center text-success"> 
                <div class="form-group">
                  <i class="fa fa-smile-o" style="font-size: 60pt"></i>
                </div>
                <div class="form-group">
                  <h1>Kerja Bagus</h1>
                </div>
                <div class="form-group">
                  <h1 style="font-size: 100pt"><?= $nilai_akhir ?></h1>
                </div>
                <div class="form-group">
                  <p class="text-secondary" style="font-size: 14pt">Selamat Nilai Anda Kompeten</p>
                </div>
              </div>
            <?php } ?>
          </div>
          <?php if ($_SESSION['jenis_quiz'] == "Latihan") { ?>
            <div class="form-group">
              <button type="submit" class="btn btn-warning" name="analisis"><i class="fa fa-magic" style="font-size: 16pt"></i> Analisis Soal</button>
            </div>
          <?php } ?>
          <div class="card-footer">
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="back"><i class="fa fa-home" style="font-size: 16pt"></i> Back To Home</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
