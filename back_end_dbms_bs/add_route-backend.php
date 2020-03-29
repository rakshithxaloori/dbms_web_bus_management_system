<?php 
require_once "dbconnect.php";
session_start();
if(isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true){
    $route_id=$_POST["route_id"];
    if(count($_POST['station_code'])<2){
        echo "please enter atleast 2 stations!";
        //require_once "add_route.php";
    }
    else{
        for($i = 0; $i < count($_POST['station_code']); $i++)
        {
            $station_code = mysqli_real_escape_string($con, $_POST['station_code'][$i]);
            $dist_from_source=mysqli_real_escape_string($con, $_POST['distance_from_source'][$i]);
            $time_from_source=mysqli_real_escape_string($con, $_POST['time_from_source'][$i]);
            $created_by=$_SESSION["a_username"];

            // if (empty(trim($station))) continue;

            $sql = "INSERT INTO Route(Route_id, station_code, dis_from_source_in_km, time_from_source,created_by)
                    VALUES('$route_id', '$station_code', '$dist_from_source', '$time_from_source','$created_by')";
            $SQ=mysqli_query($con, $sql);
            echo'<center><h2 style="color:white;background-color:#333;">Route Successfully Registered</h2></center>';
            if($SQ)echo "";
            else echo("Error description: ".mysqli_error($con));
        }
        require_once "adminshome.php";
    }
}

else{
    echo "Please log in first to see users page.";
    require_once "admin_login.php";
}
?>