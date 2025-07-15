<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('anda tidak memiliki akses');
            document.location.href = 'crud_modal.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';
include 'layouts/header.php';

// Menampilkan semua data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

// Menampilkan data untuk grafik batang (jumlah mahasiswa per prodi)
$data_prodi = select("SELECT prodi_mahasiswa AS prodi, COUNT(*) AS jumlah FROM mahasiswa GROUP BY prodi_mahasiswa");

$labels = [];
$jumlah = [];

foreach ($data_prodi as $row) {
    $labels[] = $row['prodi'];
    $jumlah[] = $row['jumlah'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Grafik Batang -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title m-0">Grafik Jumlah Mahasiswa per Prodi</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartMahasiswa" height="100"></canvas>
                </div>
            </div>

            <!-- Tabel Data Mahasiswa -->
            <div class="card">
                <div class="card-body">
                    <a href="form_create_mahasiswa.php" class="btn btn-primary mb-2"><i class='fas fa-plus-circle'></i> Tambahkan</a>
                    <a href="download-excel-mahasiswa.php" class="btn btn-success mb-2"><i class='fas fa-file-excel'></i> Download Excel</a>
                    <a href="download-pdf-mahasiswa.php" class="btn btn-danger mb-2"><i class='fas fa-file-pdf'></i> Download PDF</a>

                    <table id="serverside" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_mahasiswa as $mhs) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $mhs['nama_mahasiswa']; ?></td>
                                    <td><?= $mhs['prodi_mahasiswa']; ?></td>
                                    <td><?= $mhs['jk_mahasiswa']; ?></td>
                                    <td><?= $mhs['nomor_telepon']; ?></td>
                                    <td>
                                        <a href="form_update_mahasiswa.php?id_mahasiswa=<?= $mhs['id_mahasiswa']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="form_delete_mahasiswa.php?id_mahasiswa=<?= $mhs['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layouts/footer.php'; ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxBar = document.getElementById('barChartMahasiswa').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: <?= json_encode($jumlah); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
