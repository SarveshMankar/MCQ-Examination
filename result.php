<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Results</title>
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
                    <li class="nav-item"><a class="nav-link" href="index.php" style="color:aliceblue">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php" style="color:aliceblue">Admin Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="squizregister.php" style="color:aliceblue">Enter Quiz</a></li>
                    <li class="nav-item"><a class="nav-link active" href="result.php" style="color:aliceblue">Results</a></li>
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
    <?php
        require ('config.php');
    ?>
    <div class="container jumbotron">
        <h1>Results</h1>
    </div>
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT * from studentresult";
        $records=mysqli_query($conn,$sql_query);

        $flag=0;
        while($data = mysqli_fetch_array($records)){
            $flag=1;
            $qz=$data['quizname'];
            $setting=$data['setting'];
        }
        
        if ($flag==0){
            echo '<div class="container jumbotron"><h2>No Data Available!</h2></div>';
        }
        else{
            echo '<div class="container jumbotron">
            <form action="" method="get">';
            echo '<input type="text" class="form-control" id="roll" name="roll" placeholder="Enter Roll Number">';
            echo '<br><center><input type="submit" name="result" class="btn btn-outline-success" value="Show" style="font-size:20px"></center>';
            echo '</form></div>';
        }
        mysqli_close($conn);

    ?>

    <?php
        if (isset($_GET['result']) and ($setting=="Complete Result with Question Evaluation")){
            echo '<div class="container jumbotron">';
            $roll=$_GET['roll'];

            $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
            $sql_query = "SELECT * from questions where quizname=\"$qz\"";
            $records = mysqli_query($conn,$sql_query);
            $total=mysqli_num_rows($records);

            $sql_query = "SELECT * from student where quizname=\"$qz\" and roll=\"$roll\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $email=$data['email'];
                $name=$data['ename'];
                $roll=$data['roll'];
                $mobile=$data['mobile'];
                $marks=$data['marks'];
                $percentage=$data['per'];
                echo "<h5>Name: $name</h5><br>";
                echo "<h5>Roll no: $roll</h5><br>";
                echo "<h5>Email: $email</h5><br>";
                echo "<h5>Mobile Number: $mobile</h5><br>";
                echo "<h5>Marks Scored: $marks</h5><br>";
                echo "<h5>Percentage Scored: $percentage%</h5>";
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
            
            $sql_query = "SELECT * from submission where quizname=\"$qz\" and rollno=\"$roll\"";
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
            echo "</div>";
            echo '</div>';
            mysqli_close($conn);
        }
        elseif (isset($_GET['result']) and ($setting=="Show only Marks!")){
            echo '<div class="container jumbotron">';
            $roll=$_GET['roll'];
            echo '<h2>'.$roll.'</h2>';
            
            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            $sql_query = "SELECT * from questions where quizname=\"$qz\"";
            $records = mysqli_query($conn,$sql_query);
            $total=mysqli_num_rows($records);
        
            $sql_query = "SELECT * from student where quizname=\"$qz\" and roll=\"$roll\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $email=$data['email'];
                $name=$data['ename'];
                $roll=$data['roll'];
                $mobile=$data['mobile'];
                $marks=$data['marks'];
                $percentage=$data['per'];

                echo "<h5>Name: $name</h5><br>";
                echo "<h5>Roll no: $roll</h5><br>";
                echo "<h5>Email: $email</h5><br>";
                echo "<h5>Mobile Number: $mobile</h5><br>";
                echo "<h5>Marks Scored: $marks out of $total</h5><br>";
                echo "<h5>Percentage: $percentage%</h5>";
            }

            echo "<hr><br>";

        }
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>