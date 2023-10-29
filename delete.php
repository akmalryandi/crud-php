<?php
    include('db/connect.php');
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];

        $sql2 = "SELECT * FROM data WHERE id=$id";
        $result2 = mysqli_query($con,$sql2);
        $data = mysqli_fetch_assoc($result2);

        unlink("image/".$data['gambar']);

        $sql = "DELETE FROM data where id=$id";
        $result = mysqli_query($con,$sql);

        if ($result) {
            header("location:dashboard.php");
        }else {
            die(mysqli_error($con));
        }
    }
?>