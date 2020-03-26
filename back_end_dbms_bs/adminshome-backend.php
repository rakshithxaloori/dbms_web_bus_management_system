<?php 
require_once "dbconnect.php";
// session_start();

if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
$admin=$_SESSION['a_username'];

$query = "SELECT * FROM admins WHERE username='$admin'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);


if($numResults==1){
    echo "Hi, " .$row[2] . "!";
    require_once "adminshome.php";
}

} 
else {
    echo "Please log in first to see users page.";
    require_once "admin_login.php";
}
?>