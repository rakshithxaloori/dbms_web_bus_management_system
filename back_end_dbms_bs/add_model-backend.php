<?php
require_once "dbconnect.php";
$model_name=$_POST["model_name"];
$farepkm=$_POST["farepkm"];
$_farepkm=(float)$farepkm;
session_start();
if(isset($_SESSION["loggedin"])&&($_SESSION["loggedin"]==true)){
    $created_by =$_SESSION["a_username"];
    $sql=mysqli_query($con, "insert into Model (Model_name,farepkm,created_by) values ('$model_name', '$_farepkm', '$created_by')");
}

?>