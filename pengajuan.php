<?php 
ob_start();
date_default_timezone_set('Asia/Jakarta');

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

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/"> -->
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
  <div class="px-3 pt-1 my-5 text-center">
    <h2>Formulir SKUMPTK</h2>
    <div class="col-lg-10 mx-auto">
      <p class="lead mb-4">Silakan melengkapi formulir di bawah ini. Periksa kembali jawaban Anda sebelum mengajukan formulir</p>
    </div>
  </div>
    <div class="overflow-hidden">
      <div class="container px-5 my-2">
        <div class="row g-5 align-items-center justify-content-center">
          <div class="col-md-5 col-lg-7">
          <?php
            if(!isset($_SESSION['username'])){
              header("location: logout.php");
            } else {
              $script = mysqli_query($conn,"SELECT * FROM pengusul WHERE username = '$_SESSION[username]'");
              $data = mysqli_fetch_array($script);
              if(isset($_POST['submit'])){
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
                      $name = $_FILES['hard_copy']['name'];
                      $file_tmp= $_FILES['hard_copy']['tmp_name'];
                      $DirUpload = "../Project UAS SKUMPTK/File/";
                      $LinkBerkas = $DirUpload.$name;

                      if($file_tmp == null){
                          move_uploaded_file($file_tmp, $LinkBerkas);
                          $script = "UPDATE pengusul SET nama='$nama', nip='$nip', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', address='$alamat',
                          jenis_kelamin='$jenis_kelamin', agama='$agama', jabatan='$jabatan', pangkat='$pangkat', instansi='$instansi', tgl_upload='$tgl_upload',
                          hard_copy='$name' WHERE username = '$_SESSION[username]'";
                      } else{
                          move_uploaded_file($file_tmp, $LinkBerkas);
                          $script = "UPDATE pengusul SET nama='$nama', nip='$nip', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', address='$alamat',
                          jenis_kelamin='$jenis_kelamin', agama='$agama', jabatan='$jabatan', pangkat='$pangkat', instansi='$instansi', tgl_upload='$tgl_upload',
                          hard_copy='$name' WHERE username = '$_SESSION[username]'";
                      }
                      $query = mysqli_query($conn,$script);
                      if($query){
                        // redirect('<div class="alert alert-success alert-dismissible fade show" role="alert">
                        //             <strong>Success!</strong> Formulir berhasil diunggah. Pergi ke halaman Histori Pengajuan untuk selengkapnya.
                        //           </div>', '/Project UAS SKUMPTK/pengajuan.php');
                        // header("location:pengajuan.php");
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                        echo "<strong>Success!</strong> Formulir berhasil diunggah. Pergi ke halaman Histori Pengajuan untuk selengkapnya.";
                        echo "</div>";
                      } else{
                          echo "Gagal mengupload data";
                      }
                  }
              }
            }
          ?>
            <form class="needs-validation" id="form-input" novalidate method="post" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-sm-7">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" required value="<?= $data['nama']?>">
                </div>
    
                <div class="col-sm-5">
                  <label class="form-label">NIP</label>
                  <input type="number" class="form-control" name="nip" minlength="10" maxlength="20" required value="<?= $data['nip']?>">
                </div>

                <div class="col-sm-7">
                  <label class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" required value="<?= $data['tempat_lahir']?>">
                </div>
    
                <div class="col-sm-5">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tanggal_lahir" required value="<?= $data['tanggal_lahir']?>">
                </div>

                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="address" required value="<?= $data['address']?>">
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
                  <input type="text" class="form-control" name="jabatan" required value="<?= $data['jabatan']?>">
                </div>
    
                <div class="col-sm-5">
                  <label class="form-label">Pangkat/Golongan</label>
                  <input type="text" class="form-control" name="pangkat" required value="<?= $data['pangkat']?>">
                </div>

                <div class="col-12">
                  <label class="form-label">Instansi</label>
                  <input type="text" class="form-control" name="instansi" placeholder="Pada Instansi, Dep./Lembaga..." required value="<?= $data['instansi']?>">
                </div>
                <hr color="black" class="my-4">

                <div class="col-12">
                  <label class="form-label">Formulir SKUMPTK Pemohon</label>
                  <input type="file" class="form-control" accept=".pdf, .docx, .doc" name="hard_copy" required value="<?= $data['hard_copy']?>">
                </div>

                <div class="col-12">
                  <label class="form-label">Status</label>
                  <input type="text" class="form-control" name="submit_status" disabled value="<?= $data['submit_status']?>">
                </div>
    
                <div class="text-danger-emphasis">
                  *Periksa kembali jawaban Anda sebelum mengumpulkan formulir. Pembaharuan dan penghapusan pengajuan hanya dapat dilakukan saat pengajuan belum diverifikasi!
                </div>
              <hr color="black" class="my-4">

              <?php
              if($data['submit_status'] != 'Terkirim'){
                echo "<button type='submit' id='tombol-simpan' name='submit' class='btn btn-primary my-3' disabled>Submit</button>";
              } else {
                echo "<button type='submit' id='tombol-simpan' name='submit' class='btn btn-primary my-3'>Submit</button>";
              }
              ?>
              <!-- <button type="submit" id="tombol-simpan" name="submit" class="btn btn-primary">Submit</button> -->
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
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
</body>
</html>
