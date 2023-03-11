<?php
require 'config.php';
require 'helper.php';

$i = 1;
$siswa = mysqli_query($db, "SELECT students.*, majors.* FROM students INNER JOIN majors ON students.majorId = majors.majorId");
?>

<div>
    <div>
        <h3>
            Data Siswa
        </h3>
        <a class="btn btn-primary" href="dashboard.php?page=tambah">
            Tambah
        </a>
    </div>
    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>Foto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_array($siswa)) {
            ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['tanggalLahir'] ?></td>
                    <td><?php echo $data['majorName'] ?></td>
                    <td class="d-flex justify-content-center align-items-center"><img src="public/images/<?php echo $data['foto'] ?>" width="50" /></td>
                    <td>
                        <a class="btn btn-warning" href="<?php echo $base_url ?>dashboard.php?page=editSiswa&nis=<?php echo $data['nis'] ?>">Edit</a>
                        <a class="btn btn-danger" href="<?php echo $base_url ?>deleteStudents.php?nis=<?php echo $data['nis'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>