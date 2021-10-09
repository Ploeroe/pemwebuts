<?php
session_start();

require 'function.php';
$conn = mysqli_connect("localhost", "root", "", "pemwebuts");
$comment = query("SELECT * FROM comment");
$user = query("SELECT * FROM user");
$newsid = $_GET["newsid"];

if (isset($_SESSION["login"])) {
    
}

if (isset($_POST["postcomment"])) {
    $userid = $_SESSION["userid"];
    $newsid = $_GET["newsid"];
    $date = date("Y-m-d H:i:s");
    echo $userid . $newsid . $comment.$date;
    
    $query = "INSERT INTO comment
                VALUES
              ('', '$userid', '$newsid', '$comment', '$date')";
    
    mysqli_query($conn, $query);
    header("Refresh:0");
}


if (isset($_POST["submit"])) {
    if (add($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href =  'student_data.php';           
            </script>    
        ";
    } else {
        echo "
            <script>
                alert('Data tidak berhasil ditambahkan!');
                document.location.href =  'student_data.php';           
            </script>    
        ";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Portal Berita</title>
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
                    <a class="navbar-brand" style="color: black;" href="berita.php">Nama Portal</a>
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
        <div>
            <div>
                    <form action="" method="post">
                        <textarea name="comment" id="comment" rows="10" cols="30" placeholder="Write your thoughts"></textarea><br>
                        <?php if(isset($_SESSION["login"])) {?>
                        <button type="submit" name="postcomment" class="btn btn-primary">Post Comment</button>
                        <?php }else{ ?>
                        <a class="btn btn-primary" href="login.php">Post Comment</a>
                        <?php } ?>
                    </form>
            </div>
            <div>
                <?php $i = 1; ?>
                <?php foreach ($comment as $crow) : 
                        if($newsid == $crow["newsid"]){ 
                            foreach($user as $urow) : 
                                if($crow["userid"] == $urow["ID"]){ ?>
                                        <h4><?= $urow["username"]; ?></h4>
                                        <br>
                                        <p><?= $crow["comment"]; ?></p>
                                        <p style="color: grey"><?= $crow["date"]; ?></p>
                                    </tr>
                                <?php } 
                            endforeach;
                        } ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>