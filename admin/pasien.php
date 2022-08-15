<?php
session_start();
include_once '../config/koneksi.php';

//cek jika belum login
if(!isset($_SESSION['login'])){
    //kembalikan user ke halaman login
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

$pasien = mysqli_query($db, "SELECT * FROM pasien");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pasien</title>

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

    <!-- Datatables -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <li class="nav-item">
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

            <!-- Pasien -->
            <li class="nav-item  <?php echo (basename($_SERVER['PHP_SELF']) == "pasien.php" ? "active" : "");?>">
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

                <!-- Modal tambah-->
                <div class="modal fade" id="tambahPasien" tabindex="-1" aria-labelledby="tambahPasien" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPasien">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Form tambah -->
                    <form method="post" action="insertData.php">
                    <div class="mb-3">
                        <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
                        <input type="text" class="form-control tambah-data" id="nomor_identitas" name="nomor_identitas" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control tambah-data" id="nama_pasien" name="nama_pasien" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control tambah-data" id="jenis_kelamin" name="jenis_kelamin" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control tambah-data" id="alamat" name="alamat" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No telepon</label>
                        <input type="text" class="form-control tambah-data" id="no_telepon" name="no_telepon" autocomplete='off' required/>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                    </div>
                    </form>

                    <!-- Akhir form tambah -->
                    </div>
                  
                    </div>
                </div>
                </div>
                <!-- Akhir modal tambah -->

                 <!-- Modal edit-->
                 <div class="modal fade" id="editPasien" tabindex="-1" aria-labelledby="editPasien" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasien">Edit Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal edit menggunakan jquery yang akan di tampilkan value per value pada form-->
                    <div class="modal-body" id="modal-edit">
    
                    </div>
                  
                    </div>
                </div>
                </div>
                <!-- Akhir modal edit -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- DataTables Example -->
                   <div id="contentData"></div>


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


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

     <!-- Page level plugins -->
     <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <!-- Ajax jquery -->
    <script>
$(document).ready(function(){
        loadData()

        $('form').on('submit', function(e){
            e.preventDefault()
           
            $.ajax({
                type:$(this).attr('method'),
                url:$(this).attr('action'),
                data:$(this).serialize(),
                success:function(){
                    loadData()
                    $('[type=text]').val('')
                },
                error: function(xhr, status, error) {
                    alert('Maaf data gagal di tambahkan!')
                }
            })
           
        })

        function loadData(){
            $.ajax({
                url:'getData.php',
                type:'get',
                success:function(data){
                    $('#contentData').html(data)
                    $('.hapusData').click(function(e){
                        e.preventDefault()

                        $.ajax({
                            type:'get',
                            url:$(this).attr('href'),
                            success:function(){
                              loadData()
                            }
                        })
                    })
                }        
            })  
            
            $('#editPasien').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            
            }).on("show.bs.modal", function(event){
                var button =  $(event.relatedTarget);
                var id = $(event.relatedTarget).closest("tr").find("td:eq(0)").text(); 
                var nomor_identitas = $(event.relatedTarget).closest("tr").find("td:eq(2)").text(); 
                var nama_pasien = $(event.relatedTarget).closest("tr").find("td:eq(3)").text();
                var jenis_kelamin = $(event.relatedTarget).closest("tr").find("td:eq(4)").text();
                var alamat = $(event.relatedTarget).closest("tr").find("td:eq(5)").text();
                var no_telepon = $(event.relatedTarget).closest("tr").find("td:eq(6)").text();

                $(this).find('#modal-edit').html($(
                    `
                <!-- Form edit -->
                    <form method="post" class="updateData">
                    <div class="mb-3">
                        <label for="id" class="form-label d-none">Id</label>
                        <input type="text" class="form-control d-none" id="id" name="id" autocomplete='off' value="${id}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" autocomplete='off' value="${nomor_identitas}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" autocomplete='off' value="${nama_pasien}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" autocomplete='off' value="${jenis_kelamin}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" autocomplete='off' value="${alamat}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" autocomplete='off' value="${no_telepon}" required/>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="edit" id="edit">Edit</button>
                    </div>
               
                    </form>

                    <!-- Akhir form edit -->
                    
               `
                
                ))

                $('#edit').click(function(e){
                    var data = $('.updateData').serialize()

                    // if(nomor_identitas == '' || nama_pasien == '' || jenis_kelamin == '' || alamat == '' || no_telepon == ''){
                    //     alert('Ok')
                    //     exit;
                    // }

                    $.ajax({
                      type:'POST',
                      data:data,
                      url:'updateData.php',
                      success:function(){
                          loadData()
                      }
                    })
               
                })
                
            }).on('hide.bs.modal', function(event){
                $(this).find('#modal-edit').html("")
            })
      

    //     function resetForm(){
    //         $(".tambah-data").each(function(){
    //             alert($(this).text())
    //         });
    //   }

    }

})
</script>
</body>
</html>