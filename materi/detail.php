<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_materi";
@$where = "kd_materi = '$_GET[id]'";

$data = $oop->selectWhere($con, $table, $where);
?>
<header class="header">
        <nav class="navbar" style="background-color: transparent;height: 50px;">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand -->
                <?php if (isset($_GET['filter'])) {?>
                	<a href="?filter&kelas=<?= $_GET['kelas'] ?>" class="navbar-brand"><i class="fa fa-arrow-left"></i></a>
                <?php }else{ ?>
                	<a href="index.php" class="navbar-brand"><i class="fa fa-arrow-left"></i></a>
                <?php } ?>
                <!-- Toggle Button-->
              </div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
								<li><?= $data['jdl_materi'] ?></li>
              </ul>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              </ul>
            </div>
          </div>
        </nav>
      </header>
<section class="forms" > 
  <div class="container-fluid">
    <div class="row">
    	<div class="col-lg-10" style="background-color: white;margin: auto;min-height: 200px;padding: 30px;">
    		<h1 class="text-center" style="font-size: 20pt"><?= $data['jdl_materi'] ?></h1>
    		<p><?= $data['materi'] ?></p>
    	</div>
    </div>
	</div>
</section>