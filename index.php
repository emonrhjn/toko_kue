<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <!--logo-->
    <div class="text-center mt-2">
        <img src="./image/kueku-removebg.png" width="50%">
    </div>

    <!-- produk highlighted -->
    <div class="container-fluid py4 ">
        <div class="container text-center">
            <h1 class="fw-bolder mt-5">Produk Unggulan</h1>

            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class=" highlighted-produk produk-kue-lontar d-flex justify-content-center align-items-center">
                        <h5 class="fw-bolder text-white">Kue Lontar</h5>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class=" highlighted-produk produk-kue-zebra d-flex justify-content-center align-items-center">
                        <h5 class="fw-bolder text-white">Kue Zebra</h5>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class=" highlighted-produk produk-pasta-pandan d-flex justify-content-center align-items-center">
                        <h5 class="fw-bolder text-white">Pasta Pandan</h5>
                    </div>
                </div>
            </div>
            <a class="fw-bolder btn btn-outline mt-1 p-2 fs-5" href="produk.php"> >> Lihat Lainnya << </a>
        </div>
    </div>

    <!-- footer -->
    <div class="container-fluid mt-4 py-1 bg-dark text-white">
        <div class="container d-flex justify-content-between">
            <label>&copy;2023 Kue-Ku</label>
            <label>Created by E.R</label>
        </div>
    </div>

    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>