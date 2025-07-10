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

require __DIR__.'/vendor/autoload.php';
require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

$data_mahasiswa = select("SELECT * FROM mahasiswa");

$content .= '<style type="text/css">
                .gambar {
                    width: 50px;
                }
             </style>';

$content .= '
<page>
    <table border="1" align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Jenis Kelamin</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';

        $no=1;
        foreach ($data_mahasiswa as $mahasiswa) {
            $content .= '
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$mahasiswa['nama_mahasiswa'].'</td>
                    <td>'.$mahasiswa['prodi_mahasiswa'].'</td>
                    <td>'.$mahasiswa['jk_mahasiswa'].'</td>
                    <td>'.$mahasiswa['nomor_telepon'].'</td>
                    <td>'.$mahasiswa['email'].'</td>
                    <td><img src="assets/images/'.$mahasiswa['foto'].'" class="gambar"></td>
                </tr>
            ';
        }
$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('Laporan-Mahasiswa.pdf');