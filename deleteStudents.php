<?php
require 'config.php';

$nis = isset($_GET['nis']) ? ($_GET['nis']) : false;

$delete = mysqli_query($db, "DELETE FROM students WHERE nis = '$nis'");
header("location:dashboard.php?page=siswa");
