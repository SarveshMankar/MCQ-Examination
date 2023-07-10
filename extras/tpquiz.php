<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background: rgb(217,180,245);">
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--indigo);background: #6c07bb;">
        <div class="container-fluid"><a class="navbar-brand" href="">MCQ Software</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>     
                </ul>
            </div>
        </div>
    </nav>
    <?php
        require ('config.php');
    ?>
    <br>
    <div class="jumbotron container">
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            //now check the connection
            if(!$conn){
                die("Connection Failed:" . mysqli_connect_error());

            }
            $sql_query = "SELECT * from activated";
            $records = mysqli_query($conn,$sql_query);

            $qz="No Quizzes Available for now!";

            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            mysqli_close($conn);
            echo "<h2>$qz<h2>";
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
                    
                    $sql_query = "SELECT * from questions where quizname='$qz'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        //$ans =$data['ans'];
                        
                        $w="text".$num;
                        $w1="radio".$num;
                        $w11="radio".$num;
                        $w2="radiotext".$num;

                        echo "<div><br><input type='hidden' class='form-control' value='$q' id='$w' name='$w'/></div>";
                        echo "<div><p>&ensp; $q</p></div>";
                        echo "<table><tr><td><div><input type='radio' id='$w1' name='$w11' value='$opt1'/><label for='$w11'>&ensp;&nbsp;$opt1</label></div></td></tr></table>";
                        echo "<table><tr><td><div><input type='radio' id='$w1' name='$w11' value='$opt2'/><label for='$w11'>&ensp;&nbsp;$opt2</label></div></td></tr></table>";
                        echo "<table><tr><td><div><input type='radio' id='$w1' name='$w11' value='$opt3'/><label for='$w11'>&ensp;&nbsp;$opt3</label></div></td></tr></table>";
                        echo "<table><tr><td><div><input type='radio' id='$w1' name='$w11' value='$opt4'/><label for='$w11'>&ensp;&nbsp;$opt4</label></div></td></tr></table>";
                        echo "<hr>";
                        $num=$num+1;
                    }
                    echo '<input type="hidden" id="squesno" name="squesno" value='.$num.'>';
                    echo '<input type="hidden" id="squiznameforsave" name="squiznameforsave" value='.$qz.'>';
                ?>                
            </div>
            <br>
            <center>
                <input type="submit" name="final" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>