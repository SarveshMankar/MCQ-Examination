<?php
    session_start();

    if(isset($_SESSION['sname'])){
        $a=0;
    }
    else{
        ob_start();
        header('Location: '.'squizregister.php');
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
    <link rel="icon" href="">
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
        .disable-selecting {
            user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
        }
    </style>
    <noscript>
        This page needs JavaScript activated to work. 
        <style>div { display:none; }</style>
    </noscript>
    <script>
        nct=0;
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
        document.addEventListener("visibilitychange", event => {
        if (document.visibilityState == "visible") {
            console.log("tab is active")
        } else {
            nct=nct+1;
            console.log("tab is inactive")
            document.querySelector('.changetabs').value = nct;
        }
        })
    </script>
</head>

<body class="bodycolor">
    <canvas width="128" height="128" hidden></canvas>
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--indigo);background: #242226;">
        <div class="container-fluid"><a class="navbar-brand" href="" style="color:aliceblue">MCQ Software</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php" style="color:aliceblue">Home</a></li>
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
        
            $sql_query = "SELECT quizname from activated";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            echo "<h2>$qz</h2>";

            $roll=$_POST['sroll'];
            $name=$_POST['sname'];
            $email=$_POST['semail'];
            mysqli_close($conn);
        ?>
        
    </div>

    <script>
        num=0
    </script>

    <div class="container jumbotron">
        <form action="studentsaved.php" method="post">
            <div id="textboxDiv">
                <?php
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $num=0;
                    
                    $sql_query = "SELECT * from questions where quizname='$qz' order by RAND()";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $q2=str_replace("\n","<br>",$q);
                        $q1=str_replace("    ","&emsp;",$q2);
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        
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
                        
                        echo "<div><p class='disable-selecting'>&ensp;$q1 </p></div>";


                        echo '<input type="hidden" id="'.$t1.'" name="'.$t1.'" value="'.$opt1.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w11' name='$w1' value='$opt1'/><label for='$w11' class='disable-selecting'>&ensp;&nbsp;$opt1</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t2.'" name="'.$t2.'" value="'.$opt2.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w12' name='$w1' value='$opt2'/><label for='$w12' class='disable-selecting'>&ensp;&nbsp;$opt2</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t3.'" name="'.$t3.'" value="'.$opt3.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w13' name='$w1' value='$opt3'/><label for='$w13' class='disable-selecting'>&ensp;&nbsp;$opt3</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t4.'" name="'.$t4.'" value="'.$opt4.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w14' name='$w1' value='$opt4'/><label for='$w14' class='disable-selecting'>&ensp;&nbsp;$opt4</label></div></td></tr></table>";
                        
                        echo "<hr>";
                        $num=$num+1;
                    }
                    echo '<input type="hidden" id="squesno" name="squesno" value='.$num.'>';
                    echo '<input type="hidden" id="squiznameforsave" name="squiznameforsave" value="'.$qz.'">';
                    echo '<input type="hidden" id="sname" name="sname" value="'.$name.'">';
                    echo '<input type="hidden" id="semail" name="semail" value="'.$email.'">';
                    echo '<input type="hidden" id="sroll" name="sroll" value="'.$roll.'">';
                ?>                
            </div>
            <br>
            <input type="hidden" class="cheating" name="cheated">
            <input type="hidden" class="changetabs" name="changetabs" value="no">
            <center>
                <input type="submit" name="final" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>

    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>