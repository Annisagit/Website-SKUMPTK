<?php
//inisialisasi session
require('koneksi.php');
date_default_timezone_set('Asia/Jakarta');

session_start();

$error = '';
$validate = '';
//mengecek username pada session
if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = 'anda harus login untuk mengekses halaman ini';
    header('Location: logoutadmin.php');
} else {
        if( isset($_POST['submit'])) {
            if(isset($_FILES['hard_copy'])){
                $nama = $_POST['nama'];
                $nip = $_POST['nip'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $alamat = $_POST['address'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $agama = $_POST['agama'];
                $jabatan = $_POST['jabatan'];
                $pangkat = $_POST['pangkat'];
                $instansi = $_POST['instansi'];
                $tgl_upload = date('Y-m-d H:i:s');
                $status = $_POST['submit_status'];
                $name = $_FILES['hard_copy']['name'];
                $file_tmp= $_FILES['hard_copy']['tmp_name'];
                $DirUpload = "../Project UAS SKUMPTK/File/";
                $LinkBerkas = $DirUpload.$name;

                if($file_tmp == null){
                    move_uploaded_file($file_tmp, $LinkBerkas);
                    $script = "INSERT into pengusul (nama, nip, tempat_lahir, tanggal_lahir, address, jenis_kelamin, agama, jabatan, pangkat, instansi, tgl_upload, hard_copy, submit_status) VALUES ('$nama', '$nip', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin',
                    '$agama', '$jabatan', '$pangkat', '$instansi', '$tgl_upload', '$name', '$status')";  
                } else{
                    move_uploaded_file($file_tmp, $LinkBerkas);
                    $script = "INSERT into pengusul (nama, nip, tempat_lahir, tanggal_lahir, address, jenis_kelamin, agama, jabatan, pangkat, instansi, tgl_upload, hard_copy, submit_status) VALUES ('$nama', '$nip', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin',
                    '$agama', '$jabatan', '$pangkat', '$instansi', '$tgl_upload', '$name', '$status')";
                }
                $query = mysqli_query($conn,$script);
                if($query){
                    header('Location: listusulanadmin.php');
            } else{
                echo "Gagal mengupload data";
            }
            }        
        }
    }
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
    <link href="./assets/dist/css/headers.css" rel="stylesheet">
    <link href="./assets/dist/css/heroes.css" rel="stylesheet">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
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

            <div class="px-3 pt-1 my-5 text-center">
                <h2>Formulir SKUMPTK</h2>
                <div class="col-lg-10 mx-auto">
                <p class="lead mb-4">Silakan melengkapi formulir di bawah ini. Periksa kembali jawaban Anda sebelum mengajukan formulir</p>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="container px-5 my-2">
                    <div class="row g-5 align-items-center justify-content-center">
                    <div class="col-md-5 col-lg-6">
                       
                    <form class="needs-validation" id="form-input" novalidate method="post" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-sm-7">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" required>
                        </div>
            
                        <div class="col-sm-5">
                        <label class="form-label">NIP</label>
                        <input type="number" class="form-control" name="nip" minlength="10" maxlength="20" required>
                        </div>

                        <div class="col-sm-7">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
            
                        <div class="col-sm-5">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>

                        <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="address" required>
                        </div>

                        <div class="col-12">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>
                        </div>

                        <div class="col-12">
                        <label class="form-label">Agama</label>
                        <select class="form-select" name="agama" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Khonghucu</option>
                            <option value="Protestan">Protestan</option>
                        </select>
                        </div>
                        <hr color="black" class="my-4">

                        <div class="col-sm-7">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required>
                        </div>
            
                        <div class="col-sm-5">
                        <label class="form-label">Pangkat/Golongan</label>
                        <input type="text" class="form-control" name="pangkat" required>
                        </div>

                        <div class="col-12">
                        <label class="form-label">Instansi</label>
                        <input type="text" class="form-control" name="instansi" placeholder="Pada Instansi, Dep./Lembaga..." required>
                        </div>
                        <hr color="black" class="my-4">

                        <div class="col-12">
                        <label class="form-label">Formulir SKUMPTK Pemohon</label>
                        <input type="file" class="form-control" accept=".pdf, .docx, .doc" name="hard_copy" required>
                        </div>

                        <div class="col-12">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" name="submit_status" required>
                        </div>
            
                        <div class="text-danger-emphasis">
                        *Periksa kembali jawaban Anda sebelum mengumpulkan formulir. Pembaharuan dan penghapusan pengajuan hanya dapat dilakukan saat pengajuan belum diverifikasi!
                        </div>
                    <hr color="black" class="my-4">

                    <button type='submit' id='tombol-simpan' name='submit' class='btn btn-primary my-2'>Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </main>
        <br>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top" style="background-color: #1B1717">
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
        <script>
        $("#tombol-simpan").click(function () {
            //validasi form
            $('#form-input').validate({
                rules: {
                    hard_copy: {
                        required: true
                    }
                }
            });
        });
    </script>
        <script src="./assets/dist/js/script.js"></script>

</body>
</html>