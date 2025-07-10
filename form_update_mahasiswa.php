<?php
session_start();
    if (!isset($_SESSION["login"])) {
        echo "<script>
                alert('anda diharuskan login terlebih dulu');
                document.location.href = 'login.php';
            </script>";
        exit;   
    }

    $title = 'Ubah Mahasiswa';

    include 'layouts/header.php';

    $id_mahasiswa = (int)$_GET['id_mahasiswa'];

    // Query data mahasiswa dengan pengecekan
    $mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

    if (isset($_POST['ubah'])) {
        if (update_mahasiswa($_POST) > 0) {
            echo "<script>
                    alert('Data Mahasiswa Berhasil DiUbah');
                    document.location.href = 'mahasiswa.php'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Data Mahasiswa Gagal DiUbah');
                    document.location.href = 'mahasiswa.php';
                  </script>";
        }
    }
?>

<div class="container mt-5">
    <h1>Ubah Data Mahasiswa</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="hidden" name="fotolama" value="<?= $mahasiswa['foto']; ?>">

        <div class="mb-3">
            <label for="">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Masukan nama Mahasiswa" value="<?= $mahasiswa['nama_mahasiswa']; ?>" required>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="" class="form-label">Program Studi</label>
                <select name="prodi_mahasiswa" id="prodi_mahasiswa" class="form-control">
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="Teknik Informatika" <?= $mahasiswa['prodi_mahasiswa'] == 'Teknik Informatika' ? 'selected' : null ?> >Teknik Informatika</option>
                    <option value="Teknik Mesin" <?= $mahasiswa['prodi_mahasiswa'] == 'Teknik Mesin' ? 'selected' : null ?> >Teknik Mesin</option>
                    <option value="Teknik Listrik" <?= $mahasiswa['prodi_mahasiswa'] == 'Teknik Listrik' ? 'selected' : null ?> >Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="" class="form-label">Jenis Kelamin</label>
                <select name="jk_mahasiswa" id="jk_mahasiswa" class="form-control">
                    <option value="">-- Pilih jenis kelamin --</option>
                    <option value="laki-laki" <?= $mahasiswa['jk_mahasiswa'] == 'laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="perempuan" <?= $mahasiswa['jk_mahasiswa'] == 'perempuan' ? 'selected' : null ?>>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukan Nomor Telepon" value="<?= $mahasiswa['nomor_telepon']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="">Alamat</label>
            <textarea name="alamat1" id="alamat"><?= $mahasiswa['alamat']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" value="<?= $mahasiswa['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
            <p>
                <small>Gambar sebelumnya</small>
                <img src="assets/images/<?= $mahasiswa['foto']; ?>" alt="foto" width="100px">
            </p>
        </div>
        <button type="submit" name="ubah" class="btn btn-success" style="float: right;">Ubah</button>
    </form>
</div>

<?php include 'layouts/footer.php'; ?>