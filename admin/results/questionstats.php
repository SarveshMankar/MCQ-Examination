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
    <title>Results</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

    <style>
        th, td {
            padding: 15px;
        }
    </style>
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
        .fortable{
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>

</head>

<body class="bodycolor">
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--indigo);background: #242226;">
        <div class="container-fluid"><a class="navbar-brand" href="" style="color:aliceblue">MCQ Software</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="../dashboard.php" style="color:aliceblue">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="allresult.php" style="color:aliceblue">Complete Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="studresult.php" style="color:aliceblue">Student Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="questionstats.php" style="color:aliceblue">Question Stats</a></li>
                    <li class="nav-item"><a class="nav-link" href="graph.php" style="color:aliceblue">Graphical View</a></li>
                    <li class="nav-item"><a class="nav-link" href="studnots.php" style="color:aliceblue">Not Submitted</a></li>
                    <li class="nav-item"><a class="nav-link" href="malicious.php" style="color:aliceblue">Malicious Activity</a></li>
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
   
    <form action="" method="post">
        <?php
            if (isset($_POST['quesresult'])){
                echo '<div class="container jumbotron form-group">';
                $quesno=intval($_POST['quesno'])-1;
                $d='text'.$quesno;
                $ques1=$_POST[$d];

                $ques=str_replace("'","\'",$ques1);
                $count = substr_count($ques1, "\n") + 2;
                echo "<center><h2> Question Stats </h2></center>";
                echo "<div><br><textarea rows='$count' class='form-control' disabled>$ques1</textarea></div>";

                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                $sql_query = "SELECT quizname from tempresult";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $qz=$data['quizname'];
                }

                $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $cans=$data['ans'];
                }
                echo "<br>Correct Answer: $cans";
                
                $nc=1;
                $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='correct'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $roll=$data['rollno'];
                    $name=$data['email'];

                    $nc+=1;
                }

            

                $sql_query = "SELECT quizname from tempresult";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $qz=$data['quizname'];
                }

                //echo "<div class='row'><div class='col-md-6>";
            
                $nw=1;
                $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='wrong'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $roll=$data['rollno'];
                    $name=$data['email'];

                    $nw+=1;
                }

                echo '</div>';
                mysqli_close($conn);
            }
        ?>
    </form>
    </div>
    </div>

    <div class="container jumbotron">
    <canvas id="graph" width="400" height="150"></canvas>
    <script>
        <?php
            if (isset($_POST['quesresult'])){
                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                echo "const ctx = document.getElementById('graph').getContext('2d');";
                echo "const myChart = new Chart(ctx, {";
                    echo "type: 'bar',";
                    echo "data: {";
                        echo "labels: ['Correct', 'Wrong',],";
                        echo "datasets: [{";
                            echo "label: 'Number of Students',";
                            echo "data: [$nc,$nw],";
                            echo "backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]";
                    echo "},";
                    echo "options: {";
                        echo "scales: {";
                            echo "y: {";
                                echo "beginAtZero: true";
                                echo "}
                        }
                    }
                });";
                mysqli_close($conn);
            }
        ?>
        </script>
    </div>   
        
    <form action="" method="post">
        <?php

        if (isset($_POST['quesresult'])){
            echo '<div class="container jumbotron form-group">';
            $quesno=intval($_POST['quesno'])-1;
            $d='text'.$quesno;
            $ques1=$_POST[$d];

            $ques=str_replace("'","\'",$ques1);
            $count = substr_count($ques1, "\n") + 2;

            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            $sql_query = "SELECT quizname from tempresult";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $cans=$data['ans'];
            }

            echo '<div class="row">';
            
            echo '<div class="col-md-6">';
            echo '<br><center><h4>Studnets gave Correct Answer</h4></center><hr>';

            //echo "<div class='row'><div class='col-md-6>";
            echo '<br><div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Roll No.</th>';
                        echo '<th scope="col">Name</th>';
                        echo '</tr>';
                    echo '</thead>';
                
            
            echo '<tbody>';
            $nc=1;
            $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='correct'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $roll=$data['rollno'];
                $name=$data['email'];
                echo '<tr>';
                echo '<th scope="row">'.$nc.'</th>';
                echo '<td>'.$roll.'</td>';
                echo '<td>'.$name.'</td>';
                echo '<tr>';
                $nc+=1;
            }

            echo '</table>';
            echo '</div></div>';

            echo '<div class="col-md-6">';
            echo '<br><center><h4>Studnets gave Wrong Answer</h4></center><hr>';

            $sql_query = "SELECT quizname from tempresult";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            //echo "<div class='row'><div class='col-md-6>";
            echo '<br><div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Roll No.</th>';
                        echo '<th scope="col">Name</th>';
                        echo '</tr>';
                    echo '</thead>';
                
            
            echo '<tbody>';
            $nw=1;
            $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='wrong'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $roll=$data['rollno'];
                $name=$data['email'];
                echo '<tr>';
                echo '<th scope="row">'.$nw.'</th>';
                echo '<td>'.$roll.'</td>';
                echo '<td>'.$name.'</td>';
                echo '<tr>';
                $nw+=1;
            }

            echo '</table>';
            echo '</div></div>';

            mysqli_close($conn);
            echo '</div>';
        }

        ?>
    </form>
    </div>
    </div>
    
    <br>
    <div class="jumbotron container">
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Question Wise Stats of ".$qz."</h1></center>";
        mysqli_close($conn);
        ?>
    </div>

    <div class="container jumbotron">
    <form action="" method="post" class="form-group">
        <?php
            $selection=array();
            $sn=array();
            $num=0;
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
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
                
                $heynum=$num+1;
                echo "<div><p>$heynum.)&ensp;$q1 </p></div>";

                echo "<hr>";
                $num=$num+1;
            }
            echo "<hr>";
            echo 'Select Question Number:-<br><br><select name="quesno" class="form-select forselect" aria-label="Default select example" style="width: 90%;">';
            $n1=0;
            while ($n1<$num) {
                $n1+=1;
                $selected = ($options == $n1) ? "selected" : "";
                echo '<option '.$selected.' value="'.$n1.'">'.$n1.'</option>';
            }
            echo '</select><br><br>';
        ?>
        <center><input type="submit" name="quesresult" value="Question Stats" style="font-size:20px" class="btn btn-outline-success"></center>
    </form>
    </div>

    <br><br>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>