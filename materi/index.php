<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Siswa - CERDAS.NET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.blue.css" id="theme-stylesheet">
    <style type="text/css" media="screen">
      .menu{
        margin-left: 20px;
        border-radius: none;
        padding: 2px 10px;
        font-size: 18pt;
      } 
      .menu:hover{
        background-color: white;
        color: #2f333e;
      }
    </style>
    <!-- Favicon-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

<?php 
  session_start();
  if (@$_SESSION['level'] == "siswa") {
    echo "<script>document.location.href='../'</script>";
  }

  if (@$_GET['kelas'] == "X") {
    $x = "background-color: white;color: #2f333e;";
  }elseif (@$_GET['kelas'] == "XI") {
    $xi = "background-color: white;color: #2f333e;";    
  }elseif (@$_GET['kelas'] == "XII") {
    $xii = "background-color: white;color: #2f333e;";    
  }
 ?>

  <body style="background-color: #eef5f9">
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" method="post" role="search">
              <input type="search" placeholder="Cari yang kau inginkan..." class="form-control" name="s" autofocus>
              <?php
                if (isset($_POST['s'])) {
                    $s = $_POST['s'];
                    if (isset($_GET['filter'])) {
                      $kelas = $_GET['kelas'];
                      echo "<script>document.location.href='?filter&kelas=$kelas&cari&s=$s'</script>";
                    }else{
                      echo "<script>document.location.href='?cari&s=$s'</script>";
                    }
                }
              ?>
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.php" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Cerdas</span><strong>.NET</strong></div>
                  <div class="brand-text brand-small"><span>CA</span><strong>NET</strong></div></a>
                <!-- Toggle Button-->
              </div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <a href="?filter&kelas=X" class="menu" style="text-decoration: none;<?= $x ?>">X</a>
                <a href="?filter&kelas=XI" class="menu" style="text-decoration: none;<?= $xi ?>">XI</a>
                <a href="?filter&kelas=XII" class="menu" style="text-decoration: none;<?= $xii ?>">XII</a>
              </ul>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <?php if (@$_GET['id'] == "") {?>
                  <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search" style="font-size: 12pt" title="Cari"></i></a></li>
                <?php } ?>
                <!-- Logout    -->
                <li class="nav-item"><a href="../" class="nav-link logout"><i class="fa fa-sign-out tip-bottom" style="font-size: 15pt" title="Keluar"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
          <?php  
            if (isset($_GET['details'])) {
              echo '<div class="content-inner" style="width: 100%;background-color: #2C3E50">';
              include 'detail.php';
            }else{
              echo '<div class="content-inner" style="width: 100%;">';
              include 'materi.php';
            }
          ?>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- <script src="../js/popper.js"> </script> -->
    <script src="../js/jquery.validate.js"></script>
    <!-- Main File-->
    <script src="../js/front.js"></script>
    <!-- ckEditor -->
    <script src="../js/ckeditor2/ckeditor.js"></script>
    <script type="text/javascript">
      CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: './ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: './ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
      } );
    </script>
</html>