<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
        echo "<script>
                alert('anda diharuskan login terlebih dulu');
                document.location.href = 'login.php';
            </script>";
        exit;   
    }

    $title = 'Ubah Barang';

    include 'layouts/header.php';

    $id_barang = (int)$_GET['id_barang'];

    $barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

    if (isset($_POST['ubah'])) {
        if (update_barang($_POST) > 0) {
            echo "<script>
                    alert('Data Barang Berhasil Diubah');
                    document.location.href = 'index.php'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Data Barang Gagal Diubah');
                    document.location.href = 'index.php';
                  </script>";
        }
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <h1>Update Barang</h1>
        <hr>
        <form action="" method="post">

            <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">

            <div class="mb-3">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang']; ?>" placeholder="Masukan nama barang" required>
            </div>
            <div class="mb-3">
                <label for="">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?= $barang['jumlah_barang']; ?>" placeholder="Masukan jumlah barang" required>
            </div>
            <div class="mb-3">
                <label for="">Harga Barang</label>
                <input type="number" class="form-control" id="harga_barang" name="harga_barang" value="<?= $barang['harga_barang']; ?>" placeholder="Masukan jumlah barang" required>
            </div>
            <button type="submit" name="ubah" class="btn btn-success" style="float: right;">Ubah</button>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>