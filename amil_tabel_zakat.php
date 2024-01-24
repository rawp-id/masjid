<?php
require 'functions.php';

session_start();
if (empty($_SESSION['user']) or empty($_SESSION['pass'])) {
    header("location:login.php");
}

if ((time() - $_SESSION['waktu']) > 1800) {
    header("location:logout.php");
}
$_SESSION['waktu'] = time();


if (isset($_POST['submit'])) {
    $ID = $_POST['id'];
    $STAT = $_POST['status'];
    $ubah = mysqli_query($koneksi, "UPDATE zakat  SET `status`='$STAT' WHERE `id`='$ID'");
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

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <li class="nav-item">
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
                <li class="nav-item">
                    <a class="nav-link" href="input_zakat.php">
                        <i class="bi bi-plus-circle"></i>
                        <span>Input Zakat</span></a>
                </li>

                <!-- Nav Item - data keuangan -->
                <li class="nav-item active">
                    <a class="nav-link" href="amil_tabel_zakat.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Data Zakat</span></a>
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

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

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
                        <h1 class="h3 mb-0 text-gray-800">Data Zakat</h1>
                        <a href="input_zakat.php" class="btn btn-success">
                            <i class="bi bi-file-plus"></i> Tambah Data
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col" colspan="2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider text-center">
                                        <?php
                                        $sql2   = "select * from zakat";
                                        $q2     = mysqli_query($koneksi, $sql2);
                                        $i   = 1;
                                        while ($row = mysqli_fetch_array($q2)) {
                                            $id = $row['id'];
                                            $tanggal = $row['tanggal'];
                                            $nama = $row['nama'];
                                            $alamat = $row['alamat'];
                                            $jumlah = $row['jumlah'];
                                            $keterangan = $row['keterangan'];
                                            $status = $row['status'];

                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td scope="row"><?php echo $tanggal ?></td>
                                                <td scope="row" style="text-transform: capitalize;"><?php echo $nama ?></td>
                                                <td scope="row" style="text-transform: uppercase;"><?php echo $alamat ?></td>
                                                <td scope="row" class="text-center"><?php echo $jumlah ?></td>
                                                <td scope="row" style="text-transform: capitalize;"><?php echo $keterangan ?></td>
                                                <td scope="row">
                                                    <?php
                                                    if ($status == "belum" || $status == "0" || $status == "") {
                                                    ?>
                                                        <p style="color: red;"><?php echo $status ?></p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p><?php echo $status ?></p>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td scope="row">
                                                    <?php
                                                    if ($status == "belum" || $status == "0" || $status == "") {
                                                    ?>
                                                        <button type=" button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editmodal<?= $id ?>"><i class="bi bi-check-circle"></i></button>
                                                    <?php } else { ?>
                                                        <button type=" button" class="btn btn-danger" disabled><i class="bi bi-x-circle"></i></button>
                                                    <?php } ?>
                                                </td>

                                                <!-- edit Modal -->
                                                <div class="modal fade" id="editmodal<?= $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <h4>ANDA YAKIN UNTUK VALIDASI DATA?</h4>
                                                                <H5>CEK DATA DENGAN SEKSAMA!</H5>
                                                                <h3 style="color: red;"><?php echo $nama ?></h3>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" id="id" name="id" value="<?php echo $id ?>"></input>
                                                                    <input type="hidden" id="status" name="status" value="sah"></input>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                <button class="btn btn-success" type="submit" name="submit">OK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
                <div class="modal-body">SKlik "logout" untuk keluar</div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>