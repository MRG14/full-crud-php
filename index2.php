<?php 
session_start();
//membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;   
}

//membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('anda tidak memiliki akses');
            document.location.href = 'crud_modal.php';
          </script>";
    exit;   
}

$title = 'Data Barang';
include 'layouts/header.php'; 

$data_barang = select("SELECT * FROM barang ORDER BY id_barang ASC");
?>

<div class="container mt-5">
    <h1><i class="fas fa-archive"></i> Data Barang</h1>
    <hr>
    <a href="form_create_barang.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambahkan</a>
    <table class="table table-bordered table-striped" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga </th>
                <th>Barcode</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data_barang as $barang) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang['nama_barang']; ?></td>
                    <td><?= $barang['jumlah_barang']; ?></td>
                    <td>Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <img src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true" alt="barcode">
                    </td>
                    <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
                    <td widht="15%" class="text-center">
                        <a href="form_update_barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class='fas fa-edit'></i> Edit</a>
                        <a href="form_delete_barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin data barang akan dihapus?')"><i class='fas fa-trash'></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layouts/footer.php'; ?>