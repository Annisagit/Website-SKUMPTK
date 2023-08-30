<?php 
include('koneksi.php');
session_start();

if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: loginuser.php');
}

if(isset($_SESSION['username'])){
  $script = "SELECT * FROM pengusul WHERE username = '$_SESSION[username]'";
  $query = mysqli_query($conn,$script);
  $data = mysqli_fetch_array($query);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>SKUMPTK</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/"> -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="./assets/dist/css/styledashboard.css">
    <link rel="stylesheet" href="./assets/dist/css/starter-template.css">

</head>
<body style="background-color: #EEEBDD;">

<div class="main-container d-flex">
<div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-4">
                <img src="img/logo.jpg" alt="" style="width:70%;height:70%; border-radius:50px; " class="img"  >
                <h4 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">Pengguna</span></h4>
            </div>

            <ul class="list-unstyled px-2">
                <li class="list-item" >
                    <a href="index.php">
                        <i class="fal fa-home"></i>                        
                        <span class="description-header">Dashboard </span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="informasi.php">
                      <i class="fal fa-info-circle"></i>                       
                        <span class="description-header">Informasi</span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="pengajuan.php">
                        <i class="fal fa-user-edit"></i>                    
                        <span class="description-header">Edit Pengajuan</span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="histori.php?id=<?= $data['id'] ?>">
                      <i class="fal fa-history"></i>                       
                      <span class="description-header">Histori Pengajuan</span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="formulir.php">
                      <i class="fal fa-file-alt"></i>                       
                        <span class="description-header">Formulir</span>
                    </a>
                </li>

                <li class="list-item" >
                    <a href="logoutUser.php">
                        <i class="fal fa-sign-out-alt"></i>                        
                        <span class="description-header">Log-Out</span>
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
<div class="container px-4 py-5 pt-1 col-lg-10">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./img/Aplikasi_SKUMPTK.jpg" style="height: 100%;" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./img/gambar-2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./img/gambar-3.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <br>

  <h2>Surat Keterangan Untuk Mendapatkan Pembayaran Tunjangan Keluarga</h2>
  <p class="fs-5 col-md-8">Berikut dasar hukum yang dijadikan acuan dalam ketentuan SKUMPTK</p>
  <ul>
    <li>Undang-Undang Nomor 43 Tahun 1999 tentang Perubahan atas Undang-Undang Nomor 8 Tahun 1974 tentang Pokok-Pokok Kepegawaian</li>
    <li>Surat Edaran kepala BKN No. 08/SE/1983 tanggal 26 April 1983 tentang laporan Perkawinan pertama/Janda Duda</li>
  </ul>
  <hr color="black" class="col-3 col-md-2 mb-5 text-black">

  <div class="row g-5">
      <div class="col-md-6">
        <h3>Prosedur/Alur</h3>
        <p>Berikut merupakan langkah-langkah dari pemrosesan pengajuan SKUMPTK</p>
        <ol>
          <li>Menerima dan memeriksa kelengkapan berkas serta pengecekan data pemohon</li>
          <li>Membuat pengantar OPD</li>
          <li>Pengiriman berkas ke BKPSDM</li>
        </ol>
      </div>

      <div class="col-md-6">
        <h3>Syarat Pengajuan</h3>
        <p>Untuk mengetahui selengkapnya dari syarat pengajuan SKUMPTK, klik tautan di bawah ini</p>
        <ul class="icon-list ps-0">
          <li class="d-flex align-items-start mb-1"><a href="informasi.php">Syarat dan Informasi Selengkapnya</a></li>
        </ul>
      </div>
  </div>
    <hr color="black" class="col-8 col-lg-12 mb-5">
</main>
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top" style="background-color: #1B1717">
                <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-light">&copy; 2023 BKPSDM Kabupaten Purwakarta</span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3 text-light">Powered by Politeknik Negeri Jakarta</li>
                </ul>
            </footer>
        </div>

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
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>
