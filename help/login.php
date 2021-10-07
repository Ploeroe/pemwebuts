<?php

    session_start();

    if(isset($_POST['submitLogin'])){
        $_SESSION['id'] = 2;
        header("Location: index.php");
    }

?>