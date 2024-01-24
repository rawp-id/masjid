<?php
require 'functions.php';

ob_start();
session_start();
if (empty($_SESSION['user']) or empty($_SESSION['pass'])) {
    header("location:login.php");
}

if ((time() - $_SESSION['waktu']) > 1800) {
    header("location:logout.php");
}
$_SESSION['waktu'] = time();

$sukses = "";
$error = "";
$id = "";
$nama = "";
$email = "";
$user = "";
$verifikasi = "";

// if ($op == 'edit') {
//     $id         = $_GET['id'];
//     $sql1       = "select * from mahasiswa where id = '$id'";
//     $q1         = mysqli_query($koneksi, $sql1);
//     $r1         = mysqli_fetch_array($q1);
//     $nim        = $r1['nim'];
//     $nama       = $r1['nama'];
//     $alamat     = $r1['alamat'];
//     $fakultas   = $r1['fakultas'];

//     if ($nim == '') {
//         $error = "Data tidak ditemukan";
//     }
// }

// if (isset($_POST['submit'])) {
//     $username = $_POST['user'];
//     $pass = md5($_POST['pass']);
//     $log = "SELECT * FROM `login` WHERE user = '$username' AND pass = '$pass'";
//     $login = mysqli_query($koneksi, $log);
//     $jumlah = mysqli_num_rows($login);
//     $x = mysqli_fetch_array($login);

//     if ($jumlah > 0) {
//         $_SESSION['nama'];
//         $sukses = "Silakan Verifikasi Akun Anda";
//     } else {
//         $error = "Anda Gagal Login";
//     }
// }

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $data = mysqli_query($koneksi, "select * from login where user like '%" . $user . "%' and pass like '%" . $pass . "%'");
    $jumlah = mysqli_num_rows($data);
    if ($jumlah>0) {
        $sukses = "Anda Berhasil Login";
    } else {
        $error = "Anda Gagal Login";
    }
}
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $verifikasi = $_POST['verifikasi'];
    if($id && $nama && $email && $user && $verifikasi){
        $update = mysqli_query($koneksi, "update login set `nama`='$nama', `email`='$email', `user`='$user', `verifikasi`='$verifikasi' WHERE `id`='$id'");
        $berhasil = "ok";
    }else{
        $gagal = "gagal";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MASJID DARUL MUTTAQIN</title>
    <link rel="icon" type="image/x-icon" href="img/mosque.ico">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <?php
            if ($_SESSION['level'] == "admin") {
            ?>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Data zakat
                </div>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="zakat.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Zakat</span></a>
                </li>

                <!-- Nav Item - keuangan masuk -->
                <li class="nav-item active">
                    <a class="nav-link" href="input_zakat.php">
                        <i class="bi bi-plus-circle"></i>
                        <span>Input Zakat</span></a>
                </li>

                <!-- Nav Item - data keuangan -->
                <li class="nav-item">
                    <a class="nav-link" href="tabel_zakat.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Data Zakat</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Akun
                </div>

                <!-- Nav Item - data keuangan -->
                <li class="nav-item">
                    <a class="nav-link" href="akun.php">
                        <i class="bi bi-person"></i>
                        <span>Akun</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            <?php
            }
            ?>
            <?php
            if ($_SESSION['level'] == "zakat") {
            ?>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-icon">
                        <img src="img/zakat.png" alt="zakat" style="width: 40px;">
                    </div>
                    <div class="sidebar-brand-text mx-3">AMIL ZAKAT</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="amil_dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Data zakat
                </div>

                <!-- Nav Item - keuangan masuk -->
                <li class="nav-item active">
                    <a class="nav-link" href="input_zakat.php">
                        <i class="bi bi-plus-circle"></i>
                        <span>Input Zakat</span></a>
                </li>

                <!-- Nav Item - data keuangan -->
                <li class="nav-item">
                    <a class="nav-link" href="amil_tabel_zakat.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Data Zakat</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

            <?php
            }
            ?>
            <?php
            if ($_SESSION['level'] == "reg") {
            ?>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-icon">
                        <i class="bi bi-code-square"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">REGISTRASI</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - keuangan masuk -->
                <li class="nav-item">
                    <a class="nav-link" href="registrasi.php">
                        <i class="bi bi-plus-circle"></i>
                        <span>REGISTRASI</span></a>
                </li>

                <!-- Nav Item - data keuangan -->
                <li class="nav-item active">
                    <a class="nav-link" href="verifikasi.php">
                        <i class="bi bi-file-earmark-check"></i>
                        <span>VERIFIKASI</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

            <?php
            }
            ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: gray;"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama'] ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/default-avatar.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?php echo $_SESSION['nama'] ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">VERIFIKASI</h1>
                    </div>

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4"> </div>
                                <div class="col-md-4">
                                    <h3 style="text-align: center; margin-bottom: 30px;">LOGIN</h3>

                                    <?php
                                    if ($error) {
                                    ?>
                                        <div class="alert alert-danger" role="alert" style="text-align: center;">
                                            Maaf <br />
                                            <?php echo $error ?>
                                        </div>
                                    <?php
                                        header("refresh:3;url= verifikasi.php");
                                    }
                                    ?>

                                    <?php
                                    if ($sukses) {
                                    ?>
                                        <div class="alert alert-success mt-3 text-center" role="alert">
                                            Selamat <br />
                                            <?php echo $sukses; ?><br>
                                            Silahkan Verifikasi Akun Anda <br>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <div class="input-group flex-nowrap" style="margin-bottom: 30px;">
                                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                                                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" name="user">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group flex-nowrap mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key-fill"></i></span>
                                                <input type="password" class="form-control" placeholder="Password" name="pass">
                                            </div>
                                        </div>
                                        <center><button type="submit" class="btn btn-primary mt-3" name="submit" id="submit">Submit</button></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($sukses) {
                    ?>
                        <!-- Basic Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4"> </div>
                                    <div class="col-md-4">
                                        <h3 style="text-align: center; margin-bottom: 30px;">VERIFIKASI</h3>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                            <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>"></input>
                                                <div class="form-group">
                                                    <label for="username">Full Name</label>
                                                    <div class="input-group flex-nowrap mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-pen-fill"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter Name" aria-label="Username" aria-describedby="addon-wrapping" name="nama" value="<?php echo $row['nama'] ?>" style="text-transform: capitalize;" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <div class="input-group flex-nowrap mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter Username" aria-label="Username" aria-describedby="addon-wrapping" name="user" value="<?php echo $row['user'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <div class="input-group flex-nowrap mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at-fill"></i></span>
                                                        <input type="text" class="form-control" placeholder="Enter Email" aria-label="email" aria-describedby="addon-wrapping" name="email" value="<?php echo $row['email'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="verifikasi" name="verifikasi" value="1"></input>
                                                <center>
                                                    <p>Pastikan Data Anda Benar</p>
                                                    <button type="update" class="btn btn-primary" name="update" id="update">verifikasi</button>
                                                </center>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RAWP 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "logout" untuk keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>