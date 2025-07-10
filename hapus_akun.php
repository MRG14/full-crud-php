<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('anda diharuskan login terlebih dulu');
          document.location.href = 'login.php';
        </script>";
  exit;   
}
$title = 'Hapus akun';

include 'config/app.php';

//menerima id barang yang dipilih oleh pengguna
$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0) {
    echo "<script>
            alert('Data Akun Berhasil Dihapus');
            document.location.href = 'crud_modal.php'; 
          </script>";
} else {
    echo "<script>
            alert('Data Akun Gagal Dihapus');
            document.location.href = 'crud_modal.php';
          </script>";
}