<?php
//inisialisasi session
include('koneksi.php');
session_start();

//mengecek username pada session
if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = 'anda harus login untuk mengekses halaman ini';
    header('Location: loginadmin.php');
}

$terkirim = mysqli_query($conn, "SELECT submit_status FROM pengusul WHERE submit_status = 'Terkirim' ");

$diterima = mysqli_query($conn, "SELECT submit_status FROM pengusul WHERE submit_status = 'Diterima' ");

$ditolak = mysqli_query($conn, "SELECT submit_status FROM pengusul WHERE submit_status = 'Ditolak' ");
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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

        <div class="px-4 py-5">
        <h3 class="pb-2 border-bottom">Grafik Status Pengajuan</h3>

        <div class="container col-lg-8 my-5">
            <canvas id="myChart" ></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                // tipe chart
                type: 'bar',
                data: {
                    labels: ['Terkirim', 'Diterima', 'Ditolak'],
                    datasets: [{
                            label: 'Grafik Status Pengajuan',
                            data: [
                                <?php echo mysqli_num_rows($terkirim); ?>,
                                <?php echo mysqli_num_rows($diterima);?>,
                                <?php echo mysqli_num_rows($ditolak);?>,
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>

</div>
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