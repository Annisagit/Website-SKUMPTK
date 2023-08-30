<?php 

include('koneksi.php');

session_start();

//mengecek username pada session
if(!isset($_SESSION['username'])) header('Location: loginuser.php');

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

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="./assets/dist/css/styledashboard.css">

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
  <center>
  <div id="carouselExampleIndicators" class="carousel slide col-9">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./img/Aplikasi_SKUMPTK.jpg" style="height: 100%;" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./img/gambar-2.png" class="d-block w-100" alt="...">
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
  </center>
  <br>

  <h2>Informasi Tentang SKUMPTK</h2>
  <p class="fs-5 col-md-8">digunakan untuk mendapatkan pembayaran tunjangan keluarga untuk seluruh pegawai Negeri Sipil(PNS)</p>
  <ul>
    <li>Disamping gaji pokok, PNS juga di berikan beberapa tunjangan contohnya tunjangan keluarga, Tunjangan keluarga ini berupa tunjangan anak 
      dan tunjangan istri/suami yang besarnya telah diatur sesuai dengan peraturan perundang-undangan yang berlaku.</li>
    <li>Setiap akhir tahun pada sekitar akhir bulan desember atau awal bulan Januari untuk mendapatkan tunjangan keluarga PNS (Pegawai Negeri Sipil) 
      diwajibkan untuk membuat surat keterangan untuk mendapatkan tunjangan keluarga yang disingkat dengan SKUMPTK.</li>
  </ul>
  <hr color="black" class="col-3 col-md-2 mb-5 text-black">

  <div class="row g-5">
      <div class="col-md-6">
        <h3>Siapa Saja yang menerima dan berapa tunjangannya??</h3>
        <p>Penerima SKUMPTK antara lain:</p>
        <ol>
          <li>Pertama, Yaitu istri atau suami dengan besarnya Tunjangan istri atau suami kalau tidak salah 10% dari gaji pokok. 
            namun jika kedua suami dan istrinya adalah PNS.maka tunjangan suami/istri tidak diberikan kepada kedua PNS tersebut  
            melainkan diberikan kepada salahsatu yang besar gaji pokoknya</li>
          <li> Kedua, Yaitu Anak dengan Besarnya Tunjangan anak yakni masing masing 2% dari gaji pokok baik itu anak kandung atau anak angkat peraturannya 
            asalkan anak tersebut. 
            1. belum berusia 25 tahun dan belum mendapatkan penghasilan sendiri, 
            2. belum pernah menikah. 
            3. tunjangan anak ini dibatasi hanya untuk 2 orang anak saja.</li>
        </ol>
      </div>

      <div class="col-md-6">
        <h3>Syarat Pengajuan</h3>
        <p>Syarat Dalam Pengajuan SKUMPTK Antara Lain:</p>
       <li> 1.Form SKUMPTK </li>
       <li> 2.SK CPNS (80 %)</li>
       <li> 3.SK PNS (100 %)</li>
       <li> 4.SK JABATAN STRUKTURAL (YANG MENDUDUKI JABATAN STRUKTURAL ESELON II, III dan  IV)</li>
       <li>5.SK MUTASI (BAGI PEGAWAI YANG MUTASI)</li>
       <li> 6.SK KEPALA SEKOLAH DEFINITIF (BAGI KEPSEK DEFINITIF)</li>
       <li> 7.SK PENGAWAS / WIDYAISWARA / ANALIS KEPEGAWAIAN (BAGI PENGAWAS / WIDYAISWARA / ANALIS KEPEGAWAIAN)</li>
       <li> 8.SK PANGKAT GOL TERAKHIR (KTK )</li>
       <li>9.SK BERKALA TERAKHIR (KGB)</li>
       <li>10.KARIS / KARSU</li>
       <li>11.KONVERSI NIP BARU /KPE /KARPEG</li>
       <li>12.NPWP</li>
       <li>13.SURAT NIKAH / SURAT CERAI / SURAT KEMATIAN</li>
       <li>14.KARTU KELUARGA</li>
       <li>15.AKTE ANAK</li>
       <li>16.SURAT KETERANGAN KULIAH ASLI (JIKA ANAK MASUK DALAM TANGGUNGAN GAJI USIA > 21 TH SD 25 TH)</li>
       <li>17.DAFTAR GAJI SUAMI / ISTRI JIKA KEDUANYA PNS</li>
       <li>18.TASPEN</li>
       <li> 19.IJAZAH TERAKHIR</li>
       <li>20.KTP SUAMI  dan ISTRI (TERBARU / MASIH AKTIF)</li>
       <li>21.REKENING BANK AKTIF</li>
          </li>
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
