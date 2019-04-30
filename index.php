<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - CERDAS.NET</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="css/fontastic.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
  <!-- Favicon-->

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<?php
  include 'config/koneksi.php';
  include 'library/controllers.php';
  @$user  = $_POST['username'];
  @$pass  = base64_encode($_POST['password']);

  $oop = new oop();
?>

<body>
  <div class="page login-page">
    <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
        <?php 
           switch (@$_GET['menu']) {
             case 'login_guru':
              include 'login_guru.php';
              break;

             case 'login_admin':
              include 'login_admin.php'; 
              break;

             default:
              include 'login_siswa.php';
              break;
           }
        ?>
    </div>
   </div>
 </div>

<!-- JavaScript files-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.validate.js"></script>
<!-- Main File-->
<script src="js/front.js"></script>
<script src="js/particles/particles.js"></script>

</body>
</html>