<?php
require 'function.php';

//pagination
//konfigurasi
$jumlahPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM tb_berita"));
$jumlahHalaman = ceil($jumlahData / $jumlahPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;


$awalData = ($jumlahPerHalaman * $halamanAktif) - $jumlahPerHalaman;


$tb_berita = query("SELECT * FROM tb_berita LIMIT $awalData, $jumlahPerHalaman");


$berita = query("SELECT * FROM tb_berita ORDER BY RAND() LIMIT 4");

$topik = query("SELECT * FROM topik ORDER BY RAND() LIMIT 4");

//tombol cari di klik
if (isset($_POST["cari"])) {
    $tb_berita = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senopati News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .icon:hover {
            background-color: #0000FF;
            opacity: 0.5;
            border-radius: 5px;
        }

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

        .judul:hover {
            color: #0000FF;
            opacity: 0.5;
        }

        .pagination {
            display: inline-block;
            padding: 8px;
        }

        .page-link {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .page-link.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        ul li:hover {
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="container shadow">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./img/senopati.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Berita
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Internasional</a></li>
                                <li><a class="dropdown-item" href="#">Nasional</a></li>
                                <li><a class="dropdown-item" href="#">Olahraga</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="daftarberita.php" tabindex="-1" aria-disabled="true">Upload
                                Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#footer">Tentang Kami</a>
                        </li>

                    </ul>

                    <!-- cari -->
                    <form class="d-flex" action="" method="post">
                        <input class="form-control me-2" type="search" placeholder="Cari berita..." aria-label="Search"
                            name="keyword" autocomplete="off">
                        <button class="btn btn-outline-secondary" type="submit" name="cari">Cari</button>
                    </form>
                    <!-- cari -->

                </div>
            </div>
        </nav>
        <!-- navbar -->

        <!-- caraousel -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/caraousel.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <!-- caraousel -->

        <!-- home -->
        <div class="mb-3">
            <div class="row">
                <div class="col-md-8">
                    <?php foreach ($tb_berita as $row): ?>
                        <div class="card mb-3 border-0 mt-3 p-2">
                            <h2 class="card-title">
                                <?= $row["judul"]; ?>
                            </h2>
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="p-2 bd-highlight fw-bolder">
                                    <?= $row["pengirim"]; ?>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <?= $row["tanggal"]; ?>
                                </div>
                            </div>
                            <img src="./img/<?= $row["gambar"]; ?>" class="card-img-top" alt="..." style="
                                    height: 400px;
                                    object-fit: cover;
                                    object-position: center;">
                            <div class="card-body">

                                <p class="card-text">
                                    <?= readmore(50, $row["isi"]) ?> <a
                                        href="detailberita.php?idberita=<?= $row["idberita"]; ?>">Baca Selengkapnya</a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- pagination -->
                    <!-- navigasi -->
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
                            <a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                        <?php endfor; ?>
                    </div>
                    <!-- navigasi -->
                    <!-- pagination -->
                </div>

                <!-- topik terkini -->
                <div class="col-md-4">

                    <div class="card mt-3 border-0" style="width: 22.2rem;">
                        <table class="table table-borderless table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Topik Populer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topik as $row): ?>
                                    <tr>
                                        <td>
                                            <a href>
                                                <?= $row["topikterkini"]; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- topik terkini -->

                    <!-- berita rekomendasi -->
                    <h4>Baca artikel lainnya</h4>
                    <?php foreach ($berita as $row): ?>
                        <a class="text-decoration-none text-reset"
                            href="detailberita.php?idberita=<?= $row["idberita"]; ?>">
                            <div class="card shadow" style="width: 22.2rem;">
                                <img src="./img/<?= $row["gambar"]; ?>" class="card-img-top" alt="..." style="
                                                                                    height: 200px;
                                                                                    object-fit: cover;
                                                                                    object-position: center;">
                                <div class="card-body">
                                    <p class="card-text fw-bolder judul">
                                        <?= $row["judul"]; ?>
                                    </p>
                                </div>
                        </a>

                    <?php endforeach; ?>
                </div>
                <!-- berita rekomenadasi -->

                <!-- follow us sosmed -->
                <div class="d-flex justify-content-center mt-3">
                    <div class="card rounded-0 border-0 shadow" style="width: 22rem;">
                        <div class="d-flex flex-row align-items-center p-1 text-dark">
                            <div class="p-2 bd-highlight ">Follow us</div>
                            <div class="icon">
                                <div class="p-2 bd-highlight hover"><i class="fa-brands fa-instagram fa-lg"></i>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="p-2 bd-highlight hover"><i class="fa-brands fa-facebook fa-lg"></i>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="p-2 bd-highlight hover"><i class="fa-brands fa-twitter fa-lg"></i>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="p-2 bd-highlight hover"><i class="fa-brands fa-tiktok fa-lg"></i>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="p-2 bd-highlight hover"><i class="fa-brands fa-youtube fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- follow us sosmed -->
            </div>
        </div>
    </div>
    </div>
    <!-- home -->

    <div id="footer">
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