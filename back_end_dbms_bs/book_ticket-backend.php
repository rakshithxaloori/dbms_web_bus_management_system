<?php 
require_once "dbconnect.php";
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        
        $created_by=$_SESSION["username"];
        $bus_id=$_POST["bus_id_ticket"];
        $source_code=$_POST["source_code_ticket"];
        $dest_code=$_POST["dest_code_ticket"];
        $fare=$_POST["fare_per_person"];
        $model_name=$_POST["model_name_ticket"];
        $ticket_no=$_SESSION["ticket_no"]-1;
        $no_of_pass=$_POST["n_pass"];


        $get_capacity=mysqli_query($con,"SELECT Capacity FROM Bus WHERE Bus.Bus_id=$bus_id");
        $row=mysqli_fetch_array($get_capacity);
        $rem_capacity=$row[0]-$no_of_pass;

        $update=mysqli_query($con,"UPDATE `Bus` SET `Capacity` = '$rem_capacity' WHERE `Bus`.`Bus_id` = $bus_id;");
        echo'<center><h3 style="color:white;background-color:#333;">Ticket Generated!</h3></center>';

        require_once "usershome.php";
    }


else{
    echo "Please log in first to see users page.";
    require_once "users_login.php";
}