<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;   
}

$title = 'Detail Mahasiswa';

include 'layouts/header.php';

//mengambil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

//menampilkan data mahasiswa
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

?>

<div class="container mt-5">
    <h1>Data <?= $mahasiswa['nama_mahasiswa']; ?></h1>
    <hr>
    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td>Nama</td>
            <td>: <?= $mahasiswa['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $mahasiswa['prodi_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $mahasiswa['jk_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>: <?= $mahasiswa['nomor_telepon'] ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $mahasiswa['alamat'] ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?= $mahasiswa['email'] ?></td>
        </tr>
        <tr>
            <td width="50%">Foto</td>
            <td>
                <a href="assets/images/<?= $mahasiswa['foto']; ?>">
                    <img src="assets/images/<?= $mahasiswa['foto']; ?>" alt="foto" style="width: 50%;">
                </a>
            </td>
        </tr>
    </table>

    <a href="mahasiswa.php" class="btn btn-warning btn-sm" style="float: right;">Kembali</a>
</div>

<?php include 'layouts/footer.php'; ?>