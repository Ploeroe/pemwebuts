<?php
    include_once 'dbh.php';
    $first = mysqli_real_escape_string($conn,$_POST['first']);
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    $date = mysqli_real_escape_string($conn,$_POST['tanggalLahir']);
    $gender = mysqli_real_escape_string($conn,$_POST['kelamin']);
    
    $sql = "INSERT INTO user (first, last, username, password, tanggalLahir, gender) VALUES ('$first', '$last', '$uid', '$pwd', '$date', '$gender');";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM user WHERE username='$uid' AND first='$first'";
    $result = mysqli_query($conn, $sql);
    var_dump($result);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $userid = $row['id'];
            $sql = "INSERT INTO profileimg (userid, status) VALUES ('$userid',1);";
            mysqli_query($conn, $sql);
            header("Location: index.php");
            }
    }    else {
        echo "You have an error!";
    }
?>