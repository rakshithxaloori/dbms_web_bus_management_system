<?php 
    require_once "dbconnect.php";
    session_start();
    if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true)){
        $ass_route=$_POST["ass_route"];
        $ass_bus=$_POST["ass_bus"];
        $created_by=$_SESSION["a_username"];
        
        echo'<center><h2 style="color:white;background-color:#333;">Bus Successfully Assigned</h2></center>';
	    $sql=mysqli_query($con, "insert into  Travel_on(Bus_id,Route_id,created_by) values ('$ass_bus', '$ass_route', '$created_by')");
	    if($sql)require_once "assign_bus.php";
        else echo("Error description: ".mysqli_error($con));

    }
    else{

    }
?>