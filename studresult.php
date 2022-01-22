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
    <title>Student Results</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

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
        .forselect{
            width: 75%;
        }
    </style>

</head>

<body class="bodycolor">
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--indigo);background: #242226;">
        <div class="container-fluid"><a class="navbar-brand" href="" style="color:aliceblue">MCQ Software</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php" style="color:aliceblue">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="allresult.php" style="color:aliceblue">Complete Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="studresult.php" style="color:aliceblue">Student Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="graph.php" style="color:aliceblue">Graphical View</a></li>
                    <li class="nav-item"><a class="nav-link" href="studnots.php" style="color:aliceblue">Not Submitted</a></li>
                    <li class="nav-item"><a class="nav-link" href="malicious.php" style="color:aliceblue">Malicious Activity</a></li>
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
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Results of ".$qz."</h1></center>";
        ?>
    </div>

    <form action="" method="post">
        <center>
            <div class="container jumbotron form-group">
            <?php
                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                $sql_query = "SELECT quizname from tempresult";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $qz=$data['quizname'];
                }

                $sql_query = "SELECT roll from student where quizname=\"$qz\" and done=\"yes\"";
                $records = mysqli_query($conn,$sql_query);
                $selection = array();
                while($data = mysqli_fetch_array($records)){
                    array_push($selection,$data['roll']);
                }
                
                echo '<select name="roll" class="form-select forselect" aria-label="Default select example">';

                foreach ($selection as $selection) {
                    $selected = ($options == $selection) ? "selected" : "";
                    echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                }

                echo '</select><br><br>';
            ?>
            <input type="submit" name="rollresult" value="Show Result" style="font-size:20px" class="btn btn-outline-secondary">
            </div>
        </center>
    </form>

    <div class="jumbotron container">
        <?php
            if (isset($_POST['rollresult'])){
                $selectedroll=$_POST['roll'];
                echo "<center><h3>Results of Roll Number:".$_POST['roll']."</h3></center>";
                echo "<div class=\"jumbotron container\">";

                $sql_query = "SELECT * from student where quizname=\"$qz\" and roll=\"$selectedroll\"";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $email=$data['email'];
                    $name=$data['ename'];
                    $roll=$data['roll'];
                    $mobile=$data['mobile'];
                    $marks=$data['marks'];
                    $per=$data['per'];
                    $t=$data['ttime'];
                    echo "<h5>Name: $name</h5><br>";
                    echo "<h5>Roll no: $roll</h5><br>";
                    echo "<h5>Email: $email</h5><br>";
                    echo "<h5>Mobile Number: $mobile</h5><br>";
                    echo "<h5>Marks Scored: $marks</h5><br>";
                    echo "<h5>Percentage Scored: $per%</h5><br>";
                    echo "<h5>Submitted At: $t</h5><br>";
                }

                echo "<hr><br>";

                $n=1;
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Question</th>';
                        echo '<th scope="col">Option 1</th>';
                        echo '<th scope="col">Option 2</th>';
                        echo '<th scope="col">Option 3</th>';
                        echo '<th scope="col">Option 4</th>';
                        echo '<th scope="col">Given Answer</th>';
                        echo '<th scope="col">Correct Answer</th>';
                        echo '<th scope="col">Evaluation</th>';
                        echo '</tr>';
                    echo '</thead>';
                
                $sql_query = "SELECT * from submission where quizname=\"$qz\" and rollno=\"$selectedroll\"";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $q1=$data['ques'];
                    $ques=str_replace("\n","<br>",$q1);
                    $opt1=$data['opt1'];
                    $opt2=$data['opt2'];
                    $opt3=$data['opt3'];
                    $opt4=$data['opt4'];
                    $gans=$data['gans'];
                    $cans=$data['cans'];
                    $cw=$data['cw'];

                    if ($cw=="correct"){
                        $cw1="✔️";
                    }
                    else{
                        $cw1="❌";
                    }

                    echo '<tbody>
                        <tr>
                        <th scope="row">'.$n.'</th>
                        <td>'.$ques.'</td>
                        <td>'.$opt1.'</td>
                        <td>'.$opt2.'</td>
                        <td>'.$opt3.'</td>
                        <td>'.$opt4.'</td>
                        <td>'.$gans.'</td>
                        <td>'.$cans.'</td>
                        <td><center>'.$cw1.'</center></td>
                        </tr>';

                    $n+=1;
                }
                echo '</tbody>
                    </table>';
                echo "</div>";
                echo '</div>';
                mysqli_close($conn);
            }
        
        ?>
    </div>
    <br><br>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>