<?php 
require_once "dbconnect.php";
session_start();

if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {

    $bus_id=$_POST["bus_id"];
    $capacity=$_POST["capacity"];
    $vehicle_no=$_POST["vehicle_no"];
    $model_name=$_POST["model_name"]
    $created_by=$_SESSION["a_username"];

    $query = "SELECT * FROM Bus WHERE Bus_id='$bus_id'";
    $result = mysqli_query($con, $query);
    $numResults = mysqli_num_rows($result);

    $query_1=="SELECT * FROM Model WHERE Model_name='$model_name'";
    $result_1 = mysqli_query($con, $query_q);
    $numResults_1 = mysqli_num_rows($result_1);
    


    if($numResults==1||$numResults_1==0){
        echo'<center><h3 style="color:white;background-color:#333;">This Bus is Already registered!</h3></center>';
        require_once "add_bus.php";
    }
    else{
        echo'<center><h2 style="color:white;background-color:#333;">Station Successfully Registered</h2></center>';
	    $sql=mysqli_query($con, "insert into Bus (Bus_id,Capacity,vehicle_no,Model_name,created_by) values ('$Bus_id', '$capacity', '$vehicle_no','$model_name','$created_by')");
	    if($sql)require_once "adminshome.php";
        else echo("Error description: ".mysqli_error($con));
    }
}
else{
    echo "Please log in first to see users page.";
    require_once "admin_login.php";
}
?>