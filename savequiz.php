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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz Saved</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .bodycolor{
            background: #9053c7;
            background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
            background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
            background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
            background: linear-gradient(-135deg, #c850c0, #4158d0);
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="bodycolor">
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--indigo);background: #242226;">
        <div class="container-fluid"><a class="navbar-brand" href="" style="color:aliceblue">MCQ Software</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php" style="color:aliceblue">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">Contact Us</a></li>     
                </ul>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <img src="assets/img/my_logo.jpeg" alt="" width="70" height="70">			
                </ul>		  
                </div>
            </div>
        </div>
    </nav>
    <?php
        require ('config.php');
    ?>
    <br>
    <div class="jumbotron container">
        
        <?php
        function save($server_name,$username,$password,$database_name){
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            //now check the connection
            if(!$conn)
            {
                die("Connection Failed:" . mysqli_connect_error());

            }

            if(isset($_POST['save'])){
                $quesno= $_POST['quesno'];

                for($i=0;$i<=$quesno-1;$i++){
                    $g='text'.$i;
                    $ques = $_POST[$g];
                    $g1='radiotext'.$i.'1';
                    $opt1= $_POST[$g1];
                    $g2='radiotext'.$i.'2';
                    $opt2= $_POST[$g2];
                    $g3='radiotext'.$i.'3';
                    $opt3= $_POST[$g3];
                    $g4='radiotext'.$i.'4';
                    $opt4= $_POST[$g4];
                    $g5='radio'.$i;
                    $oo= $_POST[$g5];

                    if ($oo==1){
                        $ans=$opt1;
                    }
                    if($oo==2){
                        $ans=$opt2;
                    }
                    if($oo==3){
                        $ans=$opt3;
                    }
                    if($oo==4){
                        $ans=$opt4;
                    }

                    $sql_query = "SELECT quizname from activequiznames";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $qn=$data['quizname'];
                    }

                    $ques=str_replace("'","\'",$ques);

                    $sql_query = "INSERT INTO questions (quizname,question,opt1,opt2,opt3,opt4,ans)
                    VALUES ('$qn','$ques','$opt1','$opt2','$opt3','$opt4','$ans')";
                    mysqli_query($conn, $sql_query);
                    
                    $oo=0;            
                }
            }
            mysqli_close($conn);
            echo "<h2>Quiz Created!<h2>";
        }

        save($server_name,$username,$password,$database_name);
        
        ?>
        
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>