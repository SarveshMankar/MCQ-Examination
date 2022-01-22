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
    <title>Complete Results</title>
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
    <div class="jumbotron container">
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Graphical Representation of Results of ".$qz."</h1></center>";
        mysqli_close($conn);
        ?>
    </div>

    <div class="container jumbotron">
    <canvas id="graph" width="400" height="150"></canvas>
    <script>
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
        $sql_query = "SELECT * from student where per<=35 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l35 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>35 and per<=50 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l50 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>50 and per<=75 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l75 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>75 and per<=90 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l90 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>90 and per<=100 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l100 = mysqli_num_rows($records);

        echo "const ctx = document.getElementById('graph').getContext('2d');";
        echo "const myChart = new Chart(ctx, {";
            echo "type: 'bar',";
            echo "data: {";
                echo "labels: ['<35%', '36% to 50%', '51% to 75%', '76% to 90%', '91% to 100%'],";
                echo "datasets: [{";
                    echo "label: 'Number of Students',";
                    echo "data: [$l35, $l50, $l75, $l90, $l100],";
                    echo "backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
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
        ?>
        </script>
    </div>
    <br><br>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>