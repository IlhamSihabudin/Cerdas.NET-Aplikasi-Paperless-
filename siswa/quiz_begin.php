<?php
error_reporting(0);
include '../config/koneksi.php';
include '../library/controllers.php';

if (@$_SESSION['quiz'] != "begin") {
  echo "<script>document.location.href='?menu=quiz'</script>";
}

$oop = new oop();
$where = "pkt_soal = '$_SESSION[pkt_soal]'";

$jumlah = $oop->selectCount($con, "tb_soal", $where);
$data = $oop->selectWhere($con, "tb_quiz", $where);

if (@$_SESSION['no'] > 0) {
  if ($_SESSION['no'] < $data['jumlah_soal']) {
    $_SESSION['no'] = $_SESSION['no'];
  }
}else{
  $_SESSION['no'] = 1;
  $i = 1;
  $sql = mysqli_query($con, "SELECT * FROM tb_soal WHERE $where ORDER BY RAND()");
  while ($row = mysqli_fetch_array($sql)) { 
    $_SESSION['soal'][$i] = $row['soal'];
    $_SESSION['gambar'][$i] = $row['gambar'];
    $opsi = array();
    $ceknomor = array();
    for ($j=1; $j <= 5 ; $j++) {
      $nomor = rand(1,5);
      while(in_array($nomor,$ceknomor)){
        $nomor = rand(1,5);
      }
      $ceknomor[$j] = $nomor;
      $opsi[$j] = $nomor;
    }

    $_SESSION['opsi_a'][$i] = $row['opsi_' . $opsi[1]];
    $_SESSION['opsi_b'][$i] = $row['opsi_' . $opsi[2]];
    $_SESSION['opsi_c'][$i] = $row['opsi_' . $opsi[3]];
    $_SESSION['opsi_d'][$i] = $row['opsi_' . $opsi[4]];
    $_SESSION['opsi_e'][$i] = $row['opsi_' . $opsi[5]];

    if ($_SESSION['opsi_a'][$i] == $row['jawaban']) {
      $_SESSION['jawaban'][$i] = 1;
    }elseif ($_SESSION['opsi_b'][$i] == $row['jawaban']) {
      $_SESSION['jawaban'][$i] = 2;
    }elseif ($_SESSION['opsi_c'][$i] == $row['jawaban']) {
      $_SESSION['jawaban'][$i] = 3;
    }elseif ($_SESSION['opsi_d'][$i] == $row['jawaban']) {
      $_SESSION['jawaban'][$i] = 4;
    }elseif ($_SESSION['opsi_e'][$i] == $row['jawaban']) {
      $_SESSION['jawaban'][$i] = 5;
    }
    $i++;
  }
}

@$cek_soal = $_SESSION['user_jawaban'][$_SESSION['no']];

if (@$cek_soal == "1") {
  $a = "checked";
  $b = "";
  $c = ""; 
  $d = ""; 
  $e = ""; 
}elseif (@$cek_soal == "2") {
  $a = "";
  $b = "checked";
  $c = ""; 
  $d = ""; 
  $e = "";
}elseif (@$cek_soal == "3") {
  $a = "";
  $b = "";
  $c = "checked"; 
  $d = ""; 
  $e = "";
}elseif (@$cek_soal == "4") {
  $a = "";
  $b = "";
  $c = ""; 
  $d = "checked"; 
  $e = "";
}elseif (@$cek_soal == "5") {
  $a = "";
  $b = "";
  $c = ""; 
  $d = ""; 
  $e = "checked";
}else{
  $a = "";
  $b = "";
  $c = ""; 
  $d = ""; 
  $e = "";
}

//set session dulu dengan nama $_SESSION["mulai"]
if (isset($_SESSION["mulai"])) { 
        //jika session sudah ada
  $telah_berlalu = time() - $_SESSION["mulai"];
} else { 
        //jika session belum ada
  $_SESSION["mulai"]  = time();
  $telah_berlalu      = 0;
}

$sql    = mysqli_query($con, "select * from tb_quiz Where pkt_soal = '$_SESSION[pkt_soal]'");   
$data   = mysqli_fetch_array($sql);

$temp_waktu = ($data['lama_waktu']*60) - $telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
$temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
$temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik

