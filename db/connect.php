<?php
    $con=new mysqli("localhost","root","","crud_tes");

    if (!$con) {
        die(mysqli_error($con));
    }
?>