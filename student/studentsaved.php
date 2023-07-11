<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Submitted!</title>
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
    <div class="jumbotron container">
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT * from activated";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $aqz=$data['quizname'];
        }

        if (isset($_POST['final']) && $aqz==$_POST['squiznameforsave']){

            $qz=$_POST['squiznameforsave'];
            $quesno=$_POST['squesno'];
            $sname=$_POST['sname'];
            $semail=$_POST['semail'];
            $sroll=$_POST['sroll'];

            $tmarks=0;
            $marks=0;

            $sql_query = "SELECT done from student where quizname='$qz' and email=\"$semail\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $status=$data['done'];
            }

            if ($status=="no"){
                for ($i=0;$i<$quesno;$i++){
                    $w="text".$i;
                    $w1="radio".$i;
                    $ques=$_POST[$w];
                    $ques=str_replace("'","\'",$ques);
            
                    $w11="opt".$i."1";
                    $w12="opt".$i."2";
                    $w13="opt".$i."3";
                    $w14="opt".$i."4";
                    
                    $opt1=$_POST[$w11];
                    $opt2=$_POST[$w12];
                    $opt3=$_POST[$w13];
                    $opt4=$_POST[$w14];
            
                    if (isset($_POST[$w1])){
                        $ans=$_POST[$w1];
                    }
                    else{
                        $ans=' ';
                    }
                    
                    $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques' and opt1='$opt1' and opt2='$opt2' and opt3='$opt3' and opt4='$opt4'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $ca=$data['ans'];
                    }
            
                    $tmarks+=1;
                    if ($ca==$ans){
                        $marks+=1;
                        $cw="correct";
                    }
                    else{
                        $cw="wrong";
                    }

                    $sql_query = "INSERT INTO submission (rollno,email,quizname,ques,opt1,opt2,opt3,opt4,cans,gans,cw)
                    VALUES ('$sroll','$semail','$qz','$ques','$opt1','$opt2','$opt3','$opt4','$ca','$ans','$cw')";
                    mysqli_query($conn, $sql_query);
                }
            }

            $per=($marks/($quesno))*100;
            $per=number_format($per, 2, '.', '');
            $t=date("d/m/y h:i:sa");

            $sql_query = "UPDATE student SET done='yes',marks=$marks,per=$per,ttime='$t' WHERE email='$semail' and roll='$sroll' and quizname='$qz'";
            mysqli_query($conn, $sql_query);

            $cdata=$_POST['cheated'];
            $ctdata=$_POST['changetabs'];
            //echo $ctdata;
            $myarray=explode(" ",$cdata);
            if ($cdata=="" and $ctdata=="no"){
                //echo "Not Cheated!";
                $mali="Not Cheated!";
            }elseif($ctdata!="no"){
                $mali = "Changed Tab $ctdata times!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }elseif(count($myarray)==2){
                //echo "Tried to Cheat, Pressed some of Shortcut Keys!";
                $mali="Tried to Cheat, Pressed one of Shortcut Key once!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }else{
                //echo "Cheated, Pressed some of Shortcut Keys many times!";
                $mali="Cheated, Pressed some of Shortcut Keys many times!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }

            session_start();
            session_destroy();
            echo "<center><h1>Your Response has been recored!</h1></center><br>";
            echo "<br><center><h3>Thank You $sname!</h3></center>";
        }
        else{
            echo "<center><h1>Sorry You where late!</h1></center><br>";
            echo "<center><h3>If any issues please contact Admin!</h3></center>";
        }

        mysqli_close($conn);
    ?>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>