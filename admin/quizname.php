<?php
    session_start();

    if(isset($_SESSION['uname'])){
        $a=0;
    }
    else{
        ob_start();
        header('Location: '.'../login.php');
        ob_end_flush();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Create Test - Select Quiz Name</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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

    <br>
    <div class="jumbotron container">
        <h1>Let's Create a Quiz!</h1>
        <p>Enter Unique Quiz Name!</p>
        <p></p>
    </div>
    <br>

    <div class="container jumbotron">
        <form action="qname.php" method="post">
            <input type="text" class="form-control" id="quizname" name="quizname" placeholder="Quiz Name!">     
            <br>
            <center>
                <input type="submit" name="qnsave" value="Next" style="font-size:20px">
            </center>
        </form>
        <br>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>