if ($temp_menit < 60) { 
  /* Apabila $temp_menit yang kurang dari 60 meni */
  $jam    = 0; 
  $menit  = $temp_menit; 
  $detik  = $temp_detik; 
} else { 
  /* Apabila $temp_menit lebih dari 60 menit */           
  $jam    = (int)($temp_menit/60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer 
  $menit  = $temp_menit%60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
  $detik  = $temp_detik;
}
?>
<script src="../js/jquery.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /** Membuat Waktu Mulai Hitung Mundur Dengan 
          * var detik;
          * var menit;
          * var jam;
          */
          var detik   = <?= $detik; ?>;
          var menit   = <?= $menit; ?>;
          var jam   = <?= $jam; ?>;

        /**
           * Membuat function hitung() sebagai Penghitungan Waktu
           */
           function hitung() {
          /** setTimout(hitung, 1000) digunakan untuk 
             * mengulang atau merefresh halaman selama 1000 (1 detik) 
             */
             setTimeout(hitung,1000);

             /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
             if(menit < 5 && jam == 0){
              var peringatan = 'text-danger';
            };

            /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
            $('#timer').html(
              '<label class="form-control-label '+peringatan+'"><h2>Sisa Waktu</h2></label><div class="form-control text-center '+peringatan+'"><h2> '+jam+' : '+menit+' : '+detik+' </h2></div>'
              );

            /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
            detik --;

          /** Jika var detik < 0
            * var detik akan dikembalikan ke 59
            * Menit akan Berkurang 1
            */
            if(detik < 0) {
              detik = 59;
              menit --;

             /** Jika menit < 0
              * Maka menit akan dikembali ke 59
              * Jam akan Berkurang 1
              */
              if(menit < 0) {
                menit = 59;
                jam --;

              /** Jika var jam < 0
                * clearInterval() Memberhentikan Interval dan submit secara otomatis
                */
                
                if(jam < 0) { 
                  clearInterval(hitung); 
                  /** Variable yang digunakan untuk submit secara otomatis di Form */ 
                  alert('Waktu Anda telah habis !!');
                  document.location.href='?menu=hasil';
                } 
              } 
            } 
          }           
          /** Menjalankan Function Hitung Waktu Mundur */ 
          hitung();
        });
</script>


