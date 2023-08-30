<?php
ob_start();

require "koneksi.php";
session_start();

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

<main>
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

  <div class="px-4 py-5">
    <h3 class="pb-2">Pengajuan Pemohon</h3>
    
    <hr class="featurette-divider">
        <table class="table table-hover table-striped align-middle">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">NIP</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Pangkat</th>
                <th scope="col">Instansi</th>
                <th scope="col">Status</th>
                <th scope="col">Waktu Perubahan Terakhir</th>
                <th scope="col">File Formulir</th>
                <th scope="col" class="text-danger">Renewal</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                  <th scope="row">
                      <?= $data['id']?>
                  </th>
                  <td>
                      <?= $data['nama']?>
                  </td>
                  <td>
                      <?= $data['nip']?>
                  </td>
                  <td>
                      <?= $data['jabatan']?>
                  </td>
                  <td>
                      <?= $data['pangkat']?>
                  </td>
                  <td>
                      <?= $data['instansi']?>
                  </td>
                  <td>
                      <?= $data['submit_status']?>
                  </td>
                  <td>
                      <?= $data['tgl_upload']?>
                  </td>
                  <td>
                      <?= $data['hard_copy']?>
                  </td>
                  <td>
                  <div class="d-flex gap-2 justify-content-sm-start">
                    <?php
                    if(isset($_SESSION['username'])){
                        echo "<a href='unduh.php?file=$data[hard_copy]' class=''>";
                        echo "<i class='far fa-file-download'></i>";
                        echo "</a>";
                    } 
                    
                    if($data['submit_status'] != 'Terkirim'){
                        echo "<a href='#' class='disabled'>";
                        echo "<i class='fa fa-trash'></i>";
                        echo "</a>";
                    } else {
                        echo "<a href='#' class='' data-toggle='modal' data-target='#myModal'>";
                        echo "<i class='fa fa-trash'></i> ";
                        echo "</a>";
                    }
                    ?>
                  </div>
                  </td>
              </tr>
            </tbody>
        </table>
        
        <div class="data-user d-flex justify-content-center">
                <div class="data-usulan" style="width:65%; margin:15px 30px;">
                    <table class="table table-hover table-striped">
                        <tr>
                            <td><b>Nama</b></td>
                            <td><?php echo "<td>" . $data['nama'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>NIP</b></td>
                            <td><?php echo "<td>" . $data['nip'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Jabatan</b></td>
                            <td><?php echo "<td>" . $data['jabatan'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Pangkat</b></td>
                            <td><?php echo "<td>" . $data['pangkat'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Instansi</b></td>
                            <td><?php echo "<td>" . $data['instansi'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Tempat Lahir</b></td>
                            <td><?php echo "<td>" . $data['tempat_lahir'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal lahir</b></td>
                            <td><?php echo "<td>" . $data['tanggal_lahir'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Jenis Kelamin</b></td>
                            <td><?php echo "<td>" . $data['jenis_kelamin'] . "</td>";?></td>
                        </tr>
                        
                        <tr>
                            <td><b>Agama</b></td>
                            <td><?php echo "<td>" . $data['agama'] . "</td>";?></td>
                        </tr>
                        
                        <tr>
                            <td><b>Address</b></td>
                            <td><?php echo "<td>" . $data['address'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td><?php echo "<td>" . $data['submit_status'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>File Pengajuan</b></td>
                            <td><?php echo "<td>" . $data['hard_copy'] . "</td>";?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Pengajuan</b></td>
                            <td><?php echo "<td>" . $data['tgl_upload'] . "</td>";?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <form class="form-container" action="histori.php?id=<?= $data['id'] ?>" method="POST">
            <div style="color:red">
            <?php 
                $id = $_GET['id'];
                $script = "SELECT * FROM pengusul where id = $id";
                $query = mysqli_query($conn, $script);
                $data = mysqli_fetch_array($query); 
                    if(isset($_POST['submit'])){
                        $sql = "UPDATE pengusul SET nama='', nip='', tempat_lahir='', tanggal_lahir='', address='',
                        jenis_kelamin='', agama='', jabatan='', pangkat='', instansi='', tgl_upload='', submit_status='',
                        hard_copy='' WHERE id = $id";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            header("location: index.php");
                        }
                    }
            
            ?>
            </div>
            <div id="myModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembatalan Pengajuan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong class="text-danger">Apakah Anda yakin ingin membatalkan pengajuan?</strong>
                    <p>Jika Anda membatalkan pengajuan dan setelahnya ingin mengajukan kembali, Anda harus mengajukan langsung melalui Administrator</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Save changes"></input>
                </div>
                </div>
            </div>
            </div></form>
      </div>
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top" style="background-color: #1B1717">
          <div class="col-md-4 d-flex align-items-center">
          <span class="mb-3 mb-md-0 text-light">&copy; 2023 BKPSDM Kabupaten Purwakarta</span>
          </div>
  
          <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3 text-light">Powered by Politeknik Negeri Jakarta</li>
          </ul>
      </footer>
</main>
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
