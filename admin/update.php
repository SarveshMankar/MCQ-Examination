<?php
    session_start();

    if(isset($_SESSION['uname'])){
        $a=0;
    }
    else{
        ob_start();
        header('Location: '.'../login.php');
        ob_end_flush();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Update Test</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
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

            if(isset($_POST['update'])){
                $qn=$_POST['updateopt'];
                
            }
            echo "<h1> Update Quiz $qn!</h1>";
        ?>
        
        <p>Type out the Questions and the Options. Select the radio button which have correct answer!</p>
        <p></p>
    </div>
    <br>

    <script>
        num=0
    </script>

    <div class="container jumbotron">
        <form action="updatequiz.php" method="post">
            <div id="textboxDiv">
                <?php
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $num=0;
                    
                    $sql_query = "SELECT * from questions where quizname='$qn'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        $ans =$data['ans'];
                        
                        $w="text".$num;
                        $w1="radio".$num;
                        $w2="radiotext".$num;

                        if ($ans==$opt1){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt2){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt3){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt4){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        else{
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }

                        $num=$num+1;
                    }
                    echo '<input type="hidden" id="quesno" name="quesno" value='.$num.'>';
                    echo '<input type="hidden" id="quiznameforupdate" name="quiznameforupdate" value="'.$qn.'">';
                ?>
                
            
                
            </div>
            <br>
            <center>
                <input type="submit" name="save" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
        <div>
            <center>
                <button id="Add" class="btn btn-secondary">Add a Question</button> 
                <button id="Remove" class="btn btn-secondary">Delete Last Question</button>
            </center>
        </div>
    </div>
    
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <script>  
        $(document).ready(function() {  
            $("#Add").on("click", function() { 
                num=parseInt(document.getElementById("quesno").value)
                w="text"+num
                w1="radio"+num
                w2="radiotext"+num
                num+=1
                $("#textboxDiv").append('<div><br><textarea class="form-control" id="'+w+'" name='+w+' rows="3"></textarea><br></div>');
                //$("#textboxDiv").append("<div><br><input type='text' class='form-control' placeholder='Question " + (num) + "' id='" + w + "' name='" + w + "'/><br></div>");
                
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'1' + "' name='" + w1 + "' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 1' id='" + w2+'1' + "' name='" + w2+'1' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'2' + "' name='" + w1 + "' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 2' id='" + w2+'2' + "' name='" + w2+'2' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'3' + "' name='" + w1 + "' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 3' id='" + w2+'3' + "' name='" + w2+'3' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'4' + "' name='" + w1 + "' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 4' id='" + w2+'4' + "' name='" + w2+'4' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<hr>")
                document.getElementById("quesno").value=num
            });  
            $("#Remove").on("click", function() {  
                num=parseInt(document.getElementById("quesno").value)
                console.log(num)
                if (num>0){
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    num-=1
                    document.getElementById("quesno").value=num
                }
            });  
        });  
    </script>

</body>

</html>