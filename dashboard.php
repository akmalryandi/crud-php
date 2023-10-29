<?php
include 'db/connect.php';
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

$dataHalaman = 3;
$data = mysqli_num_rows(mysqli_query($con, "SELECT * FROM data"));
$halaman = ceil($data / $dataHalaman);
$aktifHalaman = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataHalaman * $aktifHalaman) - $dataHalaman;

$sql = "SELECT * FROM data LIMIT $awalData, $dataHalaman";
$read = mysqli_query($con, $sql);

if (isset($_POST['cari'])) {
    $cari = $_POST['nyari'];

    $sql = "SELECT * FROM data 
                where 
                nama like '%$cari%' or
                email like '%$cari%' or
                mobile like '%$cari%'
                LIMIT $awalData, $dataHalaman";
    $read = mysqli_query($con, $sql);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MyCSS -->
    <link rel="stylesheet" href="asset/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Data</title>
</head>

<body>
    <h1 class="text-center mt-2 mb-3">Data Table, <?php echo $_SESSION['login']; ?></h1>
    <div class="container text-white mb-5 rounded-3">

        <form action="index.php" method="post">
            <div class="d-flex bd-highlight pt-5">
                <div class="me-auto p-2 bd-highlight">
                    <a href="add.php" type="button" class="btn btn-outline-dark"><i class="bi bi-plus-lg"></i></a>
                </div>
                <div class="pe-2 bd-highlight">
                    <input type="text" class="form-control" id="search" name="nyari" placeholder="Search" autocomplete="off">
                </div>
                <div class="pe-1 bd-highlight">
                    <button type="submit" name="cari" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
                </div>
                <div class="bd-highlight">
                    <a href="logout.php" type="button" class="btn btn-dark">logout</i></a>
                    
                </div>
            </div>
        </form>

        <div class="table-responsive-sm row p-3">
            <table class="table table-respon2">
                <thead>
                    <tr class="text-center">
                        <!-- <th scope="col">No</th> -->
                        <th scope="col">Picture</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$read) {
                        echo "Gagal Tampil" . mysqli_error($con);
                        die;
                    } else {
                        // $nomor = 1;
                    
                        while ($data = mysqli_fetch_array($read)) {
                            echo '<tr class="text-center">';
                            // echo '<th>' . $nomor . '</th>';
                            echo '<td><img class="rounded-circle" src="images/' . $data['gambar'] . '" width="100"></td>';
                            echo '<td>' . $data['nama'] . '</td>';
                            echo '<td>' . $data['email'] . '</td>';
                            echo '<td>' . $data['mobile'] . '</td>';
                            echo '<td><a href="update.php?updateid=' . $data['id'] . '">
                                <button class="btn btn-outline-secondary"><i class="bi bi-pencil-square"></i></button></a>

                                <a href="delete.php?deleteid=' . $data['id'] . '">
                                <button class="btn btn-outline-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="bi bi-trash3-fill"></i></button></a></td>';
                            echo '</tr>';
                            // $nomor++;
                        }
                    }
                    ?>

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($aktifHalaman >1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $aktifHalaman - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif;?>

                    <?php for ($i = 1; $i <= $halaman; $i++): ?>
                        <?php if ($i == $aktifHalaman): ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($aktifHalaman < $halaman) :?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $aktifHalaman + 1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>