<form method="POST" enctype="multipart/form-data" method='POST'>
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="card">
          <div class="card-body">
              <div class="form-group" id="timer"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary col-lg-12" name="selesai" onclick="return confirm('Apakah Anda Yakin Akan Menyelesaikannya?')"> Selesai</button>
              </div>
         </div>
       </div>
      </div>

      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <div class="card">
          <div class="card-header d-flex align-items-center text-secondary">
            <h3 class="h2">Nomor Soal</h3>
          </div>
          <div class="card-body">
            <?php 
              for ($z=1; $z <= $data['jumlah_soal'] ; $z++) { 
                if ($_SESSION['user_jawaban'][$z] == "") { ?>
                  <button type="submit" class="btn btn-danger" name="btn_no1<?= $z ?>" style="margin: 5px; width: 50px"><?= @$z ?></button>
            <?php }else{ ?>
                  <button type="submit" class="btn btn-success" name="btn_no2<?= $z ?>" style="margin: 5px; width: 50px"><?= @$z ?></button>
            <?php }  

              if (isset($_POST['btn_no1'.$z]) OR isset($_REQUEST['btn_no2'.$z])) {
                $jawaban_user = $_POST['opsi'];
                $_SESSION['user_jawaban'][$_SESSION['no']] = $jawaban_user;

                $_SESSION['no'] = $z;
                $cek = $_SESSION['user_jawaban'][$_SESSION['no']];
                echo "<script>document.location.href='?menu=quiz_begin&jawab=$cek'</script>";
              }
            }
             ?>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4"><?= $data['nama_quiz'] ?></h3>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="text-left col-lg-6">
                <?php if ($_SESSION['no'] <= 1) { ?>
                  <button type="submit" class="btn btn-success col-lg-4" disabled style="margin: 5px;"><i class="fa fa-angle-double-left"></i> Previous</button>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-success col-lg-4" name="sebelum1" style="margin: 5px;"><i class="fa fa-angle-double-left"></i> Previous</button>
                <?php } ?>
              </div>
              <div class="text-right col-lg-6">
              <?php if ($_SESSION['no'] >= $data['jumlah_soal']) { ?>
                <button type="submit" class="btn btn-success col-lg-4" disabled style="margin: 5px;">Next <i class="fa fa-angle-double-right"></i></button>
              <?php } else {  ?>
                <button type="submit" class="btn btn-success col-lg-4" name="sesudah1" style="margin: 5px;">Next <i class="fa fa-angle-double-right"></i></button>
              <?php } ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row"> 
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><?= $_SESSION['no']."." ?></div>
              <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"> 
                <div class="form-group"><?= $_SESSION['soal'][$_SESSION['no']] ?></div>
                <div class="form-group">
                  <?php if ($_SESSION['gambar'][$_SESSION['no']] != "") { ?>
                  <img src="../foto/<?= $_SESSION['gambar'][$_SESSION['no']] ?>" width="80%">
                  <?php } ?>
                </div>

                <div class="form-group">
                  <input type="radio" id="opsi1" name="opsi" value="1" class="radio-template" <?= @$a ?>>
                  <label for="opsi1"><?= $_SESSION['opsi_a'][$_SESSION['no']] ?></label>
                </div>

                <div class="form-group">
                  <input type="radio" id="opsi2" name="opsi" value="2" class="radio-template" <?= @$b ?>>
                  <label for="opsi2"><?= $_SESSION['opsi_b'][$_SESSION['no']] ?></label>
                </div>

                <div class="form-group">
                  <input type="radio" id="opsi3" name="opsi" value="3" class="radio-template" <?= @$c ?>>
                  <label for="opsi3"><?= $_SESSION['opsi_c'][$_SESSION['no']] ?></label>
                </div>

                <div class="form-group">
                  <input type="radio" id="opsi4" name="opsi" value="4" class="radio-template" <?= @$d ?>>
                  <label for="opsi4"><?= $_SESSION['opsi_d'][$_SESSION['no']] ?></label>
                </div>

                <div class="form-group">
                  <input type="radio" id="opsi5" name="opsi" value="5" class="radio-template" <?= @$e ?>>
                  <label for="opsi5"><?= $_SESSION['opsi_e'][$_SESSION['no']] ?></label>
                </div>

                <?php
                    if (isset($_REQUEST['sesudah1']) OR isset($_REQUEST['sesudah2']) OR isset($_REQUEST['sebelum1']) OR isset($_REQUEST['sebelum2']) OR isset($_REQUEST['selesai'])) {
                      $jawaban_user = $_POST['opsi'];
                      $_SESSION['user_jawaban'][$_SESSION['no']] = $jawaban_user;
                    }
                 ?>
              </div> 
              </div>                 
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="text-left col-lg-6">
                <?php if ($_SESSION['no'] <= 1) { ?>
                  <button type="submit" class="btn btn-success col-lg-4" disabled style="margin: 5px;"><i class="fa fa-angle-double-left"></i> Previous</button>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-success col-lg-4" name="sebelum2" style="margin: 5px;"><i class="fa fa-angle-double-left"></i> Previous</button>
                <?php } ?>
              </div>
              <div class="text-right col-lg-6">
              <?php if ($_SESSION['no'] >= $data['jumlah_soal']) { ?>
                <button type="submit" class="btn btn-success col-lg-4" disabled style="margin: 5px;">Next <i class="fa fa-angle-double-right"></i></button>
              <?php } else {  ?>
                <button type="submit" class="btn btn-success col-lg-4" name="sesudah2" style="margin: 5px;">Next <i class="fa fa-angle-double-right"></i></button>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
</form>

<?php
// for ($x=1; $x <= $_SESSION['jumlah_soal'] ; $x++) { 

// }

if (isset($_POST['sesudah1']) OR isset($_POST['sesudah2'])) {
  if ($_SESSION['no'] < $data['jumlah_soal']) {
    $_SESSION['no'] = $_SESSION['no'] + 1;
    
    $cek = $_SESSION['user_jawaban'][$_SESSION['no']];
    echo "<script>document.location.href='?menu=quiz_begin&jawab=$cek'</script>";
  }
}
  
if (isset($_POST['sebelum1']) OR isset($_POST['sebelum2'])) {
  if ($_SESSION['no'] > 1) {
    $_SESSION['no'] = $_SESSION['no'] - 1;

    $cek = $_SESSION['user_jawaban'][$_SESSION['no']];
    echo "<script>document.location.href='?menu=quiz_begin&jawab=$cek'</script>";
  }
}

if (isset($_POST['selesai'])) {
  echo "<script>document.location.href='?menu=hasil'</script>";
}
 ?>