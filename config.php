<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "dbschool";

$db = mysqli_connect($host, $user, $password, $dbName);

if (!$db) {
    die("not connected");
}
