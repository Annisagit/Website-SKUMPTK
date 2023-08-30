<?php
//inisialisasi session
session_start();

//mengecek username pada session
if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = 'anda harus login untuk mengekses halaman ini';
    header('Location: loginadmin.php');
}
require_once "koneksi.php";

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/dist/css/styledashboard.css">
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
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
                    <form action="listusulanadmin.php" method="get" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search...">
                        <button class="btn btn-inverse" type="submit" value="search">Search</button>
                    </form>
                </div>
            </nav>

            <main>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="data-usulan" style="width:90%; margin:15px 30px;">
                            <div class="container-fluid d-flex">
                                <h2 class="pull-left d-block text-center">Data Usulan</h2>
                            </div>
                            <?php
                            //include config file
                            $batas = 5;
                            $halaman = @$_GET['halaman'];
                            if(empty($halaman)){
                                $posisi = 0;
                                $halaman = 1;
                            }
                            else{
                                $posisi = ($halaman-1) * $batas;
                            }
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                $sql="select * from pengusul WHERE nama LIKE '%$search%' order by id Desc limit $posisi,$batas";
                            }else{
                                $sql="select * from pengusul WHERE nama != '' order by id  Desc limit $posisi,$batas";
                            }
                            //Attempt select query execution
                            if($result = mysqli_query($conn, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    echo "<table class='table table-hover table-striped' >";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>ID</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>NIP</th>";
                                                echo "<th>Instansi</th>";
                                                echo "<th>Tanggal Upload</th>";
                                                echo "<th>File</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>Aksi</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            $id = $row['id'];
                                            echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['nama'] . "</td>";
                                                echo "<td>" . $row['nip'] . "</td>";
                                                echo "<td>" . $row['instansi'] . "</td>";
                                                echo "<td>" . $row['tgl_upload'] . "</td>";
                                                echo "<td>" . $row['hard_copy'] . "</td>";
                                                echo "<td>" . $row['submit_status'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='unduh.php?file=$row[hard_copy] ' class=''>";
                                                    echo "<i class='far fa-file-download'></i>";
                                                    echo "</a>";
                                                    echo "
                                                        <a href='detailuseradmin.php?id=" . $row['id'] ."' title='View Record' data-toggle='tooltip'>
                                                            <i class='fa fa-eye'></i>            
                                                        </a>
                                                    ";
                                                    ?>
                                                        <a href="#" class="" title="Update Status" data-toggle="modal" data-target="#modaleditstatus<?php echo $id; ?>" >
                                                            <i class='fa fa-pencil'></i>            
                                                        </a>
                                                    <?php
                                                    echo "
                                                        <a href='createaccountuseradmin.php?id=" . $row['id'] ."' title='Create Account' data-toggle='tooltip'>
                                                            <i class='fa fa-user'></i>            
                                                        </a>
                                                    ";
                                                echo "</td>";
                                            echo "</tr>";
                                            ?>
                                            <!-- Modal Edit Status-->
                                            <div class="modal fade" id="modaleditstatus<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <form class="form-container" action="editstatus.php?id=<?= $id ?>" method="POST">
                                                        <input type="hidden" name="id" value="<?= $row['id']?>">
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <label class="form-label">Pilih Status Usulan :</label>
                                                                <select class="form-select float-right " style="width: 65%;" name="submit_status" >
                                                                    <option value="Terkirim">Terkirim</option>
                                                                    <option value="Diterima">Diterima</option>
                                                                    <option value="Ditolak">Ditolak</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="bsimpan" class="btn btn-primary" >Save</button>
                                                        </div>
                                                    </form>             
                                                </div>
                                            </div>
                                            </div>
                                          <?php  
                                        }
                                        echo "</tbody>";
                                    echo "</table>";
                                    //Free result
                                    mysqli_free_result($result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                            }
                            ?>
                        
                    </div>
                </div>
                <?php
                    if(isset($_GET['search'])){
                        $search= $_GET['search'];
                        $query2="select * from pengusul WHERE nama LIKE '%$search%' order by id Desc";
                    }else{
                        $query2="select * from pengusul WHERE nama != '' order by id Desc";
                    }
                    $result2 = mysqli_query($conn,$query2);
                    $jmldata = mysqli_num_rows($result2);
                    $jmlhalaman = ceil($jmldata/$batas)
                ?>
                <br>
                <ul class="pagination">
                    <?php
                    for($i=1;$i<=$jmlhalaman;$i++){
                        if ($i != $halaman){
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                echo "<li class='page-item'><a class='page-link' href='listusulanadmin.php?halaman=$i&search=$search'>$i</a></li>";
                            } else{
                                echo "<li class='page-item'><a class='page-link' href='listusulanadmin.php?halaman=$i'>$i</a></li>"; 
                            }
                        }else {
                            echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                        }
                    }
                    ?>
                </ul>
                <a href="createpengusul.php"><button href="createpengusul.php" type="submit" class="btn btn-inverse "  >[+] Tambahkan Pengusul</button></a>
                </div>
            </div></main>
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