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

<?php  
    require ('config.php');
    if(isset($_POST["exportre"])) {
        $conn=mysqli_connect($server_name,$username,$password,$database_name); 

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        $qz1 = str_replace(' ','',$qz);
        $qz1.="-Results";

        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename='.$qz1.'.csv'); 

        //Create csv file
        $output = fopen("php://output", "w");  

        //Placing Data
        fputcsv($output, array('Email','Name', 'Roll Number','Mobile Number', 'Marks Scored','Percentage','Time of Submission'));  

        //Fetch Data
        $query = "SELECT email,ename,roll,mobile,marks,per,ttime from student where quizname='$qz' and done=\"yes\"";  

        $result = mysqli_query($conn, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
             fputcsv($output, $row);  
        }  
        fclose($output); 

    }  
?>
