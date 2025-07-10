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

$title = 'Daftar Pegawai';

include 'layouts/header.php';

//menampilkan data pegawai
$data_pegawai = select("SELECT * FROM pegawai ORDER BY id_pegawai DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data pegawai</h1>
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

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Email</th>
                                                <th>Nomor Telepon</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="live_data">

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
    </section>
</div>

<script>
    $('document').ready(function () {
        setInterval(function () {
            getPegawai()
        }, 200) //request per detik
    });
    
    function getPegawai() {
        $.ajax({
            url: "realtime-pegawai.php",
            type: "GET",
            success: function (response) {
                $('#live_data').html(response)
            }
        });
    }
</script>

<?php include 'layouts/footer.php'; ?>