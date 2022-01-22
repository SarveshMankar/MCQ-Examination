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
    
    if(!$conn){
        die("Connection Failed:" . mysqli_connect_error());
    }

    if(isset($_POST['qnsave'])){
        $flag=0;
        $qn = $_POST['quizname'];
        $sql_query = "SELECT distinct(quizname) from questions";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            if ($data['quizname']==$qn){
                $flag=1;
                break;
            }
        }
    }

    if ($flag==1){
        ob_start();
        header('Location: '.'qnameerror.php');
        ob_end_flush();
        die();
    }
    else{
        $sql_query="TRUNCATE TABLE activequiznames";
        mysqli_query($conn,$sql_query);
        $sql_query="INSERT INTO activequiznames (quizname) VALUES ('$qn')";
        mysqli_query($conn,$sql_query);
        
        ob_start();
        header('Location: '.'createquiz.php');
        ob_end_flush();
        die();
    }

    mysqli_close($conn);

?>