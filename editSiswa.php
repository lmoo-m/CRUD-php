<?php
require 'config.php';

$jurusan = mysqli_query($db, "SELECT * FROM majors");
$err = '';

$nis = isset($_GET['nis']) ? ($_GET['nis']) : false;

$siswa = mysqli_query($db, "SELECT students.*, majors.* FROM students INNER JOIN majors ON students.majorId = majors.majorId  WHERE nis = '$nis'");
$res = mysqli_fetch_array($siswa);

if (isset($_POST['edit'])) {

    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $majorId = $_POST['majorId'];
    if ($majorId || $gender || $tanggalLahir || $nama === null) {
        $err = "Harap mengisi semua form";
    }

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($foto == null) {
        $foto = $res['foto'];
    } else {
        move_uploaded_file($tmp, "public/images/" . $foto);
    }

    $post = mysqli_query($db, "UPDATE students SET nama = '$nama', gender = '$gender',  tanggalLahir = '$tanggalLahir', foto = '$foto',majorId = '$majorId' WHERE nis = '$nis'");
    header("location:dashboard.php?page=siswa");
}
?>

<div class="container shadow p-3 mt-4 rounded">
    <?php
    if ($err) {
    ?>
        <div class="alert alert-danger"><?php echo $err ?></div>
    <?php
    }
    ?>
    <h3 class="mb-3">Edit Siswa</h3>
    <form method="post" action="" class="d-flex justify-content-between" enctype="multipart/form-data">
        <div class="col-6">
            <label for="nama">Nama</label>
            <input class="form-control my-2" name="nama" id="nama" placeholder="Nama..." value="<?php echo $res['nama'] ?>" />
            <label>Gender (<?php echo $res['gender'] ?>)</label>
            <div class="my-2 p-2 ">
                <label class="form-check-label" for="lk">
                    Laki-Laki
                </label>
                <input type="radio" class="form-chech-input" id="lk" name="gender" value="Laki-Laki" <?php
                                                                                                        if ($res['gender'] == 'Laki-Laki') {
                                                                                                        ?> checked <?php
                                                                                                                }
                                                                                                                    ?> />
                <label class="form-check-label" for="pr" style="margin-left: 20px;">
                    Perempuan
                </label>
                <input type="radio" class="form-chech-input" id="pr" name="gender" value="Perempuan" <?php
                                                                                                        if ($res['gender'] == 'Perempuan') {
                                                                                                        ?> checked <?php
                                                                                                                }
                                                                                                                    ?> />
            </div>
            <label for="tgl">Tempat, Tanggal Lahir</label>
            <input class="form-control my-2" name="tanggalLahir" id="tgl" value="<?php echo $res['tanggalLahir'] ?>" />
            <label for="jurusan">Jurusan</label>
            <select name="majorId" id="jurusan" class="form-select my-2">
                <option value="<?php echo $res['majorId'] ?>"><?php echo $res['majorName'] ?></option>
                <?php
                while ($data = mysqli_fetch_array($jurusan)) {
                ?>
                    <option value="<?php echo $data['majorId'] ?>"><?php echo $data['majorName'] ?></option>

                <?php
                }
                ?>
            </select>
            <button name="edit" class="btn btn-primary my-3">
                Tambah
            </button>
        </div>
        <div class="text-end">
            <label for="foto">Foto</label>
            <label for="foto">
                <img src="public/images/<?php echo $res['foto'] ?>" />
            </label>
            <input type="file" class="form-control my-3" name="foto" id="foto" />
        </div>
    </form>
</div>