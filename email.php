<?php 
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('anda diharuskan login terlebih dulu');
            document.location.href = 'login.php';
          </script>";
    exit;   
}

    $title = 'Kirim Email';

    include 'layouts/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-envelope"></i> Kirim Email</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- main content-->
    <section class="content">
        <div class="container-fluid">
        <form action="" method="post">
            <div class="mb-3">
                <label for="">Email Penerima</label>
                <input type="text" class="form-control" id="email_penerima" name="emai_penerima" placeholder="Masukan email penerima..." required>
            </div>
            <div class="mb-3">
                <label for="">Subject</label>
                <input type="number" class="form-control" id="subject" name="subject" placeholder="Masukan subject..." required>
            </div>
            <div class="mb-3">
                <label for="">Pesan</label>
                <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" name="tambah" class="btn btn-success" style="float: right;">Kirim</button>
        </form>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<?php include 'layouts/footer.php'; ?>