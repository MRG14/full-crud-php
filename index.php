<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}
if ($_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "<script>
            alert('Anda tidak memiliki akses');
            document.location.href = 'crud_modal.php';
          </script>";
    exit;
}

$title = 'Data Barang';
include 'layouts/header.php';

// Pagination dan filter
$jumlahDataPerhalaman = 5;
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

if (isset($_POST['filter'])) {
    $tgl_awal  = strip_tags($_POST['tgl_awal'] . " 00:00:00");
    $tgl_akhir = strip_tags($_POST['tgl_akhir'] . " 23:59:59");
    $data_barang = select("SELECT * FROM barang WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_barang DESC");
    $jumlahData = count($data_barang);
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
} else {
    $jumlahData = count(select("SELECT * FROM barang"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    $data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC LIMIT $awalData, $jumlahDataPerhalaman");
}

// Data untuk grafik garis
$dataChart = select("SELECT nama_barang, jumlah_barang FROM barang ORDER BY id_barang DESC LIMIT 10");
$namaBarang = [];
$jumlahBarang = [];

foreach ($dataChart as $item) {
    $namaBarang[] = $item['nama_barang'];
    $jumlahBarang[] = $item['jumlah_barang'];
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><i class="fas fa-box"></i> Data Barang</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title m-0">Grafik Batang</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" height="100"></canvas>
                    </div>
                </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Barang</h3>
                    <div>
                        <a href="form_create_barang.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambahkan</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFilter"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabel -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Barcode</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_barang as $barang) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= $barang['jumlah_barang']; ?></td>
                                    <td>Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <img src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true" alt="barcode">
                                    </td>
                                    <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
                                    <td class="text-center">
                                        <a href="form_update_barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="form_delete_barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3 d-flex justify-content-end">
                        <nav>
                            <ul class="pagination">
                                <?php if ($halamanAktif > 1) : ?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a></li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                    <li class="page-item <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Filter -->
        <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="" method="post" class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title">Filter Data</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tgl_awal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="filter" class="btn btn-success">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include 'layouts/footer.php'; ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const namaBarang = <?= json_encode($namaBarang); ?>;
    const jumlahBarang = <?= json_encode($jumlahBarang); ?>;

    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: namaBarang,
            datasets: [{
                label: 'Jumlah Barang',
                data: jumlahBarang,
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: true,
                tension: 0.4, // untuk melengkungkan garis
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
