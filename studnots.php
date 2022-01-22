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
    <title>Students not Submitted</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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

    <div class="container jumbotron">
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            $sql_query = "SELECT quizname from tempresult";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }
            
            echo "<center><h1>Students who are giving ".$qz." quiz</h1></center>";
            mysqli_close($conn);
        ?>
    </div>

    <div class="container jumbotron">
        <?php
            $n=1;
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            
            $sql_query = "SELECT * from student where quizname='$qz' and done='no'";
            $records = mysqli_query($conn, $sql_query);

            echo '<table class="table">';
                echo '<thead class="thead-dark">';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">Name</th>';
                    echo '<th scope="col">Roll Number</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Mobile Number</th>';
                    echo '</tr>';
                echo '</thead>';

            while($data = mysqli_fetch_array($records)){
                $roll=$data['roll'];
                $email=$data['email'];
                $name=$data['ename'];
                $mobile=$data['mobile'];

                echo '<tbody>
                        <tr>
                        <th scope="row">'.$n.'</th>
                        <td>'.$name.'</td>
                        <td>'.$roll.'</td>
                        <td>'.$email.'</td>
                        <td>'.$mobile.'</td>
                        </tr>';
                $n+=1;
            }
            echo '</tbody>
            </table>';

            mysqli_close($conn);
        ?>
    </div>
    <br><br>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>