<?php

    session_start();

    if(isset($_SESSION['uname'])){
        session_destroy();
        ob_start();
        header('Location: '.'../login.php');
        ob_end_flush();
        die();
    }
    else{
        ob_start();
        header('Location: '.'../login.php');
        ob_end_flush();
        die();
    }

?>