<?php
session_start();

$nama_user = $_SESSION["username"];

require 'function.php';
//cek sudah ditekan apa belum
if (isset($_POST["submit"])) {
    //cek apakah berhasil atau tidak
    if (tambah($_POST) > 0) {
        ?>
        <div class="alert alert-success" role="alert">
            Data berhasil ditambahkan
        </div>
        <?php
        header("refresh:3;url=daftarberita.php");
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Data gagal ditambahkan
        </div>
        <?php
        header("refresh:3;url=daftarberita.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Berita</title>
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
                    <p class="fw-bolder mt-3">Tambah Berita</p>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="nama_user" id="nama_user" autocomplete="off"
                        value="<?= $nama_user; ?>">
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" name="pengirim" id="pengirim" required
                            autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" required
                            autocomplete="off"><small id="emailHelp" class="form-text text-muted">YYYY/MM/DD</small>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Pilih Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="isi" name="isi" style="height: 150px"></textarea>
                        <label for="isi">Isi Berita</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Upload Berita</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>