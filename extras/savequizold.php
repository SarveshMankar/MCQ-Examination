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
	
	function save(){
		$server_name="localhost";
		$username="root";
		$password="Sarvesh@Anand@Mankar";
		$database_name="db1";

		$conn=mysqli_connect($server_name,$username,$password,$database_name);
		//now check the connection
		if(!$conn)
		{
			die("Connection Failed:" . mysqli_connect_error());

		}

		if(isset($_POST['save'])){
			$quesno= $_POST['quesno'];
			echo $quesno;

			for($i=0;$i<=$quesno-1;$i++){
				$g='text'.$i;
				$ques = $_POST[$g];
				$g1='radiotext'.$i.'1';
				$opt1= $_POST[$g1];
				$g2='radiotext'.$i.'2';
				$opt2= $_POST[$g2];
				$g3='radiotext'.$i.'3';
				$opt3= $_POST[$g3];
				$g4='radiotext'.$i.'4';
				$opt4= $_POST[$g4];
				$g5='radio'.$i;
				$oo= $_POST[$g5];


				echo "oo=".$oo;
				if ($oo==1){
					echo "Op1";
					$ans=$opt1;
				}
				if($oo==2){
					echo "Op2";
					$ans=$opt2;
				}
				if($oo==3){
					echo "Op3";
					$ans=$opt3;
				}
				if($oo==4){
					echo "Op4";
					$ans=$opt4;
				}


				foreach ($_POST as $key => $value) {
					echo "<tr>";
					echo "<td>";
					echo $key."->";
					echo "</td>";
					echo "<td>";
					echo $value;
					echo "</td>";
					echo "</tr>";
					echo "<br>";
				}


				echo $ques."<br>";
				echo $opt1."<br>";
				echo $opt2."<br>";
				echo $opt3."<br>";
				echo $ans."<br>";
				echo "<hr>";
			
				$sql_query = "INSERT INTO questions (quizname,question,opt1,opt2,opt3,opt4,ans)
				VALUES ('first','$ques','$opt1','$opt2','$opt3','$opt4','$ans')";
		
				if (mysqli_query($conn, $sql_query)){
					echo "New Details Entry inserted successfully !";
				} 
				else{
					echo "Error: " . mysqli_error($conn);
				}
				echo "<br><br>";
				
				$oo=0;
			}

		}
		mysqli_close($conn);
	}

	save();
	
?>

