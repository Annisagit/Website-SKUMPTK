<?php
//menyertakan file program configpagination.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah session username tersedia atau tidak, jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['username'])) header('Location: dashboaradmin2.php');

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

    //cek apakah nilai yang diinputkan kosong atau tidak
    if(!empty(trim($username)) && !empty(trim($password))){

        //select data berdasarkan username dari database
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if($rows != 0){
            $hash = mysqli_fetch_assoc($result)['password'];
            if(password_verify($password, $hash)){
                $_SESSION['username'] = $username;

                header('Location: dashboardadmin2.php');
            }

        //jika gagal maka akan menampilkan pesan error
        } else{
            $error = 'Register User Gagal!!';
        }
    } else{
        $error = 'Data tidak boleh kosong!!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKUMPTK</title>
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
        <div class="login-left w-50 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6">
                    <form action="loginadmin.php" class="form-container" method="POST">
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
                        

                        
                        <label for="captcha" class="form-label"> Captcha</label>
                            <!-- tentukan letak script generate gambar -->
                            <td><img src="captcha.php" alt="gambar" /> </td>
                        <div class="form-group">
                            <label for="username" class="form-label">Isikan Captcha</label>
                            <input type="text" class="form-control" id="kodecaptcha" name="kodecaptcha" placeholder="Masukkan Kode Captcha" maxlength="5">
                        </div>
                        <button type="submit" name="submit" class="signin" >Sign In</button>
                        <div class="text-center">
                            <span class="d-inline">Don't have an account? <a href="registeradmin2.php" 
                                class="d-inline text-decoration-none">
                                Sign up as administrator</a></span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
            
        <div class="login-right w-50">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/Aplikasi_SKUMPTK.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar-2.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar-3.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
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