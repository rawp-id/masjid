<?php
require 'functions.php';

$error = "";
$sukses = "";
$sukses_reg = "";
$maaf = "Maaf <br/>";
$welcome = "Welcome <br/>";

if (isset($_POST['submit'])) {
  $username = $_POST['user'];
  $pass = md5($_POST['pass']);
  $log = "SELECT * FROM `login` WHERE user = '$username' AND pass = '$pass'";
  $login = mysqli_query($koneksi, $log);
  $jumlah = mysqli_num_rows($login);
  $x = mysqli_fetch_array($login);

  if ($jumlah > 0) {
    if ($x['level'] == "admin" && $x['status'] == "1") {
      session_start();
      $_SESSION['user'] = $x['user'];
      $_SESSION['pass'] = $x['pass'];
      $_SESSION['nama'] = $x['nama'];
      $_SESSION['level'] = $x['level'];
      $_SESSION['waktu'] = time();
      $sukses     = "Anda Berhasil Login";
    } elseif ($x['level'] == "zakat" && $x['status'] == "1") {
      session_start();
      $_SESSION['user'] = $x['user'];
      $_SESSION['pass'] = $x['pass'];
      $_SESSION['nama'] = $x['nama'];
      $_SESSION['level'] = $x['level'];
      $_SESSION['waktu'] = time();
      $sukses     = "Anda Berhasil Login";
    } elseif ($x['level'] == "reg" && $x['status'] == "1") {
      session_start();
      $_SESSION['user'] = $x['user'];
      $_SESSION['pass'] = $x['pass'];
      $_SESSION['nama'] = $x['nama'];
      $_SESSION['level'] = $x['level'];
      $_SESSION['waktu'] = time();
      $sukses_reg     = "Anda Berhasil Login";
    } elseif ($x['level'] == "zakat" && $x['status'] == "0") {
      $error = "akun anda belum diverifikasi";
    }
  } else {
    $error = "Anda Gagal Login";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>MASJID DARUL MUTTAQIN</title>
  <link rel="icon" type="image/x-icon" href="img/mosque.ico">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="index.html" rel="tooltip" data-placement="bottom" style="font-size: 20px;">
          Masjid Darul Muttaqin
        </a>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header clear-filter" filter-color="">
    <div class="page-header-image" style="background-image:url(assets/img/masjid1.JPG)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="POST" action="">
              <div class="card-header text-center">
                <div>
                  <h4>LOGIN</h4>
                </div>
              </div>
              <div class="card-body">
                <?php
                if ($error) {
                ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <?php echo $maaf ?>
                    <?php echo $error ?>
                  </div>
                <?php
                  header("refresh:0.5;url=login.php");
                }
                ?>

                <?php
                if ($sukses_reg) {
                ?>
                  <div class="alert alert-success mt-3 text-center" role="alert">
                    <?php
                    echo $welcome;
                    echo $sukses_reg; ?>
                  </div>
                  <div class="d-flex justify-content-center mb-3">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden"></span>
                    </div>
                  </div>
                <?php
                  header("refresh:1;url=registrasi.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                  <div class="alert alert-success mt-3 text-center" role="alert">
                    <?php
                    echo $welcome;
                    echo $sukses; ?>
                  </div>
                  <div class="d-flex justify-content-center mb-3">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden"></span>
                    </div>
                  </div>
                <?php
                  header("refresh:1;url=zakat.php");
                }
                ?>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" name="user" id="user">
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="bi bi-key"></i>
                    </span>
                  </div>
                  <input type="password" placeholder="Password" class="form-control" name="pass" id="pass">
                </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" id="submit" name="submit" class="btn btn-dark btn-round btn-lg btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class=" container ">
      <div class="copyright" id="copyright">
        &copy;
        <script>
          document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
        </script> by
        <a href="" target="_blank">RAWP</a>.
      </div>
    </div>
  </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
</body>

</html>