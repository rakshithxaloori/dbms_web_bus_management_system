<?php
    require_once "dbconnect.php";
    session_start();
    $rem_bus=$_POST["rem_bus"];
    if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true&&$rem_bus!=NULL)){
        $created_by=$_SESSION["a_username"];
        
        echo'<center><h2 style="color:white;background-color:#333;">Bus Successfully DeAssigned</h2></center>';
	    $sql=mysqli_query($con, "DELETE FROM Travel_on WHERE Bus_id = '$rem_bus'");
	    if($sql){
            $results=mysqli_query($con,"DELETE FROM Travels_through WHERE Bus_id = '$rem_bus';");
            require_once "assign_bus.php";
        }
        else {
            require_once "assign_bus.php";
        }//echo("Error description: ".mysqli_error($con));
    }
    else if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true)&&$rem_bus==NULL){
        require_once "assign_bus.php";
    }
    else{
        echo "Please log in first to see users page.";
        require_once "admin_login.php";
    }

?>