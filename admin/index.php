<?php
session_start();
include_once '../config/koneksi.php';

//cek jika belum login
if(!isset($_SESSION['login'])){
    //redirect ke halaman login
    header('Location: ../auth/login.php');
    exit();
}

//cek jika role user yang masuk
if(isset($_SESSION['user'])){
    //redirect ke halaman user
    /* hal ini akan mencegah bypass sesi*/
    header('Location: ../user/index.php');
    exit();
}

$dashboard = mysqli_query($db, "SELECT * FROM dashboard");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- CDN Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                <i class="bi bi-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Rekam Medis</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Dashboard
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == "index.php" ? "active" : "");?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading">
               Data
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Pasien-->
            <li class="nav-item">
                <a class="nav-link" href="pasien.php">
                <i class="bi bi-person-fill"></i>
                    <span>Pasien</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="obat.php">
                <i class="bi bi-capsule"></i>
                    <span>Obat</span></a>
            </li>

              <!-- Heading -->
              <div class="sidebar-heading">
              Auth
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

              <!-- Log out -->
              <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php">
                <i class="bi bi-box-arrow-left"></i>
                    <span>Log Out</span></a>
            </li>

              <!-- Divider -->
              <hr class="sidebar-divider d-none d-md-block">

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
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pala Raya Kota Tegal</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/PR.ico">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                      
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <?php
                    while($data = mysqli_fetch_assoc($dashboard)){
                    ?>
                        <!-- Card pasien -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pasien</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['pasien']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-person-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card kunjungan hari ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Kunjungan Hari Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['kunjungan_hari_ini']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-person-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card kunjungan minggu ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kunjungan Minggu Ini
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $data['kunjungan_minggu_ini']; ?></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-person-fill fa-2x text-gray-300"></i>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card kunjungan bulan ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Kunjungan Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['kunjungan_bulan_ini']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-person-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <!-- Card rujukan hari ini -->
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Rujukan Hari Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['rujukan_hari_ini']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-clipboard2-pulse-fill fa-2x text-gray-300"></i>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <!-- Card rujukan minggu ini -->
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Rujukan Minggu Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['rujukan_minggu_ini']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-clipboard2-pulse-fill fa-2x text-gray-300"></i>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Card rujukan bulan ini -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Rujukan Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['rujukan_bulan_ini']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-clipboard2-pulse-fill fa-2x text-gray-300"></i>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }?>
                        <!-- Akhir while -->
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>