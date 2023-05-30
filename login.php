<?php
session_start();

require 'function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="mx-auto">
        <form action="" method="post">
            <div class="main d-flex flex-column justify-content-center align-items-center">
                <div class="card shadow mb-3 flex-column">
                    <h3>Login</h3>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <?php if (isset($error)): ?>
                            <p style="color: red; font-style: italic" ;>username/password salah</p>
                        <?php endif; ?>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                        </div>
                        <div class="paragraf">
                            <p>Belum punya akun? <a href="registrasi.php">Daftar disini</a></p>
                        </div>
                    </div>
                </div>

                <!-- login -->
                <div class="class mt-1" style="width: 350px">
                    <?php
                    if (isset($_POST["login"])) {
                        $username = htmlspecialchars($_POST["username"]);
                        $password = htmlspecialchars($_POST["password"]);

                        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");
                        $countdata = mysqli_num_rows($query);
                        $data = mysqli_fetch_array($query);

                        if ($countdata > 0) {
                            if (password_verify($password, $data['password'])) {
                                $_SESSION['username'] = $data['username'];
                                $_SESSION["login"] = true;
                                header('location: daftarberita.php');
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Password salah
                                </div>

                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Akun tidak tersedia
                            </div>
                            <?php
                        }
                    } ?>
                </div>
                <!-- login -->
            </div>
        </form>
    </div>
</body>

</html>