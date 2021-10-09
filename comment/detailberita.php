<?php
session_start();

require 'function.php';

if (isset($_GET["idnews"])) {
    $id = $_GET["idnews"];
    $mhs = query("SELECT * FROM news WHERE judul= '$id'")[0];
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Portal Berita - <?= $mhs["judul"];?></title>
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
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style="color: black;">Nama Portal</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!isset($_SESSION["login"])) {?>
                        <a href="login.php" class="btn btn-success" style="color: white;">Log In</a>
                    <?php } else{?>
                        <a href="logout.php" class="btn btn-danger" style="color: white;">Log Out</a>
                    <?php }  ?>  
                </ul>
            </div>
        </nav>
        <h1><?= $mhs["judul"]?></h1>
        <p>Oleh <?= $mhs["penulis"]?></p>
        <br>
        <p></p>
        <div>
            <img src="<?= $mhs["gambar"]?>">
        </div>

        <div>
            <div>
                    <form>
                    <textarea name="message" rows="10" cols="30" placeholder="Write your thoughts"></textarea>
                    </form>
            </div>
        </div>
    </body>
</html>