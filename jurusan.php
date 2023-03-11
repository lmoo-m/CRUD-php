<?php
require 'config.php';
require 'helper.php';

$i = 1;

$jurusan = mysqli_query($db, 'SELECT * FROM majors');


$err = "";

if (isset($_POST['create'])) {
    $majorName = $_POST['majorName'];
    if ($majorName == '') {
        $err = "Harap mengisi semua form";
    } else {
        $query = mysqli_query($db, "INSERT INTO majors (majorName) VALUES ('$majorName')");
        header('location:dashboard.php?page=jurusan');
    }
}
?>


<div>
    <div class="d-flex justify-content-between">
        <h3>
            Data Jurusan
        </h3>
        <form method="post" action="" class="d-flex">
            <input class="form-control my-3" id="majorName" name="majorName" placeholder="ketik disini..." />
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-primary my-3" name="create">Tambah</button>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <table class="table table-bordered table-hover ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jurusan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($jurusan)) {
                    $majorName = $data['majorName'];
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $majorName ?></td>
                        <td>
                            <a href="<?php echo $base_url ?>dashboard.php?page=edit&id=<?php echo $data['majorId'] ?>">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                            <a href="<?php echo $base_url ?>delete.php?id=<?php echo $data['majorId'] ?>">
                                <button class="btn btn-danger">Hapus</button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>