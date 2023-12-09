<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<style>
    .main {
        height: 100vh;
    }

    .login-box {
        width: 400px;
        height: 300px;
        border-radius: 50px;
    }

    .body-image {
        background-image: url(./image/img2.jpg);
        background-size: 100%;
    }
</style>

<body>
    <div class="body-image">
        <div class="main d-flex flex-column justify-content-center align-items-center">
            <div class="login-box p-4 shadow">
                <form action="" method="post" action="./proses.php">
                    <div class="text-center">
                        <h3 class="fw-bolder text-white">Login Admin</h3>
                    </div>
                    <div>
                        <label class="text-white mb-2" for="username">Username</label>
                        <input type="text" class="form-control" autocomplete="off" name="username" id="username">
                    </div>

                    <div class="mt-2">
                        <label class="text-white mb-2" for="password">Password</label>
                        <input type="password" class="form-control" autocomplete="off" name="password" id="password">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success form-control" type="submit" name="login">Login</button>
                    </div>
                </form>
            </div>


            <!-- Eksekusi Form Login -->
            <div class="mt-3" style="width: 400px;">
                <?php
                if (isset($_POST['login'])) {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    // Query untuk memilih tabel
                    $query = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password='$password'");
                    $hasil = mysqli_num_rows($query);

                    // Pengecekan Kondisi Login Berhasil/Tidak
                    if ($hasil > 0) {
                        $_SESSION['username'] = $hasil['username'];
                        $_SESSION['password'] = $hasil['password'];
                        $_SESSION['login'] = true; // Login berhasil
                        header('location: index.php');
                    } else {
                ?>
                        <div class="alert alert-warning text-center" role="alert">
                            !!..Akun Tidak Tersedia..!!
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>