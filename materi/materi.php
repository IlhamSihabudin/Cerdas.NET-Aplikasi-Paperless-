<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_materi";
@$where = "kd_materi = '$_GET[id]'";

?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Cari -->
      <?php if(isset($_GET['cari'])) { ?>
          <?php 
                $s = $_GET['s'];
                if (isset($_GET['filter'])) {
                  $isi = "kelas='$_GET[kelas]' AND jdl_materi like '%$s%' OR upload_by like '%$s%' OR tgl_upload like '%$s%'";
                }else{
                  $isi = "jdl_materi like '%$s%' OR upload_by like '%$s%' OR kelas like '%$s%' OR tgl_upload like '%$s%'";
                }?>
                <div class="col-sm-12"><h4 class="text-center" style="font-weight: 1">Kata Kunci '<?= $s ?>'</h4></div>
          <?php 
                $sql = mysqli_query($con, "SELECT * FROM $table WHERE $isi");
                $cek = mysqli_num_rows($sql);
                  if ($cek == 0) { ?>
                    <div class="col-sm-12"><h1 class="text-center">Tidak Ada Materi</h1></div>
            <?php }else{
              while ($row = mysqli_fetch_array($sql)) { ?>
                  <div class="col-lg-3 col-md-4 col-sm-12">
                    <?php if (isset($_GET['filter'])) { ?>
                      <a href="?filter&kelas=<?= $_GET['kelas'] ?>&details&id=<?= $row['kd_materi'] ?>" style="text-decoration: none;padding: 0;" class="col-lg-12">
                    <?php }else{ ?>
                      <a href="?details&id=<?= $row['kd_materi'] ?>" style="text-decoration: none;padding: 0;" class="col-lg-12">
                    <?php } ?>
                        <img class="card-img-top" src="../img/file1.png">
                      <div class="card col-sm-12">
                        <div class="card-body">
                          <h3 class="card-text" style="color: black"><?= $row['jdl_materi'] ?></h3>
                          <p class="card-text" style="font-size: 11pt"><?= $row['upload_by'] ?></p>
                        </div>
                          <p class="card-text text-right align-items-end" style="padding-bottom: 5px;"><?= $row['tgl_upload'] ?></p>
                      </div>
                    </a>
                  </div>
                <?php }
              }
          ?>

      <!-- Filter Kelas -->
        <?php }elseif(isset($_GET['filter'])) {?>
          <?php 
            $sql = mysqli_query($con, "SELECT * FROM $table WHERE kelas='$_GET[kelas]'");
              $cek = mysqli_num_rows($sql);
                if ($cek == 0) { ?>
                  <div class="col-sm-12"><h1 class="text-center">Tidak Ada Materi</h1></div>
          <?php }else{
            while ($row = mysqli_fetch_array($sql)) { ?>
                <div class="col-lg-3 col-md-4 col-sm-12">
                  <a href="?filter&kelas=<?= $_GET['kelas'] ?>&details&id=<?= $row['kd_materi'] ?>" style="text-decoration: none;padding: 0;" class="col-lg-12">
                      <img class="card-img-top" src="../img/file1.png">
                    <div class="card col-sm-12">
                      <div class="card-body">
                        <h3 class="card-text" style="color: black"><?= $row['jdl_materi'] ?></h3>
                        <p class="card-text" style="font-size: 11pt"><?= $row['upload_by'] ?></p>
                      </div>
                        <p class="card-text text-right align-items-end" style="padding-bottom: 5px;"><?= $row['tgl_upload'] ?></p>
                    </div>
                  </a>
                </div>
              <?php }
            }
            ?>
          
        <!-- Awal -->
        <?php }else{ ?>
          <?php 
              $showAll = $oop->selectAll($con, $table);
              if ($showAll=="") {?>
                  <div class="col-sm-12"><h1 class="text-center">Tidak Ada Materi</h1></div>
              <?php }else{
                foreach ($showAll as $row) {?>
                  <div class="col-lg-3 col-md-4 col-sm-12">
                    <a href="?details&id=<?= $row['kd_materi'] ?>" style="text-decoration: none;padding: 0;" class="col-lg-12">
                        <img class="card-img-top" src="../img/file1.png">
                      <div class="card col-sm-12">
                        <div class="card-body">
                          <h3 class="card-text" style="color: black"><?= $row['jdl_materi'] ?></h3>
                          <p class="card-text" style="font-size: 11pt"><?= $row['upload_by'] ?></p>
                        </div>
                          <p class="card-text text-right align-items-end" style="padding-bottom: 5px;"><?= $row['tgl_upload'] ?></p>
                      </div>
                    </a>
                  </div>
             <?php }
            }
          ?>
        <?php } ?>
    </div>
  </div>
</section>