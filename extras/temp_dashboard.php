<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        th, td {
            padding: 15px;
        }
        .div_height{
            height: 250px;
            width: 250px;
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
                    <li class="nav-item"><a class="nav-link active" href="squizregister.php" style="color:aliceblue">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color:aliceblue">Contact Us</a></li>     
                </ul>
                <ul class="navbar-nav end-0 mx-3 ml-auto">
                    <nav class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link" href="logout.php" style="color:aliceblue; margin-top:25%;">Logout</a></li>  
                            <li class="nav-item"><img src="assets/img/my_logo.jpeg" alt="" width="70" height="70"></li>  
                    </nav>
                </ul>
                
            </div>
        </div>
    </nav>

    <br>
    <div class="jumbotron container">
        <center><h1>Dashboard</h1></center>
    </div>
    
    <div>
    <center>
        <table>
            <tr>
            <td>
                <div class="jumbotron container div_height">
                    <center>
                        <form action="showquizdb.php" method="post">
                            <?php
                                $server_name="localhost";
                                $username="root";
                                
                                $database_name="db1";
                            
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                                $sql_query = "SELECT distinct(quizname) from questions";
                                $records = mysqli_query($conn,$sql_query);
                                $selection = array();
                                while($data = mysqli_fetch_array($records)){
                                    array_push($selection,$data['quizname']);
                                }
                                
                                echo '<select name="showquizopt" class="form-select" aria-label="Default select example">';

                                foreach ($selection as $selection) {
                                    $selected = ($options == $selection) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                                }

                                echo '</select>';

                                mysqli_close($conn);
                            ?>
                            <br><br>
                            <input type="submit" name="showquiz" value="Show Quiz" style="font-size:20px" class="btn btn-outline-secondary">
                        </form>
                    </center>
                </div>
                </td>

                <td>
                <div class="jumbotron container div_height">
                    <center>
                        <form action="update.php" method="post">
                            <?php
                                $server_name="localhost";
                                $username="root";
                                
                                $database_name="db1";
                            
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                                $sql_query = "SELECT distinct(quizname) from questions";
                                $records = mysqli_query($conn,$sql_query);
                                $selection = array();
                                while($data = mysqli_fetch_array($records)){
                                    array_push($selection,$data['quizname']);
                                }
                                
                                echo '<select name="updateopt" class="form-select" aria-label="Default select example">';

                                foreach ($selection as $selection) {
                                    $selected = ($options == $selection) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                                }

                                echo '</select>';

                                mysqli_close($conn);
                            ?>
                            <br><br>
                            <input type="submit" name="update" value="Update Quiz" style="font-size:20px" class="btn btn-outline-secondary">
                        </form>
                    </center>
                </div>
                </td>
                <td style="margin-left:10;">
                <div class="jumbotron container div_height">
                    <center>
                        <br><br>
                        <a href="quizname.php"><input type="button" class="btn btn-outline-secondary" value="Create Quiz"></a>
                    </center>
                    
                </div>
                </td>
                <td>
                <div class="jumbotron container div_height">
                    <center>
                        <form action="deletequiz.php" method="post">
                        <?php
                                $server_name="localhost";
                                $username="root";
                                
                                $database_name="db1";
                            
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                                $sql_query = "SELECT distinct(quizname) from questions";
                                $records = mysqli_query($conn,$sql_query);
                                $selection = array();
                                while($data = mysqli_fetch_array($records)){
                                    array_push($selection,$data['quizname']);
                                }
                                
                                echo '<select name="deleteopt" class="form-select" aria-label="Default select example">';

                                foreach ($selection as $selection) {
                                    $selected = ($options == $selection) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                                }

                                echo '</select>';

                                mysqli_close($conn);
                            ?>
                            <br><br>
                            <input type="submit" name="delete" value="Delete Quiz" style="font-size:20px" class="btn btn-outline-secondary">
                        </form>
                    </center>
                </div>
                </td>
            </tr>
        </table>
    </center>

    <br>

    <center>
    <table>
        <tr>
            <td>
                <div class="container jumbotron  div_height">
                    <form action="activated.php" method="post">
                    <center>
                        <?php
                            $server_name="localhost";
                            $username="root";
                            
                            $database_name="db1";
                        
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="activateopt" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br><br>
                        <input type="submit" name="activate" value="Activate Quiz" style="font-size:20px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                </div>
            </td>
            <td>
                <div class="container jumbotron  div_height">
                    <form action="deactivated.php" method="post">
                    <center>
                        <br><br>
                        <input type="submit" name="activate" value="Deactivate All Quiz" style="font-size:20px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    </center>

    <center>
    <table>
        <tr>
            <td>
                <div class="container jumbotron div_height">
                    <form action="temprel.php" method="post">
                    <br>
                    <center>
                        <?php
                            $server_name="localhost";
                            $username="root";
                            
                            $database_name="db1";
                        
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="resultselect" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br><br>
                        <input type="submit" name="showresult" value="Show Result" style="font-size:20px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                </div>
            </td>

            <td>
                <div class="container jumbotron div_height">
                    <form action="settingresult.php" method="post">
                    
                    <center>
                        <h5>Student's View</h5>
                        <?php
                            $server_name="localhost";
                            $username="root";
                            
                            $database_name="db1";
                        
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="studentresultselect" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br><br>
                        <input type="submit" name="studentshowresult" value="Result Settings" style="font-size:20px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                </div>
            </td>
            <td>
                <div class="container jumbotron div_height">
                    <form action="clearresultview.php" method="post">
                    
                    <center>
                        <h5>Clear Student's Result View</h5>
                        <br>
                        <input type="submit" name="studentshowresultdelete" value="Clear" style="font-size:20px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    </center>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>