<?php
session_start();

require 'function.php';

$mhs = query("SELECT * FROM user");

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION["userid"] = $row["ID"];
            $_SESSION["username"] = $username;
            $_SESSION["login"] = true;
            echo "<script>
            alert('dah masuk');
            document.location.href =  'berita.php';
          </script>";
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <style>
        li {
            list-style-type: none;
        }
    </style>
</head>

<body>
                    <form action="" method="POST">
                        <ul>
                            <li class="group-form">
                                <label for="username">username </label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                            </li>
                            <li class="group-form">
                                <label for="password">Password </label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                            </li>
                            <br>
                            <button type="submit" name="login" class="btn btn-primary">Sign In</button>
                            <a href="register_user.php">
                                <button type="button" name="regis" class="btn btn-warning" style="color:white;">Register</button>
                            </a>
                            <br>
                            <?php if (isset($error)) : ?>
                                <p style="color: red; font-style:italic;">username/Username tidak terdaftar atau password salah. Silahkan coba lagi</p>
                            <?php endif; ?>
                        </ul>

                    </form>
</html>