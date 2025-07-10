<?php 
    include 'config/app.php';
    //$data_barang = select("SELECT * FROM barang");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title><?= $title; ?></title>
</head>

<body>
    <!--Navbar Start-->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Crud PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <?php if($_SESSION['level'] == 1 or $_SESSION['level'] == 2) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php"><i class="fas fa-archive"></i> Barang</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($_SESSION['level'] == 1 or $_SESSION['level'] == 3) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="mahasiswa.php"><i class="fas fa-users"></i> Mahasiswa</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link" href="crud_modal.php"><i class="fas fa-user-circle"></i> Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" onclick="return confirm('Yakin Kamu mau keluar?')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <a class="navbar-brand" href="#"><?=  $_SESSION['nama']; ?></a>
                </div>
            </div>
        </nav>
    </div>
    <!--NavbarEnd-->