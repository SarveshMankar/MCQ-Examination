<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz</title>
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
                    <li class="nav-item"><a class="nav-link active" href="../index.php" style="color:aliceblue">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../login.php" style="color:aliceblue">Admin Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">Contact Us</a></li>     
                </ul>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <img src="../assets/img/my_logo.jpeg" alt="" width="70" height="70">			
                </ul>		  
                </div>
            </div>
        </div>
    </nav>
    <?php
        require ('../config.php');
    ?>
    <br>
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        $num=0;

        $sql_query = "SELECT * from activated";
        $records = mysqli_query($conn,$sql_query);
        $flag=0;
        while($data = mysqli_fetch_array($records)){
            $flag=1;
        }
        if ($flag==1){
            echo '<div class="container jumbotron">';
                echo '<h1>Enter Your Details!</h1>';
            echo '</div>';
        }
    ?>
    
    <br>
    <div class="jumbotron container">
        <?php
        if ($flag==1){
            echo '<div class="form-group">';
                echo '<form action="scheckregister.php" method="post">';
                    echo '<center>';
                        echo '<input type="email" class="form-control" name="email" id="" placeholder="Email Id">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="name" id="" placeholder="Full Name">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="roll" id="" placeholder="Enrollment Number">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="mobile" id="" placeholder="Mobile Number" pattern="[1-9]{1}[0-9]{9}" minlength="10" maxlength="10" required>';
                        echo '<br>';
                        echo '<input type="submit" name="srsubmit" style="font-size:20px" class="btn btn-outline-success" value="Next">';
                    echo '</center>';
                echo '</form>';
            echo '</div>';
        }
        else{
            echo "<h2>No Quizzes Available!";
        }
        ?>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script><br><br>
</body>