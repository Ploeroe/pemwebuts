<?php
    session_start();
    include_once 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    
    <?php

    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
            $resultImg = mysqli_query($conn, $sqlImg);
            while($rowImg = mysqli_fetch_assoc($resultImg)){
                echo "<div class='user-container'>";
                    if($rowImg['status'] == 0 ){
                        
                        $filename = "uploads/profile".$id.".*";
                        $fileinfo = glob($filename);
                        $fileext = explode(".",$fileinfo[0]);
                        $fileActualext = $fileext[1];

                        echo "<img src='uploads/profile".$id.".".$fileActualext."'?".mt_rand().">";
                    } else {
                        echo "<img src='uploads/profiledefault.jpg'>";
                    }
                    echo "<p>".$row['username']."</p>";
                echo "</div>";
            }
        }
    } else {
        echo "There are no users yet!<br>";
    }
    
        if(isset($_SESSION['id'])){
            if($_SESSION['id'] == 1){
                echo "You are logged in as user #1";

            } else {
                
                echo "You are not logged in as user #1";

            }
            echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>

                <input type='file' name='file'>
                <button type='submit' name='submit'>Upload</button>
    
                </form>";

            echo "<form action='deleteprofile.php' method='POST'>

                <button type='submit' name='submit'>Delete profile image</button>
    
                </form>";
            
        } else {
            echo "You are not logged in!";

            echo "<form action='signup.php' method='POST'>
                <label for='first'>Nama Depan:</label><br>
                <input type='text' name='first' placeholder='Nama Depan'><br>
                <label for='last'>Nama Belakang:</label><br>
                <input type='text' name='last' placeholder='Nama Belakang'><br>
                <label for='uid'>Username:</label><br>
                <input type='text' name='uid' placeholder='Username'><br>
                <label for='pwd'>Password:</label><br>
                <input type='text' name='pwd' placeholder='Password'><br>
                <label for='birthday'>Tanggal Lahir:</label><br>
                <input type='date' name='tanggalLahir' placeholder='Tanggal Lahir'><br>
                <label for='gender'>Jenis Kelamin:</label><br>
                <input type='radio' id='pria' name='kelamin' value='pria'>
                <label for='pria'>Pria</label><br>
                <input type='radio' id='perempuan' name='kelamin' value='perempuan'>
                <label for='perempuan'>Perempuan</label><br>
                
                <button type='submit' name='submitSignup'>Sign Up!</button>
            </form>";
        }
    
    ?>


    <p>Login as user!</p>
    <form action="login.php" method="POST">
        <button type="submit" name="submitLogin">Login</button>
    </form>

    <p>Logout as user!</p>
    <form action="logout.php" method="POST">
        <button type="submit" name="submitLogout">Logout</button>
    </form>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>