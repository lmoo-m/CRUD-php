<?php
require 'config.php';

$id = isset($_GET['id']) ? ($_GET['id']) : false;

$delete = mysqli_query($db, "DELETE FROM majors WHERE majorId = '$id'");
header("location:dashboard.php?page=jurusan");
