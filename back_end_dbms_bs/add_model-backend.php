<?php
require_once "dbconnect.php";

session_start();
if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true)){

    $model_name=$_POST["model_name"];
    $farepkm=$_POST["farepkm"];
    $_farepkm=(float)$farepkm;
    $created_by =$_SESSION["a_username"];

    $query = "SELECT * FROM Model WHERE Model_name='$model_name'";
    $result = mysqli_query($con, $query);
    $numResults = mysqli_num_rows($result);
    if($numResults==1){
        echo'<center><h3 style="color:white;background-color:#333;">Already model exists</h3></center>';
        require_once "add_model.php";

    }
    else{
        echo'<center><h2 style="color:white;background-color:#333;">Model Successfully Registered</h2></center>';
        $sql=mysqli_query($con, "insert into Model (Model_name,farepkm,created_by) values ('$model_name', '$_farepkm', '$created_by')");
        if($sql)require_once "adminshome.php";
        else echo("Error description: ".mysqli_error($con));
    }

}
else{
    echo "Please log in first to see users page.";
    require_once "admin_login.php";
}

?>