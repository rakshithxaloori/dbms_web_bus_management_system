<?php 
require_once "dbconnect.php";
session_start();

if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {

    $station_code=$_POST["station_code"];
    $place=$_POST["place"];
    $station_name=$_POST["station_name"];
    $created_by=$_SESSION["a_username"];

    $query = "SELECT * FROM Station WHERE station_code='$station_code'";
    $result = mysqli_query($con, $query);
    $numResults = mysqli_num_rows($result);

    if($numResults==1){
        echo'<center><h3 style="color:white;background-color:#333;">This Station is Already registered!</h3></center>';
        require_once "add_station.php";
    }
    else{
        echo'<center><h2 style="color:white;background-color:#333;">Station Successfully Registered</h2></center>';
	    $sql=mysqli_query($con, "insert into Station (station_code,place,station_name,created_by) values ('$station_code', '$place', '$station_name','$created_by')");
	    if($sql)require_once "adminshome.php";
        else echo("Error description: ".mysqli_error($con));
    }
}
else{
    echo "Please log in first to see users page.";
    require_once "admin_login.php";
}
?>