<?php
session_start();
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
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       <style>
           .lowercase{
               text-transform: lowercase;
           }
           body{
               background-color:dodgerblue;
           }
       </style>

    </head>

    <body>
<?php

//cek jika tombol signup sudah di tekan
if(isset($_POST['signup'])){

    //ambil data dari form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $role = strtolower( mysqli_real_escape_string($db, $_POST['role']));

    //ambil tabel users bernama username
    $rowTable = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

    //cek jika sudah ada username dari database
    if(mysqli_fetch_assoc($rowTable)){
        //beri peringatan
        echo "<script>               
        swal('PERINGATAN', 'Maaf username sudah ada.', 'error');
        </script>
        ";
        
        //cek jika username nya belum ada
	}else{

        // enkripsi password
	    $password = password_hash($password, PASSWORD_DEFAULT);	

        //insert database
        $queryInsert = mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password', '$role')");

        //cek jika berhasil
        if($queryInsert){

        //redirect ke halaman login
        header('Location: login.php');

        //jika gagal
        }else{
            //beri peringatan
        echo "<script>               
        swal('PERINGATAN', 'Anda gagal untuk melakukan sign up.', 'error');
        </script>
        ";
        }
    }
}

?>


        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow border-1 rounded-lg mt-5">                                   
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Sign Up</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                        <div class="form-group">
                                                <label class="small mb-1" for="role">Daftar sebagai</label>
                                                <input class="form-control py-4 lowercase" id="role" name="role" type="text" placeholder="admin / user" maxlength="15" autocomplete="off" required/> 
                                                <p style="display: none; color:red;" id="error"><i class="bi bi-exclamation-circle"></i> Harap anda harus memilih dalam daftar admin atau user</p>                                               
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="small mb-1" for="username">Username</label>
                                                <input class="form-control py-4" id="username" name="username" type="text" placeholder="Username" maxlength="15" autocomplete="off" required/>                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" id="password" name="password" type="password" placeholder="Password" required/>
                                               
                                            </div>
                                          
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">                                            
                                                <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Sudah daftar? login!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            //variabel untuk role
        let role = document.getElementById('role');

        // buat event keyup ketika keyboard di tekan
        role.addEventListener('keyup', function(){

            //cek jika tidak memasukkan daftar admin atau user
            if(role.value.toLowerCase() != 'admin' || role.value.toLowerCase() != 'user'){
                //berikan pesan kesalahan
                document.getElementById("error").style.display = "block";
       
            }

            //cek jika yang masuk itu admin atau user atau hasil nya dalam form itu tidak di isi
            if(role.value.toLowerCase() ==  'admin' || role.value.toLowerCase() == 'user' || role.value.toLowerCase() == ''){
                //hapus pesan kesalahan
                document.getElementById("error").style.display = "none";
            }

            //cek jika panjang huruf nya itu lebih besar dari 5
            if(role.value.length > 5){
                //hapus isi form daftar
                role.value = '';
            }
        });

        </script>
    </body>
</html>