<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
require 'function.php';
$tb_berita = query("SELECT * FROM tb_berita WHERE nama_user = '$username'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .footer h4 {
            margin-bottom: 10px;
        }

        .footer p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container-md shadow">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="./img/senopati.png" alt="">
                </a>
                <form class="d-flex">
                    <a class="btn btn-danger" href="logout.php" role="button"><i
                            class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </form>

            </div>
        </nav>
        <!-- navbar -->

        <!-- header -->
        <h3 class="mt-3">Hallo,
            <?= $_SESSION['username']; ?>👋
        </h3>
        <!-- header -->

        <!-- tabel read -->
        <div class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <div class="navbar-brand">Daftar berita yang anda tulis</div>
                <a class="btn btn-primary" href="create.php" role="button"><i class="fa-solid fa-upload"></i> Upload
                    Berita</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengirim</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tb_berita as $row): ?>
                        <tr>
                            <td>
                                <?= $i; ?>
                            </td>
                            <td>
                                <?= $row["judul"]; ?>
                            </td>
                            <td>
                                <?= $row["pengirim"]; ?>
                            </td>
                            <td>
                                <?= $row["tanggal"]; ?>
                            </td>
                            <td>
                                <a href="update.php?idberita=<?= $row["idberita"]; ?>">
                                    <button type="button" class="btn btn-warning"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                </a>
                                <a href="delete.php?idberita=<?= $row["idberita"]; ?>"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- tabel read -->



        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h4>Tentang Kami</h4>
                        <p>Senopati News adalah sumber berita terpercaya yang menyediakan informasi
                            terkini dari berbagai bidang seperti politik, bisnis, olahraga, teknologi, dan hiburan.</p>
                    </div>
                    <div class="col-lg-4">
                        <h4>Alamat</h4>
                        <p>Jalan Penatusan No. 17 Binangun, Cilacap</p>
                    </div>
                    <div class="col-lg-4">
                        <h4>Kontak</h4>
                        <p>Email: vfsyah@gmail.com</p>
                        <p>Telepon: +6281225661530</p>
                    </div>
                </div>
            </div>
            <div class="text-center p-3">Copyright 2023 &copy;, <img src="./img/senopati.png" alt="senopati"
                    width="100" />
            </div>
        </footer>
        <!-- footer -->
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>