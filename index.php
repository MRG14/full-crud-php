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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-box"></i> Data Barang</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="form_create_barang.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambahkan</a>
                                    <table id="table" class="table table-bordered table-striped" style="margin-bottom: 2px;">
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