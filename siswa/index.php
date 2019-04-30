<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CERDAS.NET</title>
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
    <!-- Favicon-->

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

<?php 
session_start();
  if ($_SESSION['level'] != "siswa") {
    echo "<script>alert('Login Duhulu!!');document.location.href='../'</script>";
  }

  if (isset($_GET['keluar'])) {
    session_destroy();
    session_unset($_SESSION['level']);

    echo "<script>document.location.href='../'</script>";
  }
 ?>

  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <?php if (@$_GET['menu'] != "hasil") { ?>
        <nav class="navbar col-lg-12">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="?menu=home" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Cerdas</span><strong>.NET</strong></div>
                  <div class="brand-text brand-small"><span>CA</span><strong>NET</strong></div></a>
                  <!-- Toggle Button-->
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                  <!-- Navbar Menu -->
                  <li class="nav-item dropdown"><a rel="nofollow" href="?menu=home" class="nav-link"><i class="fa fa-home" style="font-size: 14pt"></i> <span class="d-none d-sm-inline-block">Home</span></a></li>
                  <li class="nav-item dropdown"><a rel="nofollow" href="?menu=quiz" class="nav-link"><i class="fa fa-pencil-square-o"></i> <span class="d-none d-sm-inline-block">Quiz</span></a></li>
                  <li class="nav-item dropdown"><a rel="nofollow" href="?menu=lihat_nilai" class="nav-link"><i class="fa fa-mortar-board"></i> <span class="d-none d-sm-inline-block">Lihat Nilai</span></a></li>
                  <!-- Logout -->
                  <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link languages"><i class="fa fa-user" style="font-size: 20pt"></i><span class="d-none d-sm-inline-block"></span></a>
                    <ul aria-labelledby="languages" class="dropdown-menu">
                      <li><a rel="nofollow" href="?menu=change_password" class="dropdown-item"><i class="fa fa-edit" style="font-size: 13pt;"></i> Change Password</a></li>
                      <li><a href="?keluar" rel="nofollow" href="#" class="dropdown-item"><i class="fa fa-sign-out" style="font-size: 13pt;"></i> Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        <?php } ?>
      </header>
        <div class="content-inner" style="width: 100%;">
          <?php
            switch (@$_GET['menu']) {
              case 'change_password':
                include 'change_pass.php';
                break;

              case 'quiz':
                include 'quiz.php';
                break;

              case 'verifikasi':
                include 'verifikasi.php';
                break;

              case 'quiz_begin':
                include 'quiz_begin.php';
                break;

              case 'hasil':
                include 'hasil.php';
                break;

              case 'analisis_soal':
                include 'analisis_soal.php';
                break;

              case 'lihat_nilai':
                include 'lihat_nilai.php';
                break;
              
              default:
                include 'profile.php';
                break;
            }
          ?>  
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- <script src="../js/popper.js"> </script> -->
    <script src="../js/jquery.validate.js"></script>
    <!-- Main File-->
    <script src="../js/front.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );     
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example1').DataTable();
      } );     
    </script><script type="text/javascript">
      $(document).ready(function() {
        $('#example2').DataTable();
      } );     
    </script>
</html>