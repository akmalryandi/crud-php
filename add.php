<?php
include 'db/connect.php';
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {

    $direktori = "image/";
    $file_name = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'],$direktori.$file_name);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['hp'];

    $sql = "INSERT INTO data(gambar,nama,email,mobile) 
                VALUES('$file_name','$name','$email','$mobile')";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    } else {
        header('location:dashboard.php');
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD</title>
</head>

<body>
    <h1 class="text-center mt-2 mb-3">Tambah Data</h1>
    <div class="container rounded-3">
        <div class="row p-3">
            <form method="post" action="add.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" Required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off" Required>
                </div>
                <div class="mb-3">
                    <label for="hp">No HP</label>
                    <input type="text" class="form-control" id="hp" name="hp" autocomplete="off" Required>
                </div>
                <div class="mb-3">
                    <label for="gambar">Pilih gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" Required>
                </div>
                <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                <button class="btn btn-dark" onclick="window.location.href='dashboard.php'">Kembali</button>
            </form>
        </div>
    </div>
</body>

</html>