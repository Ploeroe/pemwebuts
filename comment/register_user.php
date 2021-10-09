<?php
    require 'function.php';

    if (isset($_POST["register"])) {
        if (registrasi($_POST) > 0) {
            echo "<script type='text/javascript'>
                    alert('User baru berhasil ditambahkan!');
                </script>";
                
        } else {
            echo mysqli_error($conn);
        }
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Registrasi</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
        <style>
            label {
            display: block;
            }

            li {
            list-style-type: none;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default" ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style="color: black;" href="#">[ IF330 ] Web Programming</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a>Student</a></li>
                </ul>
            </div>
        </nav>
        <form action="" method="POST" style="width: 30%;">
            <ul>
                <center><h1>Register Student</h1></center>
                
                <li class="group-form">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" class="form-control" required placeholder="Masukkan Username">
                </li>
                <li class="group-form">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Masukkan Email">
                </li>
                <li class="group-form">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan Password">
                </li>
                <li class="group-form">
                    <label for="password2">Konfirmasi Password : </label>
                    <input type="password" name="password2" id="password2" class="form-control" required placeholder="Masukkan Password">
                </li>
                <br>

                <button type="submit" name="register" class="btn btn-primary">Sign Up</button>

                <a href="register_user.php">
                    <button type="button" name="back" class="btn btn-light" style="color:black;">cancel</button>
                </a>
            </ul>
        </form>
    </body>
</html>