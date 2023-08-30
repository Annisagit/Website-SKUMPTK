<?php
//inisialisasi session
ob_start();
require "koneksi.php";
session_start();

//mengecek username pada session
if(!isset($_SESSION['username'])) header('Location: loginadmin.php');

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="./assets/dist/css/styledashboard.css">
    <title>SKUMPTK</title>
</head>
<body style="background-color: #EEEBDD;">
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-4">
                <img src="img/logo.jpg" alt="" style="width:70%;height:70%; border-radius:50px; " class="img"  >
                <h4 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">Administrator</span></h4>
            </div>

            <ul class="list-unstyled px-2">
                <li class="list-item" >
                    <a href="dashboardadmin2.php">
                        <i class="fal fa-home"></i>                        
                        <span class="description-header">Dashboard </span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="listuseradmin.php">
                        <i class="fal fa-user"></i>                        
                        <span class="description-header">Users </span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="listusulanadmin.php">
                        <i class="fal fa-mail-bulk"></i>                        
                        <span class="description-header">Usulan </span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="graphic.php">
                        <i class="fal fa-chart-pie-alt"></i>                        
                        <span class="description-header">Graphic </span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="logoutUser.php">
                        <i class="fal fa-sign-out-alt"></i>                        
                        <span class="description-header">Log-Out </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="content">
            <nav class="navbar navbar-inverse" style="height:33px;">
                <div class="list-item">
                    <div id="menu-button" class="button">
                        <input type="checkbox" id="menu-checkbox">
                        <label for="menu-checkbox" id="menu-label">
                            <div id="hamburger"></div>
                        </label>
                    </div> 
                </div>
            </nav>
            <nav class="navbar navbar-inverse2">
                <div class="container-fluid">
                    <h4>Administrasi Layanan Pengajuan SKUMPTK</h4>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-inverse" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            <main>
        <section class="container-fluid mb-4">
            <!-- justify-content-center untuk mengatur posisi form agar berada di tengah tampilan -->
            <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4" style="margin-top: 30px">
                <div style="color:red">
                <?php

                    $id = $_GET['id'];
                    $script = "SELECT * FROM pengusul where id = $id";
                    $query = mysqli_query($conn, $script);
                    $data = mysqli_fetch_array($query); 
                    if(isset($_POST['submit'])) {
                        $username = stripslashes($_POST['username']);
                        $username = mysqli_real_escape_string($conn, $username);
                        $password = stripslashes($_POST['password']);
                        $password = mysqli_real_escape_string($conn, $password);
                        $repass = stripslashes($_POST['repassword']);
                        $repass = mysqli_real_escape_string($conn, $repass);

                        if(!empty(trim($username)) && !empty(trim($password))
                        && !empty(trim($repass))) {
                            if($password == $repass){
                                if(cek_nama($username, $conn) == 0){
                                    $pass = password_hash($password, PASSWORD_DEFAULT);
                                    $query = "UPDATE pengusul SET username='$username', password='$pass' WHERE id=$id";
                                    $result = mysqli_query($conn, $query);
                                    
                                    if($result) {
                                            $_SESSION['username'] = $username;
                                            header('Location: listuseradmin.php');
                                        }
                                    } else {
                                        $error = 'Register User Gagal!!';
                                    }
                                } else {
                                    $error = 'Username sudah terdaftar!!';
                                }
                            } else {
                                $validate = 'Password tidak sama!!';
                            }
                        } else {
                            $error = 'Data tidak boleh kosong!!';
                        }
                    



                    function cek_nama($username,$conn){
                        $nama = mysqli_real_escape_string($conn, $username);
                        $query = "SELECT * FROM pengusul WHERE username = '$username'";
                        if($result = mysqli_query($conn, $query)) return mysqli_num_rows($result);
                    }
                    ?>   
                </div>
                <form class="form-container" action="createaccountuseradmin.php?id=<?= $id ?>" method="POST">
                <h4 class="text-center font-weight-bold"> Daftarkan Akun </h4>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="InputPassword">Re-Password</label>
                    <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                </div>
                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Create">
                </form>
            </section>
            </section>
        </section>
            </main>

            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top" style="background-color: #1B1717; position:relative; bottom: -215px ">
            <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-light">&copy; 2023 BKPSDM Kabupaten Purwakarta</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3 text-light">Powered by Politeknik Negeri Jakarta</li>
            </ul>
        </footer>
    </div>
    </div>
     <!-- Bootstrap requirement jquery pada posisi pertama, kemudian Popper.js, dan yang terakhir Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <script>
            $(".sidebar ul li").on('click', function(){
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            })
        </script>
        <script src="./assets/dist/js/script.js"></script>

</body>
</html>