<?php

require 'helper.php';
require 'config.php';

$err = "";

$id = isset($_GET['id']) ? ($_GET['id']) : false;

$major = mysqli_query($db, "SELECT * FROM majors WHERE majorId = '$id'");
$ress = mysqli_fetch_array($major);

if (isset($_POST['edit'])) {
    $majorName = $_POST['majorName'];
    if ($majorName == '') {
        $err = "Harap mengisi semua form";
    } else {
        $query = mysqli_query($db, "UPDATE majors SET majorName = '$majorName' WHERE majorId = '$id'");
        header('location:dashboard.php?page=jurusan');
    }
}

?>


<div style="height: 80vh;" class="d-flex align-items-center justify-content-center">


    <div class="bg-dark container p-5 text-light rounded shadow" style="width: 60%;">
        <?php
        if ($err) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $err ?>
            </div>
        <?php
        }
        ?>

        <h3>Tambah Jurusan</h3>
        <form method="post" action="">
            <label for="majorName" class="my-2">Nama Jurusan</label>
            <input class="form-control my-3" id="majorName" value="<?php echo $ress['majorName'] ?>" name="majorName" placeholder="ketik disini..." />
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?php echo $base_url ?>dashboard.php?page=jurusan" class="btn btn-info">Kembali</a>
                <button class="btn btn-primary my-3" name="edit">Tambah</button>
            </div>
        </form>
    </div>
</div>