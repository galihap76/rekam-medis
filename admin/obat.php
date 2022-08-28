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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Obat</title>

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
            <li class="nav-item">
                <a class="nav-link" href="pasien.php">
                <i class="bi bi-person-fill"></i>
                    <span>Pasien</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == "obat.php" ? "active" : "");?>">
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
                <div class="modal fade" id="tambahObat" tabindex="-1" aria-labelledby="tambahObat" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahObat">Tambah Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Form tambah -->
                    <form method="post" action="insertDataObat.php">

                        <!-- Pesan jika data berhasil di tambah -->
                    <div class="alert alert-success alert-dismissible pesanTambah" role="alert" style="display:none;">
                       Data obat berhasil di tambahkan.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control tambah-data" id="nama_obat" name="nama_obat" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="text" class="form-control tambah-data" id="stok" name="stok" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control tambah-data" id="satuan" name="satuan" autocomplete='off' required/>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="text" class="form-control tambah-data" id="tanggal_masuk" name="tanggal_masuk" autocomplete='off' required/>
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
                 <div class="modal fade" id="editObat" tabindex="-1" aria-labelledby="editObat" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editObat">Edit Obat</h5>
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

    //load dokumen HTML
$(document).ready(function(){
    //tampilkan data obat menggunakan AJAX
        loadData()

        //cek jika tombol tambah di submit 
        $('form').on('submit', function(e){

            //fungsi e.preventDefault() dalam studi kasus ini di gunakan agar tetap berada pada file obat.php
            e.preventDefault()
           
            //lakukan tambah obat menggunakan AJAX
            $.ajax({

                //ambil atrribute method
                type:$(this).attr('method'),

                //ambil attribute action
                url:$(this).attr('action'),

                //ambil semua data form html dari input name
                data:$(this).serialize(),

                //function ketika data success di tambahkan
                success:function(){
                    //load data menggunaan AJAX
                    loadData()

                    //munculkan pesan jika data berhasil di tambahkan
                    document.querySelector(".pesanTambah").style.display = "block";

                    //hapus value form modal ketika berhasil di submit
                    $('[type=text]').val('')
                },

                //cek jika error
                error: function() {
                    //beri peringatan error
                    alert('Maaf data gagal di tambahkan!')
                }
            })
           
        })

        //function untuk loadData menggunakan AJAX
        function loadData(){

            //lakukan ajax
            $.ajax({

                //loadData pada file getDataObat.php menggunakan AJAX
                url:'getDataObat.php',

                //gunakan method GET
                type:'get',

                //cek jika success
                success:function(data){

                    //lakukan AJAX untuk menampilkan data obat
                    $('#contentData').html(data)

                    //cek jika menekan tombol hapus
                    $('.hapusData').click(function(e){
                        if(confirm('Apakah anda yakin untuk hapus data obat?') == true){

                         //fungsi e.preventDefault() dalam studi kasus ini di gunakan agar tetap berada pada file obat.php
                        e.preventDefault()

                        //lakukan ajax
                        $.ajax({

                            //gunakan method GET
                            type:'get',

                            //ambil attribute pada href yang berada pada file getDataObat.php pada variabel $link_delete
                            url:$(this).attr('href'),

                            //cek jika success
                            success:function(){
                                //load data menggunakan AJAX
                                loadData()
                            }
                        })

                    //cek jika data tidak jadi di hapus
                    }else{
                        //jangan hapus tetapkan di file obat.php
                        e.preventDefault()
                       
                    }
                })
            }     
        })  
            
            //cek jika tombol editObat di tekan
            $('#editObat').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            
                //biar mudah, kode di bawah ini di gunakan untuk mempermudah pengambilan data form modal edit agar value muncul sesuai no yang ada pada tabel bernama obat
            }).on("show.bs.modal", function(event){
                var button =  $(event.relatedTarget);
                var no = $(event.relatedTarget).closest("tr").find("td:eq(0)").text(); 
                var no_obat = $(event.relatedTarget).closest("tr").find("td:eq(1)").text(); 
                var nama_obat = $(event.relatedTarget).closest("tr").find("td:eq(2)").text(); 
                var stok = $(event.relatedTarget).closest("tr").find("td:eq(3)").text();
                var satuan = $(event.relatedTarget).closest("tr").find("td:eq(4)").text();
                var tanggal_masuk = $(event.relatedTarget).closest("tr").find("td:eq(5)").text();

                //muncul kan form modal edit
                $(this).find('#modal-edit').html($(
                    `
                <!-- Form edit -->
                    <form method="post" class="updateData">

                    <!-- Pesan jika data berhasil di tambah -->
                    <div class="alert alert-success alert-dismissible pesanUbah" role="alert" style="display:none;">
                       Data obat berhasil di ubah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <div class="mb-3">
                        <label for="no" class="form-label d-none">no</label>
                        <input type="text" class="form-control d-none" id="no" name="no" autocomplete='off' value="${no}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" autocomplete='off' value="${nama_obat}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" autocomplete='off' value="${stok}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" autocomplete='off' value="${satuan}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" autocomplete='off' value="${tanggal_masuk}" required/>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="edit" id="edit">Edit</button>
                    </div>
               
                    </form>

                    <!-- Akhir form edit -->
                    
               `
                
                ))

                //cek jika tombol edit di tekan
                $('#edit').click(function(e){
                    //ambil semua data form edit modal
                    var data = $('.updateData').serialize()

                    // if(nomor_identitas == '' || nama_pasien == '' || jenis_kelamin == '' || alamat == '' || no_telepon == ''){
                    //     alert('Ok')
                    //     exit;
                    // }

                    //lakukan AJAX
                    $.ajax({

                        //gunakan method POST
                      type:'POST',

                      //siapkan data edit
                      data:data,

                      //edit obat pada file updateDataObat.php
                      url:'updateDataObat.php',

                      //cek jika success
                      success:function(){
                          //load data obat menggunakan AJAX
                          loadData()

                           //munculkan pesan jika data berhasil di ubah
                           document.querySelector(".pesanUbah").style.display = "block";

                          //hapus value form modal ketika berhasil di submit
                          $('[type=text]').val('')
                        }
                    })
               
                })
                
            }).on('hide.bs.modal', function(event){
                $(this).find('#modal-edit').html("")
            })
      
        }
    })
</script>
</body>
</html>