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
                <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Comment Box</a> is loading comments...</div>
                <link rel="stylesheet" type="text/css" href="https://www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
                <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="https://www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&opts=16798&num=10&ts=1633510359914");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>

            </div>
        </div>
    </body>
</html>