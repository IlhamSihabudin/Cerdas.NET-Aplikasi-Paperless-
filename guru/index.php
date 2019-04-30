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
   if ($_SESSION['level'] != "guru") {
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
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Navidation Menus-->
            <ul>
              <li><a href="?menu=home"><i class="icon-home"></i>Home</a></li>
            </ul>
          <ul class="list-unstyled">
            <li><a href="#inputan" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-plus-square-o"></i> Input</a>
              <ul id="inputan" class="collapse list-unstyled">
                <li><a href="?menu=input_materi"> <i class="fa fa-angle-double-right"></i>Input Materi</a></li>
                <li><a href="?menu=input_soal"> <i class="fa fa-angle-double-right"></i>Input Soal</a></li>
              </ul>
            </li>
            <li><a href="#quiz" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-puzzle-piece"></i> Quiz/Ulangan</a>
              <ul id="quiz" class="collapse list-unstyled">
                <li><a href="?menu=buat_quiz"> <i class="fa fa-plus-square-o"></i>Buat Quiz/Ulangan</a></li>
                <li><a href="?menu=list_quiz"> <i class="fa fa-book"></i>List Quiz/Ulangan</a></li>
              </ul>
            </li>
            
            <li><a href="?menu=rekom_siswa"> <i class="fa fa-check-square-o"></i>Rekomendasi Siswa</a></li>
            <li><a href="?menu=nilai_siswa"> <i class="fa fa-book"></i>Lihat Nilai Siswa</a></li>
            <li><a href="?menu=buat_report"> <i class="fa fa-mail-reply-all"></i>Buat Report</a></li>
            </li>
          </ul>
          
        </nav>
        <div class="content-inner">
          <?php 
             switch (@$_GET['menu']) {
               case 'change_profile':
                 include 'change_profile.php';
                 break;

              case 'change_password':
                include 'change_pass.php';
                break;

              case 'input_materi':
                include 'input_materi.php';
                break;

              case 'input_soal':
                include 'input_soal.php';
                break;

              case 'buat_quiz':
                include 'buat_quiz.php';
                break;

              case 'list_quiz':
                include 'list_quiz.php';
                break;

              case 'rekom_siswa':
                include 'rekom_siswa.php';
                break;

              case 'nilai_siswa':
                include 'nilai_siswa.php';
                break;

              case 'detail_nilai':
                include 'detail_nilai.php';
                break;

              case 'buat_report':
                include 'buat_report.php';
                break;

               default:
                 include 'profile.php';
                 break;
            }
           ?>  
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../js/jquery.js"></script>
    <!-- bootStrap -->
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
    <!-- dataTables -->
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
    </script><script type="text/javascript">
      $(document).ready(function() {
        $('#soal').DataTable({
          "order": [[ 3, "desc" ]]
        });
      } );     
    </script>
</html>