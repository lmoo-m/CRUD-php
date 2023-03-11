<?php

require_once('helper.php');

$page = isset($_GET['page'])  ? ($_GET['page']) : false;

session_start();
if ($_SESSION['id'] == null) {
    header("location:login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>
    <nav class="nav navbar-dark bg-dark p-4 d-flex align-items-center px-5 justify-content-between">
        <div class="d-flex">
            <a class="navbar-brand " href="<?php echo $base_url ?>dashboard.php">
                Dashboard Admin </a>
            <div class="navbar-nav mx-4 ">
                <a class="nav-link " style="cursor: pointer;" href="<?php echo $base_url ?>dashboard.php?page=jurusan">Jurusan</a>
            </div>
            <div class="navbar-nav mx-2 ">
                <a class="nav-link " style="cursor: pointer;" href="<?php echo $base_url ?>dashboard.php?page=siswa">Siswa</a>
            </div>
        </div>
        <div class="navbar-nav">
            <a href="logout.php" class="nav-link">Logout</a>
        </div>
    </nav>

    <div class="container mt-3">
        <?php
        $filename = "$page.php";

        if (file_exists($filename)) {
            include_once($filename);
        } else {
        ?>
            <h1>pp</h1>
        <?php
        }
        ?>
    </div>
</body>

</html>