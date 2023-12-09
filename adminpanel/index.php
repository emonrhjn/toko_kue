<?php
require "./session.php";
require "../koneksi.php";

$query = mysqli_query($con, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($query);

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Tambah Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>

</style>

<body>
    <div>
        <?php require "navbar.php"; ?>

        <div class="container mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Admin</li>
                    <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                </ol>
            </nav>

            <!-- tambah produk -->
            <div class="my-1 col-12 col-md-6">
                <h3 class="fw-bolder">Tambah Produk</h3>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-4">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="mt-4">
                        <label for="foto">Pilih Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <div class="mt-4 mb-5">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success" name="simpan">Tambahkan Produk</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $harga = htmlspecialchars($_POST['harga']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;


                    if ($nama == '' || $harga == '') {
                ?>
                        <div class="alert alert-warning" role="alert">
                            Nama dan Harga Wajib diisi
                        </div>
                        <?php

                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 1000000) {
                        ?>
                                <div class="alert alert-warning" role="alert">
                                    File tidak boleh lebih dari 1 MB
                                </div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }

                        // query insert to produk
                        $queryTambah = mysqli_query($con, "INSERT INTO produk (nama, foto, harga) VALUES ('$nama', '$new_name.', '$harga')");

                        if ($queryTambah) {
                            ?>
                            <div class="alert alert-primary mt-4" role="alert">
                                Produk Berhasil Tersimpan
                            </div>

                            <meta http-equiv="refresh" content="2" ; url=produk.php>
                <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
                ?>
            </div>

            <div class="mt-5">
                <h2 class="fw-bolder">List Produk</h2>

                <div class="table-responsive mt-5 mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Haraga</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($jumlahproduk == 0) {
                            ?>
                                <tr>
                                    <td colspan=5 class="text-center"> Data Produk Tidak Tersedia</td>
                                </tr>
                                <?php
                            } else {
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['foto']; ?></td>
                                        <td><?php echo $data['harga']; ?></td>
                                        <td>
                                            <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-primary text-white" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="fas fa-search"></i>Lihat Detail</a>
                                        </td>
                                    </tr>
                            <?php
                                    $jumlah++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>