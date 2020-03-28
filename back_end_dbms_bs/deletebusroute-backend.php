<?php
    require_once "dbconnect.php";
    session_start();
    if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true)){
        $rem_bus=$_POST["rem_bus"];
        $created_by=$_SESSION["a_username"];
        
        echo'<center><h2 style="color:white;background-color:#333;">Bus Successfully DeAssigned</h2></center>';
	    $sql=mysqli_query($con, "DELETE FROM Travel_on WHERE Bus_id = '$rem_bus'");
	    if($sql)require_once "assign_bus.php";
        else echo("Error description: ".mysqli_error($con));
    }
    else{
        echo "Please log in first to see users page.";
        require_once "admin_login.php";
    }

?>