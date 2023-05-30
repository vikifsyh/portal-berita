<?php
//koneksi
$conn = mysqli_connect("localhost", "root", "", "akademik");
function query($query)
{

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;

}
function tambah($data)
{
    global $conn;


    $pengirim = htmlspecialchars($data['pengirim']);
    $judul = htmlspecialchars($data['judul']);
    $isi = htmlspecialchars($data['isi']);
    $tanggal = htmlspecialchars($data['tanggal']);
    $nama_user = htmlspecialchars($data['nama_user']);
    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO tb_berita(pengirim,judul,isi,tanggal,gambar,nama_user) VALUES ('$pengirim', '$judul', '$isi', '$tanggal', '$gambar', '$nama_user')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //cek apakah yang di upload gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('yang anda upload bukan gambar');
        </script>";
    }

    //cek jika ukuran terlalu besar
    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('gambar terlalu besar');
        </script>";
    }

    //cara upload
    move_uploaded_file($tmpName, 'img/' . $namaFile);

    return $namaFile;

}
function update($data)
{
    global $conn;
    $id = $data["idberita"];
    $judul = htmlspecialchars($data['judul']);
    $pengirim = htmlspecialchars($data['pengirim']);
    $isi = htmlspecialchars($data['isi']);
    $tanggal = htmlspecialchars($data['tanggal']);

    $query = "UPDATE tb_berita SET judul = '$judul', pengirim = '$pengirim', tanggal = '$tanggal', isi = '$isi' WHERE idberita = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_berita WHERE idberita = $id");

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM tb_berita WHERE judul LIKE '%$keyword%' OR isi LIKE '%$keyword%'";
    return query($query);
}

function registrasi($data)
{
    global $conn;
    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Terimakasih username anda sudah terdaftar');</script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('konfirmasi password tidak sesuai');</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user(username,password) VALUES('$username', '$password')");

    return mysqli_affected_rows($conn);
}

function readmore($limit, $text)
{
    $contents = explode(" ", $text);
    $words = array_slice($contents, 0, $limit);

    return implode(" ", $words);
}
?>