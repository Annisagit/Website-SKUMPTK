<?php
    require_once "koneksi.php";

    $id = $_GET['id'];

    //query hapus
    $sql = "UPDATE pengusul SET username='', password=''  WHERE id = $id";
    $querydelete = mysqli_query($conn, $sql);

    if ($querydelete) {
        # redirect ke index.php
        echo "Data berhasil dihapus";
        header('Location: listuseradmin.php');

    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($conn);
    }

    mysqli_close($conn);



?>