<?php
require 'config.php';

$jurusan = mysqli_query($db, "SELECT * FROM majors");
$err = '';

if (isset($_POST['create'])) {

    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $majorId = $_POST['majorId'];
    if ($majorId || $gender || $tanggalLahir || $nama === null) {
        $err = "Harap mengisi semua form";
    }

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "public/images/" . $foto);

    $post = mysqli_query($db, "INSERT INTO students (nama, gender, tanggalLahir, foto, majorId) VALUES ('$nama', '$gender', '$tanggalLahir', '$foto', '$majorId')");
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
    <h3 class="mb-3">Tambah Siswa</h3>
    <form method="post" action="" class="d-flex justify-content-between" enctype="multipart/form-data">
        <div class="col-6">
            <label for="nama">Nama</label>
            <input class="form-control my-2" name="nama" id="nama" placeholder="Nama..." />
            <label>Gender</label>
            <div class="my-2 p-2 ">
                <label class="form-check-label" for="lk">
                    Laki-Laki
                </label>
                <input type="radio" class="form-chech-input" id="lk" name="gender" value="Laki-Laki" />
                <label class="form-check-label" for="pr" style="margin-left: 20px;">
                    Perempuan
                </label>
                <input type="radio" class="form-chech-input" id="pr" name="gender" value="Perempuan" />
            </div>
            <label for="tgl">Tempat, Tanggal Lahir</label>
            <input class="form-control my-2" name="tanggalLahir" id="tgl" />
            <label for="jurusan">Jurusan</label>
            <select name="majorId" id="jurusan" class="form-select my-2">
                <option value="">Pilih Jurusan</option>
                <?php
                while ($data = mysqli_fetch_array($jurusan)) {
                ?>
                    <option value="<?php echo $data['majorId'] ?>"><?php echo $data['majorName'] ?></option>

                <?php
                }
                ?>
            </select>
            <button name="create" class="btn btn-primary my-3">
                Tambah
            </button>
        </div>
        <div class="text-end ">
            <label for="foto">Foto</label>
            <input type="file" class="form-control my-3" name="foto" id="foto" />
        </div>
    </form>
</div>