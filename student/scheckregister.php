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
                    <li class="nav-item"><a class="nav-link active" href="index.html" style="color:aliceblue">Home</a></li>
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
    <br>
    <?php
        require ('../config.php');
    ?>
    <div class="container jumbotron">
        <h2>Instructions:-</h2><br>
        <ol>
            <li>1.) Keep a Stable Internet Connection.</li>
            <li>2.) Submit the Test in given Time.</li>
            <li>3.) If any issues, please contact to Admin.</li>
        </ol>
        
        <?php
            error_reporting(0);
            if (isset($_POST['srsubmit'])){

                $email=$_POST['email'];
                $name=$_POST['name'];
                $roll=$_POST['roll'];
                $mobile=$_POST['mobile'];
                $done="no";

                if (($email=='') || ($name=='') || ($roll=='') || ($mobile=='')){
                    ob_start();
                    header('Location: '.'srinvalid.php');
                    ob_end_flush();
                    die();
                }
                else{
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    
                    if(!$conn){
                        die("Connection Failed:" . mysqli_connect_error());
                    }


                    $sql_query = "SELECT * from activated";
                    $records = mysqli_query($conn,$sql_query);

                    $qz="No Quizzes Available for now!";

                    while($data = mysqli_fetch_array($records)){
                        $qz=$data['quizname'];
                    }


                    $flag=0;
                    $flag1=0;
                    $submittedflag=0;

                    $sql_query = "SELECT roll,email from student";
                    $records = mysqli_query($conn,$sql_query);

                    while($data = mysqli_fetch_array($records)){
                        if (($data['roll']==$roll) || ($data['email']==$email)){

                            //echo "c1";
                            $sql_query = "SELECT email from student where roll='$roll' and quizname='$qz'";
                            $r = mysqli_query($conn,$sql_query);
                            while($d = mysqli_fetch_array($r)){
                                $e1=$d['email'];
                                if (!($d['email']==$email)){
                                    //echo "c12";
                                    $flag=1;
                                    break;
                                    break;
                                }
                            }

                            $sql_query = "SELECT roll from student where email='$email' and quizname='$qz'";
                            $r = mysqli_query($conn,$sql_query); 
                            while($d = mysqli_fetch_array($r)){
                                $r1=$d['roll'];
                                if (!($d['roll']==$roll)){
                                    //echo "c13";
                                    $flag=1;
                                    break;
                                    break;
                                }
                            }

                            if ($e1==$email && $r1==$roll){
                                $sql_query = "SELECT done from student where email='$email' and quizname='$qz' and roll='$roll'";
                                $r = mysqli_query($conn,$sql_query);

                                while($d = mysqli_fetch_array($r)){
                                    $s1=$d['done'];
                                    if ($d['done']=='no'){
                                        $flag1=1;       
                                        break;
                                    }
                                    else{
                                        $submittedflag=1;
                                    }
                                }
                            }

                        }
                    }

                    if($flag1==1){
                        //Registered but didn't submitted
                        echo "<form action='quiz.php' method='post'>";
                            echo '<input type="hidden" id="squizname" name="squizname" value="'.$qz.'">';
                            echo '<input type="hidden" id="sname" name="sname" value="'.$name.'">';
                            echo '<input type="hidden" id="semail" name="semail" value="'.$email.'">';
                            echo '<input type="hidden" id="sroll" name="sroll" value="'.$roll.'">';
                            echo '<input type="hidden" id="smobile" name="smobile" value="'.$mobile.'">';
                            echo "<br><center><input type='submit' class='btn btn-outline-success' value='Proceed'></center>";
                        echo "</form>";

                        session_start();
                        $_SESSION['sname']=$email;
                    }
                    elseif($submittedflag==1){
                        //Already Submitted
                        ob_start();
                        header('Location: '.'submittedalready.php');
                        ob_end_flush();
                        die();
                    }
                    elseif ($flag==1){
                        //Trying to register with email or roll already used
                        ob_start();
                        header('Location: '.'srinvalid.php');
                        ob_end_flush();
                        die();
                    }
                    else{
                        //New registration
                        $sql_query = "INSERT INTO student (email,ename,roll,mobile,done,quizname)
                                VALUES ('$email','$name','$roll','$mobile','$done','$qz')";
                        mysqli_query($conn, $sql_query);

                        echo "<form action='quiz.php' method='post'>";
                            echo '<input type="hidden" id="squizname" name="squizname" value='.$qz.'>';
                            echo '<input type="hidden" id="sname" name="sname" value='.$name.'>';
                            echo '<input type="hidden" id="semail" name="semail" value='.$email.'>';
                            echo '<input type="hidden" id="sroll" name="sroll" value='.$roll.'>';
                            echo '<input type="hidden" id="smobile" name="smobile" value='.$mobile.'>';
                            echo "<br><center><input type='submit' class='btn btn-outline-success' value='Proceed'></center>";
                        echo "</form>";
                        session_start();
                        $_SESSION['sname']=$email;
                    }

                    mysqli_close($conn);
                }

            }
        ?>
    </div>
    
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>