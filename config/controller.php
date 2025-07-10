<?php

//fungsi untuk index. Mengambil data barang dalam database
function select($query) {
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//fungsi tambah barang
function create_barang($post) {
    global $db;

    $nama = strip_tags($post['nama_barang']);
    $jumlah = strip_tags($post['jumlah_barang']);
    $harga = strip_tags($post['harga_barang']);
    $barcode = rand(100000, 999999);

    //query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi untuk Update Barang
function update_barang($post) {

    global $db;

    $id_barang = $post['id_barang'];
    $nama = $post['nama_barang'];
    $jumlah = $post['jumlah_barang'];
    $harga = $post['harga_barang'];

    //query sql untuk update data
    $query = "UPDATE barang SET nama_barang = '$nama', jumlah_barang = '$jumlah', harga_barang = '$harga' WHERE id_barang = $id_barang ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi untuk menghapus barang
function delete_barang($id_barang) {

    global $db;

    //query sql uuntuk menghapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambahkan mahasiswa
function create_mahasiswa($post) {
    global $db;

    $nama = $post['nama_mahasiswa'];
    $prodi = $post['prodi_mahasiswa'];
    $jk = $post['jk_mahasiswa'];
    $telepon = $post['nomor_telepon'];
    $alamat = $post['alamat'];
    $email = $post['email'];
    $foto = upload_file();

    //cek upload file
    if (!$foto) {
        return false;
    }

    //query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk', '$telepon', '$alamat', '$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi upload file foto mahasiswa
function upload_file() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    //cek file yg diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //cek format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        //pesan gagal
        echo "<script>
                alert('Format file tidak valid');
                document.location.href = 'form_create_mahasiswa.php'; 
              </script>";
        die();
    }

    if ($ukuranFile > 2048000) {
        //pesan gagal
        echo "<script>
                alert('Ukuran file terlalu besar');
                document.location.href = 'form_create_mahasiswa.php'; 
              </script>";
        die();
    }

    //generate nama file
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets/images/'. $namaFileBaru);
    return $namaFileBaru;
}

//update mahasiswa
function update_mahasiswa($post) {
    global $db;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama = strip_tags($post['nama_mahasiswa']);
    $prodi = strip_tags($post['prodi_mahasiswa']);
    $jk = strip_tags($post['jk_mahasiswa']);
    $telepon = strip_tags($post['nomor_telepon']);
    $alamat = strip_tags($post['alamat']);
    $email = strip_tags($post['email']);
    $fotolama = strip_tags($post['fotolama']);

    //cek upload file
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    //query tambah data
    $query = "UPDATE mahasiswa SET nama_mahasiswa = '$nama', prodi_mahasiswa = '$prodi', jk_mahasiswa = '$jk', nomor_telepon = '$telepon', email = '$email', alamat = '$alamat', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//Hapus data mahasiswa
function delete_mahasiswa($id_mahasiswa) {

    global $db;

    //ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/images/". $foto['foto']);

    //query sql uuntuk menghapus data barang
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function create_akun($post) {
    global $db;

    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_akun($post) {
    global $db;

    $id_akun = strip_tags($post['id_akun']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_akun($id_akun) {

    global $db;

    //query sql uuntuk menghapus data barang
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}