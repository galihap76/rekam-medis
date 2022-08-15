<?php
include_once '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lupa password</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
            body{
               background-color:dodgerblue;
           }
        </style>
    </head>

    <body>
<?php
//cek jika tombol ubah di tekan
if(isset($_POST['ubah'])){

    //ambil data dari form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    //ambil username dari tabel users
    $rowTable = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

    //cek jika password konfirmasi tidak cocok
    if($password !== $password2){

        //beri peringatan
        echo "<script>
        swal('PERINGATAN', 'Maaf password tidak valid.', 'error');
        </script>";

        //cek jika username nya ada dalam database
    }else if(mysqli_num_rows($rowTable) > 0){

        // enkripsi password
	    $password = password_hash($password, PASSWORD_DEFAULT);

        //update password
        $queryUpdate = mysqli_query($db, "UPDATE users SET password='$password' WHERE username = '$username'");

        //cek jika berhasil di ubah
        if($queryUpdate){
            //redirect ke halaman login
            header('Location: login.php');
        }

        //cek jika username dan password nya tidak valid
    }else if(mysqli_num_rows($rowTable) === 0){
        //beri peringatan
        echo "<script>               
        swal('PERINGATAN', 'Ubah password tidak valid.', 'error');
        </script>
        ";
    }
}

?>

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow border-1 rounded-lg mt-5">                                   
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Lupa password</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                           
                                            <div class="form-group">
                                                <label class="small mb-1" for="username">Username</label>
                                                <input class="form-control py-4" id="username" name="username" type="text" placeholder="Username" maxlength="15" autocomplete="off" required/>                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" id="password" name="password" type="password" placeholder="Password" required/>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password2">Konfirmasi password</label>
                                                <input class="form-control py-4" id="password2" name="password2" type="password" placeholder="Konfirmasi password" required/>
                                               
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Kembali</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>