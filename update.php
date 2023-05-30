<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'function.php';
$id = $_GET["idberita"];

$berita = query("SELECT * FROM tb_berita WHERE idberita = $id")[0];

//cek sudah ditekan apa belum
if (isset($_POST["submit"])) {
    //cek apakah berhasil atau tidak
    if (update($_POST) > 0) {
        ?>
        <div class="alert alert-primary" role="alert">
            Data berhasil diupdate
        </div>
        <?php
        header("refresh:3;url=index.php");
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Data gagal diupdate
        </div>
        <?php
        header("refresh:3;url=index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 500px
        }

        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card shadow">
            <div class="text-dark">
                <div class="d-flex justify-content-center">
                    <p class="fw-bolder mt-3">Update Berita</p>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="idberita" id="idberita" required autocomplete="off"
                        value="<?= $berita["idberita"]; ?>">
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" name="pengirim" id="pengirim" required
                            autocomplete="off" value="<?= $berita["pengirim"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" required autocomplete="off"
                            value="<?= $berita["judul"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" required autocomplete="off"
                            value="<?= $berita["tanggal"]; ?>"><small id="emailHelp"
                            class="form-text text-muted">YYYY/MM/DD</small>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="isi" name="isi"
                            style="height: 150px"><?= $berita["isi"]; ?></textarea>
                        <label for="isi">Isi Berita</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update Berita</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>