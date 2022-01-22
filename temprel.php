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

    if (isset($_POST['showresult'])){
    
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "TRUNCATE table tempresult;";
        mysqli_query($conn, $sql_query);

        $qz=$_POST['resultselect'];
        $sql_query = "INSERT INTO tempresult (quizname) VALUES ('$qz')";
        mysqli_query($conn, $sql_query);
        ob_start();
        header('Location: '.'allresult.php');
        ob_end_flush();
        die();
    }
?>