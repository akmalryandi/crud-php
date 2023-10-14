<?php
include 'connect.php';

$id = $_GET['updateid'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['hp'];
    $password = $_POST['password'];

    $sql = "UPDATE data SET id = $id, nama='$name', email='$email', mobile='$mobile', pasword='$password'
            where id=$id";
    $result = mysqli_query($con, $sql);
    

    if (!$result) {
        die(mysqli_error($con));
    } else {
        header('location:index.php');
    }
    
}

$sql2 = "SELECT * FROM data WHERE id = $id";
$hasil = mysqli_query($con, $sql2);
$data = mysqli_fetch_assoc($hasil);

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD</title>
</head>

<body>
    <h1 class="text-center mt-2 mb-3">Update Data</h1>
    <div class="container bg-secondary text-white rounded-3">
        <div class="row p-3">
            <form method="post">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" Required value="<?php echo $data['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off" Required value="<?php echo $data['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="hp">No HP</label>
                    <input type="text" class="form-control" id="hp" name="hp" autocomplete="off" Required value="<?php echo $data['mobile']; ?>">
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" Required value="<?php echo $data['pasword']; ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-dark">Update</button>
            </form>
        </div>
    </div>
</body>

</html>