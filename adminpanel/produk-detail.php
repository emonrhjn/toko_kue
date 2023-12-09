<?php
require "./session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT * FROM produk");
$data = mysqli_fetch_array($query);

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
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    form div {
        margin-bottom: 10px;
    }
</style>


<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
            </ol>
        </nav>

        <div class="container mt-4">
            <nav aria-label="breadcrumb">
                <h2>Detail Produk</h2>
            </nav>

            <div class="col-12 col-md-6 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-4">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="mt-4">
                        <label for="foto"> Pilih Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <div>
                        <img src="../image/<?php echo  $data['foto']; ?>" alt="" width="300px">
                    </div>

                    <div class="mt-4">
                        <label for="harga">Harga</label>
                        <input type="number" value="<?php echo $data['harga']; ?>" class="form-control" name="harga" required>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success" name="simpan">Simpan Perubahan</button>
                        <button type="submit" class="btn btn-danger" name="hapus">Hapus Produk</button>
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
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET nama='$nama', harga='$harga' WHERE id='$id'");

                        if ($nama_file != '') {
                            if ($image_size > 1000000) {
                        ?>
                                <div class="alert alert-warning" role="alert">
                                    Foto tidak boleh lebih dari 1 MB
                                </div>
                                <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-primary mt-4" role="alert">
                                        Produk Berhasil Diubah
                                    </div>
                                    <?php
                                    header("location: index.php")
                                    ?>
                        <?php
                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['hapus'])) {
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

                    if ($queryHapus) {
                        ?>
                        <div class="alert alert-primary mt-4" role="alert">
                            Produk Berhasil Dihapus
                        </div>
                        <?php
                        header("location: index.php")
                        ?>
                <?php
                    }
                }
                ?>
            </div>

        </div>


        <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>