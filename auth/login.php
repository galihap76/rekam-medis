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
        <title>Login</title>
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
if(isset($_COOKIE['sess_id'])){
    $roleCookie = $_COOKIE['sess_id'];
    $querySelect = mysqli_query($db, "SELECT role FROM users WHERE role = '$roleCookie'");
    $rowData = mysqli_fetch_assoc($querySelect);

    if($rowData['role'] == 'admin'){
        $_SESSION['login'] = true;
        $_SESSION['admin'] = $rowData['role'];
        header("Location: ../admin/index.php");
       
    }else if($rowData['role'] == 'user'){
        $_SESSION['login'] = true;
        $_SESSION['user'] = $rowData['role'];
        header("Location: ../user/index.php");
       
    }
}


//cek ketika tombol login di tekan
if(isset($_POST['login'])){
    
    //ambil data dari form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //ambil username dari tabel users
    $rowTable = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
    $rowData = mysqli_fetch_assoc($rowTable);

    //cek jika username ada dalam tabel users
    if(mysqli_num_rows($rowTable) > 0){

        //cek jika yang masuk admin
        if($rowData['role'] == 'admin'){

            //cek jika password nya benar
            if(password_verify($password, $rowData["password"])){

                //set session
                $_SESSION['login'] = true;

                //cek jika tombol remember me di tekan
			    if(isset($_POST["remember"])){

                    //buat cookie
                    setcookie('sess_id', $rowData['role'], time() + 86400 * 30, "/");
                    setcookie('auth', hash('sha512', $rowData['username']), time() + 86400 * 30, "/");
                
                }

                //redirect ke halaman admin
                $_SESSION['admin'] = $rowData['role'];
                header('Location: ../admin/index.php');

                //cek jika password nya salah
            }else{
                //beri peringatan
                echo "<script>               
                swal('PERINGATAN', 'Maaf password anda salah.', 'error');
                </script>
                ";
            }
            //cek jika yang masuk user
        }else if($rowData['role'] == 'user'){


            //cek jika password nya benar
            if(password_verify($password, $rowData["password"])){

                //set session
                $_SESSION['login'] = true;

                //cek jika tombol remember me di tekan
			  if(isset($_POST["remember"])){

                //buat cookie
                setcookie('sess_id', $rowData['role'], time() + 86400 * 30, "/");
                setcookie('auth', hash('sha512', $rowData['username']), time() + 86400 * 30, "/");
           
              }         

                //redirect ke halaman user
                $_SESSION['user'] = $rowData['role'];
                header('Location: ../user/index.php');
            
               //cek jika password nya salah
            }else{
                 //beri peringatan
                echo "<script>               
                swal('PERINGATAN', 'Maaf password anda salah.', 'error');
                </script>
                ";
            }
        }

        //cek jika username dan password tidak valid
    }else if(mysqli_num_rows($rowTable) === 0){
          //beri peringatan
        echo "<script>               
        swal('PERINGATAN', 'Maaf login tidak valid.', 'error');
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
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
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="remember" name="remember" type="checkbox" />
                                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="lupa_password.php">Lupa password?</a>
                                                <button type="submit" class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="signup.php">Belum daftar? Sign up!</a></div>
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