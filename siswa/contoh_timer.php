<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
// $where = "pkt_soal = '$_SESSION[pkt_soal]'";

// $data = $oop->selectWhere($con, "tb_quiz", $where);   
?>
</head>
<form method="post">
<body>        
  <?php
  $opsi = array();
  $ceknomor = array();
  for ($i=1; $i <= 5 ; $i++) {
    $nomor = rand(1,5);
    while(in_array($nomor,$ceknomor)){
      $nomor = rand(1,5);
    }
    $ceknomor[$i] = $nomor;
    $opsi[$i] = $nomor;
    $pilihan = "opsi_" . $opsi[$i];
    ?>
    <div class="form-gruop">
      <input type="radio" id="jawaban<?= $i ?>" name="opsi_3" value="<?= $i ?>" class="radio-template">
      <label for="jawaban<?= $i ?>"><?= "PIlihan ke- ". $opsi[$i] ?></label>
    </div>
    <?php } ?>

    <input type="submit" name="go" value="GO">
    <?php 
    if (isset($_POST['go'])) {
      echo $_POST['opsi_1'];
    }
     ?>
</body>
</form>
</html>