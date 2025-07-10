<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;   
}

    $title = 'Tambah Mahasiswa';

    include 'layouts/header.php'; 
    if (isset($_POST['tambah'])) {
        if (create_mahasiswa($_POST) > 0) {
            echo "<script>
                    alert('Data Mahasiswa Berhasil Ditambahkan');
                    document.location.href = 'mahasiswa.php'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Data Mahasiswa Gagal Ditambahkan');
                    document.location.href = 'mahasiswa.php';
                  </script>";
        }
    }
?>

<div class="container mt-5">
    <h1>Tambah Data Mahasiswa</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Masukan nama Mahasiswa" required>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="" class="form-label">Program Studi</label>
                <select name="prodi_mahasiswa" id="prodi_mahasiswa" class="form-control">
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Listrik">Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="" class="form-label">Jenis Kelamin</label>
                <select name="jk_mahasiswa" id="jk_mahasiswa" class="form-control">
                    <option value="">-- Pilih jenis kelamin --</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukan Nomor Telepon" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat"></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" onchange="previewimg()">

            <img src="assets/images/<?= $mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview" width="100px">
        </div>
        <button type="submit" name="tambah" class="btn btn-success" style="float: right;">Tambahkan</button>
    </form>
</div>

<script>
    function previewimg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layouts/footer.php'; ?>