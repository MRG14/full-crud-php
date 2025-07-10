<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('anda diharuskan login terlebih dulu');
          document.location.href = 'login.php';
        </script>";
  exit;   
}

$title = 'Hapus Barang';

include 'config/app.php';

//menerima id barang yang dipilih oleh pengguna
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

if (delete_mahasiswa($id_mahasiswa) > 0) {
    echo "<script>
            alert('Data Mahasiswa Berhasil Dihapus');
            document.location.href = 'mahasiswa.php'; 
          </script>";
} else {
    echo "<script>
            alert('Data Mahasiswa Gagal Dihapus');
            document.location.href = 'mahasiswa.php';
          </script>";
}
