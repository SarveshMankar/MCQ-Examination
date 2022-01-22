<?php
    session_start();

    if(isset($_SESSION['uname'])){
        $a=0;
    }
    else{
        ob_start();
        header('Location: '.'login.php');
        ob_end_flush();
        die();
    }

    require ('config.php');

    $conn=mysqli_connect($server_name,$username,$password,$database_name);

    $sql_query = "TRUNCATE table demoshow";
    mysqli_query($conn, $sql_query);
    $qz=$_POST['showquizopt'];
    $sql_query = "INSERT INTO demoshow (quizname) VALUES ('$qz')";
    mysqli_query($conn, $sql_query);
    mysqli_close($conn);

    ob_start();
    header('Location: '.'showquiz.php');
    ob_end_flush();
    die();
?>