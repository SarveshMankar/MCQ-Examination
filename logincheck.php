<?php

    $uname="sam";
    $pwd="aparna";

    session_start();

    if($_POST['uname']!=$uname || $_POST['pwd']!=$pwd){
        session_destroy();
        ob_start();
        header('Location: '.'login.php');
        ob_end_flush();
        die();
    }
    elseif(isset($_SESSION['uname'])){
        ob_start();
        header('Location: '.'dashboard.php');
        ob_end_flush();
        die();
    }
    else{
        if($_POST['uname']==$uname && $_POST['pwd']==$pwd){
            $_SESSION['uname']=$uname;
            ob_start();
            header('Location: '.'dashboard.php');
            ob_end_flush();
            die();
        }
        else{
            ob_start();
            header('Location: '.'login.php');
            ob_end_flush();
            die();
        }
    }

?>