<?php
include 'db/connect.php';

if (isset($_POST["signup"])) {
    $username = strtolower(stripslashes($_POST["name"]));
    $password = mysqli_real_escape_string($con, $_POST["pass"]);
    $password2 = mysqli_real_escape_string($con, $_POST["re_pass"]);

    $sqlUser = "SELECT username FROM users WHERE username='$username'";
    $resultUser = mysqli_query($con, $sqlUser);
    if ($resultUser->num_rows > 0) {
        // Username sudah terdaftar
        echo "<script>alert('Username sudah terdaftar');</script>";
    } elseif ($password !== $password2) {
        // Password dan konfirmasi password tidak sesuai
        echo "<script>alert('Password dan konfirmasi password tidak sesuai');</script>";
    } else {
        // Simpan data ke database (gantilah sesuai kebutuhan Anda)
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($con->query($sql) === TRUE) {
            // echo "<script>alert('Berhasil');</script>";
            echo '<script>alert("Registrasi berhasil"); window.location.href = "login.php";</script>';
            // header("Location: login.php");
        } else {
            die(mysqli_error($con));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form action="" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>