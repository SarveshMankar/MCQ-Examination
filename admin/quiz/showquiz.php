<?php
    session_start();

    if(isset($_SESSION['uname'])){
        $a=0;
    }
    else{
        ob_start();
        header('Location: '.'../../login.php');
        ob_end_flush();
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
                    <li class="nav-item"><a class="nav-link active" href="../dashboard.php" style="color:aliceblue">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">Contact Us</a></li>     
                </ul>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <img src="../../assets/img/my_logo.jpeg" alt="" width="70" height="70">			
                </ul>		  
                </div>
            </div>
        </div>
    </nav>
    <?php
        require ('../../config.php');
    ?>
    <br>
    <div class="jumbotron container">
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
            $sql_query = "SELECT quizname from demoshow";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            echo "<h2>$qz</h2>";
        ?>
        
    </div>

    <script>
        num=0
    </script>

    <div class="container jumbotron">
        <form action="" method="post">
            <div id="textboxDiv">
                <?php
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $num=0;
                    
                    $sql_query = "SELECT * from questions where quizname='$qz'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $q2=str_replace("\n","<br>",$q);
                        $q1=str_replace("    ","&emsp;",$q2);
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        //$ans =$data['ans'];
                        
                        $w="text".$num;
                        $w1="radio".$num;
                        $w11="radio".$num."1";
                        $w12="radio".$num."2";
                        $w13="radio".$num."3";
                        $w14="radio".$num."4";
                        $w2="radiotext".$num;

                        $t1="opt".$num."1";
                        $t2="opt".$num."2";
                        $t3="opt".$num."3";
                        $t4="opt".$num."4";

                        echo "<div><br><textarea style='display: none;' id='$w' name='$w' rows='3'>$q</textarea></div>";
                        
                        echo "<div><p>&ensp;$q1 </p></div>";


                        echo '<input type="hidden" id="'.$t1.'" name="'.$t1.'" value="'.$opt1.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w11' name='$w1' value='$opt1'/><label for='$w11'>&ensp;&nbsp;$opt1</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t2.'" name="'.$t2.'" value="'.$opt2.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w12' name='$w1' value='$opt2'/><label for='$w12'>&ensp;&nbsp;$opt2</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t3.'" name="'.$t3.'" value="'.$opt3.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w13' name='$w1' value='$opt3'/><label for='$w13'>&ensp;&nbsp;$opt3</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t4.'" name="'.$t4.'" value="'.$opt4.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w14' name='$w1' value='$opt4'/><label for='$w14'>&ensp;&nbsp;$opt4</label></div></td></tr></table>";
                        
                        echo "<hr>";
                        $num=$num+1;
                    }
                ?>                
            </div>
            <br>
            <center>
                <input type="submit" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>

    <div class="container jumbotron">
        <form action="exportquiz.php" method="post">
            <center>
                <input type="submit" name="exportqz" value="Export Quiz" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <br><br>
</body>

</html>