<?php
//menyertakan file program configpagination.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah session username tersedia atau tidak, jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['admin'])) header('Location: dashboaradmin2.php');

//mengecek apakah form disubmit atau tidak
if(isset($_POST['submit'])){

    //menghilangkan backshlases
    $username = stripslashes($_POST['username']);

    //cara sederhana mengamankand ari sql injection
    $username = mysqli_real_escape_string($conn, $username);

    //menghilangkan backshlases
    $password = stripslashes($_POST['password']);

    //cara sederhana mengamankand ari sql injection
    $password = mysqli_real_escape_string($conn, $password);

    $repass = stripslashes($_POST['repassword']);
    $repass = mysqli_real_escape_string($conn, $repass);

    //cek apakah nilai yang diinputkan kosong atau tidak
    if(!empty(trim($username)) && !empty(trim($password)) && !empty(trim($repass))){
        if($password == $repass){
            if(cek_nama($username, $conn) == 0){
                $pass = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO admin (username, password) VALUES ('$username', '$pass')";
                $result = mysqli_query($conn, $query);
                if($result){
                    $_SESSION['username'] = $username;
                    header('Location: dashboardadmin2.php');
                } else{
                    $error = 'Register User Gagal!!';
                }
            } else{
                $error = 'Username sudah terdaftar!!';
            }
        } else{
            $validate = 'Password tidak sama!!';
        }
    } else{
        $error= 'Data tidak boleh kososng!!';
    }
}

//fungsi untuk mengecek username apakah sudah terdaftar atau belum
function cek_nama($username, $conn){
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM admin WHERE username = '$username'";
    if($result = mysqli_query($conn, $query)) return mysqli_num_rows($result);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/dist/css/stylelogin.css">

</head>
<body>
    <div class="header" style="background-color: #810000;">
        <nav class='navbar navbar-expand-lg navbar-black text-light'>
            <div class="container">
                <h3>Sistem Informasi Pengajuan SKUMPTK</h3>
            </div>
        </nav>
    </div>
    <section class="login d-flex">
        <div class="login-left w-50 ">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6">
                    <form action="registeradmin2.php" class="form-container" method="POST">
                    <div class="header">
                        <h1>Welcome back</h1>
                        <p>Welcome back! Please enter your details.</p>
                    </div>
                    <?php 
                    if($error != ''){ ?>
                    <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>

                    <div class="login-form">
                        <div class="form-group">
                            <label for="username" class="form-label"> Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter your username">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label"> Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password">
                            <?php if($validate != '') {?>
                            <p class="text-danger"><?=$validate; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Re-Password</label>
                            <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                            <?php if($validate != '') {?>
                                <p class="text-danger"><? $validate; ?></p>
                            <?php }?>
                        </div>
                        <button type="submit" name="submit" class="signin" >Sign Up</button>
                        <div class="text-center">
                            <span class="d-inline">Do you have an account? <a href="loginadmin.php" 
                                class="d-inline text-decoration-none">
                                Sign in as administrator</a></span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
            
        <div class="login-right w-50 ">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/Aplikasi_SKUMPTK.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>skumptk</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar-2.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>description</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar-3.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>our team</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>