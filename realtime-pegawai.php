<?php

include 'config/app.php';

$data_pegawai = select("SELECT * FROM pegawai ORDER BY id_pegawai DESC");
?>

<?php $no = 1; ?>
<?php foreach ($data_pegawai as $pegawai) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $pegawai['nama_pegawai']; ?></td>
        <td><?= $pegawai['jabatan']; ?></td>
        <td><?= $pegawai['email']; ?></td>
        <td><?= $pegawai['nomor_telepon']; ?></td>
        <td><?= $pegawai['alamat']; ?></td>
    </tr>
<?php endforeach; ?>