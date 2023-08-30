<?php
    require_once "koneksi.php";

    if(isset($_POST['bsimpan'])){
        $id = $_GET['id'];
        $sql = "UPDATE pengusul SET submit_status = '$_POST[submit_status]' WHERE id = $id";
        $edit = mysqli_query($conn, $sql);

        if ($edit){
            header('Location: listusulanadmin.php');
        } 
    }

?>