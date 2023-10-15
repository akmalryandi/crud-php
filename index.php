<?php
include 'connect.php';
$sql = "SELECT * FROM data";
$read = mysqli_query($con, $sql);
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

    <title>Data</title>
</head>

<body>
    <h1 class="text-center mt-2 mb-3">Data Table</h1>
    <div class="container text-white mb-5 rounded-3">
        <div class="table-responsive-sm row p-3">
            <a href="add.php"><button class="btn btn-dark mb-1">Tambah</button></a>

            <table class="table table-dark table-striped table-respon2">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
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
                        $nomor = 1;
                        while ($data = mysqli_fetch_array($read)) {
                            echo '<tr class="text-center">';
                            echo '<th>' . $nomor . '</th>';
                            echo '<td><img class="rounded-5" src="image/' . $data['gambar'] . '" width="100"></td>';
                            echo '<td>' . $data['nama'] . '</td>';
                            echo '<td>' . $data['email'] . '</td>';
                            echo '<td>' . $data['mobile'] . '</td>';
                            echo '<td><a href="update.php?updateid=' . $data['id'] . '">
                                <button class="btn btn-outline-secondary">Update</button></a>

                                <a href="delete.php?deleteid=' . $data['id'] . '">
                                <button class="btn btn-outline-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Delete</button></a></td>';
                            echo '</tr>';
                            $nomor++;
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>