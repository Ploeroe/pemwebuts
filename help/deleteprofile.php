<?php

session_start();
include_once 'dbh.php';

$sessionid = $_SESSION['id'];

$filename = "uploads/profile".$sessionid.".*";
$fileinfo = glob($filename);
$fileext = explode(".",$fileinfo[0]);
$fileActualext = $fileext[1];

$file = "uploads/profile".$sessionid.".".$fileactualext;

if(!unlink($file)){
    echo "File was not deleted!";
} else {
    echo "File was deleted!";
}

$sql = "UPDATE profileimg SET status=1 WHERE userid='$sessionid';";
mysqli_query($conn, $sql);

header("Location: index.php?deletesuccess");
?>