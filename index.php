<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "dbschool";

$db = mysqli_connect($host, $user, $password, $dbName);

$no = 1;

session_start();
if ($_SESSION['id'] == null) {
    header("location:login.php");
    exit;
}



$getMajors = mysqli_query($db, 'select * from majors');

if (isset($_POST['submit'])) {
    $majorName = $_POST['majorName'];
    $create = mysqli_query($db, "insert into majors (majorName) values ('$majorName')");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container mt-3">
        <div class="d-flex justify-content-between my-4">
            <h3>Jurusan</h3>
            <form action=" " method="post" class="d-flex">
                <input class="form-control" name="majorName" placeholder="Nama Jurusan" />
                <button class="btn btn-primary" name="submit" type="submit">Tambah</button>
            </form>
        </div>
        <table class=" table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_array($getMajors)) {
                    $majorName = $data['majorName'];

                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $majorName ?></td>
                        <td>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>

                <?php
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>