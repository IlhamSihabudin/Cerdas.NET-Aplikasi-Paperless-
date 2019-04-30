<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
@$where = "pkt_soal = '$_SESSION[pkt_soal]'";

$data = $oop->selectWhere($con, "tb_quiz", $where);
for ($k=1; $k <= $data['jumlah_soal'] ; $k++) { 
  if ($_SESSION['jawaban'][$k] == @$_SESSION['user_jawaban'][$k]) {
    $keterangan[$k] = "Benar";
  }else{
    $keterangan[$k] = "Salah";
  }

  switch (@$_SESSION['jawaban'][$k]) {
    case '1':
      $jawaban[$k] = "A";
      break;
    
    case '2':
      $jawaban[$k] = "B";
      break;

    case '3':
      $jawaban[$k] = "C";
      break;

    case '4':
      $jawaban[$k] = "D";
      break;

    case '5':
      $jawaban[$k] = "E";
      break;

    default:
      $jawaban[$k] = "-";
      break;
  }

  switch (@$_SESSION['user_jawaban'][$k]) {
    case '1':
      $user_jawaban[$k] = "A";
      break;
    
    case '2':
      $user_jawaban[$k] = "B";
      break;

    case '3':
      $user_jawaban[$k] = "C";
      break;

    case '4':
      $user_jawaban[$k] = "D";
      break;

    case '5':
      $user_jawaban[$k] = "E";
      break;

    default:
      $user_jawaban[$k] = "-";
      break;
  }
}
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center align-items-center">
            <h3 class="h1">Analisis Soal</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center">
                  <thead> 
                    <tr>
                      <th width="100px">No</th>
                      <th>Soal</th>
                      <th width="150px">Kunci Jawaban</th>
                      <th width="150px">Jawaban</th>
                      <th width="200px">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=1; $i <= $data['jumlah_soal'] ; $i++) { ?>
                    <tr>
                      <td><h1 style="font-size: 40pt"><?= $i ?></h1></td>
                      <td class="text-left">
                        <p style="font-size: 13pt"><?= $_SESSION['soal'][$i] ?></p>
                        <?php if ($_SESSION['gambar'][$i] != "") { ?>
                          <img src="../foto/<?= $_SESSION['gambar'][$i] ?>" width="600px">
                          <br>
                        <?php } ?>
                        A. <?= $_SESSION['opsi_a'][$i] ?>
                        <br>
                        B. <?= $_SESSION['opsi_b'][$i] ?>
                        <br>
                        C. <?= $_SESSION['opsi_c'][$i] ?>
                        <br>
                        D. <?= $_SESSION['opsi_d'][$i] ?>
                        <br>
                        E. <?= $_SESSION['opsi_e'][$i] ?>
                      </td>
                      <td><h1 style="font-size: 50pt"><?= @$jawaban[$i] ?></h1></td>
                      <td><h1 style="font-size: 50pt"><?= @$user_jawaban[$i] ?></h1></td>
                      <td><h1 style="font-size: 40pt"><?= @$keterangan[$i] ?></h1></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>