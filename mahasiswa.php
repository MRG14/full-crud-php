<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

//membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('anda tidak memiliki akses');
            document.location.href = 'crud_modal.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';

include 'layouts/header.php';

//menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="form_create_mahasiswa.php" class="btn btn-primary mb-1"><i class='fas fa-plus-circle'></i> Tambahkan</a>

                                    <a href="download-excel-mahasiswa.php" class="btn btn-success mb-1"><i class='fas fa-file-excel'></i> Download Excel</a>

                                    <a href="download-pdf-mahasiswa.php" class="btn btn-danger mb-1"><i class='fas fa-file-pdf'></i> Download PDF</a>

                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Nomor Telepon</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $mahasiswa['nama_mahasiswa']; ?></td>
                                                    <td><?= $mahasiswa['prodi_mahasiswa']; ?></td>
                                                    <td><?= $mahasiswa['jk_mahasiswa']; ?></td>
                                                    <td><?= $mahasiswa['nomor_telepon']; ?></td>
                                                    <td><?= $mahasiswa['email']; ?></td>
                                                    <td width="25%" class="text-center">
                                                        <a href="form_detail_mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                                        <a href="form_update_mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm"><i class='fas fa-edit'></i> Ubah</a>
                                                        <a href="form_delete_mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data barang akan dihapus?')"><i class='fas fa-trash'></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?php include 'layouts/footer.php'; ?>