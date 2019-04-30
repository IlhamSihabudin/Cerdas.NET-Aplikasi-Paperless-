<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cerdas.NET</title>
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
  if ($_SESSION['level'] != "admin") {
    echo "<script>alert('Login Duhulu!!');document.location.href='../'</script>";
  }

  if (isset($_GET['keluar'])) {
    session_destroy();

    echo "<script>document.location.href='../'</script>";
  }
 ?>

  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="?menu=home" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Cerdas </span><strong>.NET</strong></div>
                  <div class="brand-text brand-small">CA<strong>NET</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item dropdown"><a id="profile" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-user" style="font-size: 20pt"></i><span class="d-none d-sm-inline-block"></span></a>
                  <ul aria-labelledby="profile" class="dropdown-menu">
                    <li><a rel="nofollow" href="?menu=change_pass" class="dropdown-item"><i class="fa fa-edit" style="font-size: 13pt;"></i> Change Profile</a></li>
                    <li><a href="?keluar" rel="nofollow" href="#" class="dropdown-item"><i class="fa fa-sign-out" style="font-size: 13pt;"></i> Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Navidation Menus-->
            <ul>
              <li><a href="?menu=home"> <i class="icon-home"></i>Home</a></li>
            <li><a href="#guru" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user"></i> Guru</a>
              <ul id="guru" class="collapse list-unstyled">
                <li><a href="?menu=input_guru"> <i class="fa fa-plus-square-o"></i>Input Guru</a></li>
                <li><a href="?menu=akun_guru"> <i class="fa fa-book"></i>Akun Guru</a></li>
                <li><a href="?menu=daftar_guru"> <i class="fa fa-reply-all"></i>Daftar Guru</a></li>
              </ul>
            </li>
            <li><a href="#siswa" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-users"></i> Siswa</a>
              <ul id="siswa" class="collapse list-unstyled">
                <li><a href="?menu=input_siswa"> <i class="fa fa-plus-square-o"></i>Input Siswa</a></li>
                <li><a href="?menu=akun_siswa"> <i class="fa fa-book"></i>Akun Siswa</a></li>
                <li><a href="?menu=daftar_siswa"> <i class="fa fa-reply-all"></i>Daftar Siswa</a></li>
              </ul>
            </li>
            <li><a href="#other" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-gears"></i> Other</a>
              <ul id="other" class="collapse list-unstyled">
                <li><a href="?menu=input_rombel"> <i class="fa fa-plus-square-o"></i>Input Rombel</a></li>
                <li><a href="?menu=input_rayon"> <i class="fa fa-plus-square-o"></i>Input Rayon</a></li>
              </ul>
            </li>
        </ul>
          
        </nav>
        <div class="content-inner">
          <?php 
              switch (@$_GET['menu']) {
                case 'input_guru':
                  include 'input_guru.php';
                  break;

                case 'akun_guru':
                  include 'akun_guru.php';
                  break;

                case 'input_siswa':
                  include 'input_siswa.php';
                  break;

                case 'akun_siswa':
                  include 'akun_siswa.php';
                  break;

                case 'input_rombel':
                  include 'input_rombel.php';
                  break;

                case 'input_rayon':
                  include 'input_rayon.php';
                  break;

                case 'daftar_guru':
                  include 'daftar_guru.php';
                  break;

                case 'daftar_siswa':
                  include 'daftar_siswa.php';
                  break;

                case 'change_pass':
                  include 'change_pass.php';
                  break;

                default:
                  include 'home_admin.php';
                  break;
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
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>

</html>