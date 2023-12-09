<?php
require "./koneksi.php";
$queryproduk = mysqli_query($con, "SELECT id, nama, foto, harga FROM produk");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="warna4">
        <?php require "navbar.php"; ?>

        <div class="container-fluid mt-3 mb-1">
            <div class="container">
                <h2 class="fw-bolder text-center">List Produk</h2>

                <div class="row mt-3">
                    <?php while ($data = mysqli_fetch_array($queryproduk)) { ?>
                        <div class="col-sm-6 col-md-4 mb-3">
                            <div class="card">
                                <div class="image-box">
                                    <img src="image/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title"><?php echo $data['nama'] ?></h6>
                                    <h7>
                                        <p class="card-text">Rp <?php echo $data['harga'] ?></p>
                                    </h7>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a class="fw-bolder btn btn-primary mt-2 mb-4 p-6 fs-5" href="kontak.php">Pesan Sekarang</a>
        </div>
    </div>
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>