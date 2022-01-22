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
    if(isset($_POST["exportqz"])) {  
        $conn=mysqli_connect($server_name,$username,$password,$database_name); 

        $sql_query = "SELECT quizname from demoshow";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        $qz1 = str_replace(' ','',$qz); 

        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename='.$qz1.'.csv'); 

        $output = fopen("php://output", "w");  

        fputcsv($output, array('Question','Option 1', 'Option 2', 'Option 3','Option 4','Answer'));  

        $query = "SELECT question,opt1,opt2,opt3,opt4,ans from questions where quizname='$qz'";  

        $result = mysqli_query($conn, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
             fputcsv($output, $row);  
        }  
        fclose($output);  
    }  
?>
