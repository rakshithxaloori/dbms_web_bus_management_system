<?php 
require_once "dbconnect.php";
// session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
$user=$_SESSION['username'];

$query = "SELECT * FROM users WHERE username='$user'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);


if($numResults==1){
    echo "Hi, " .$row[2] . "!";
    require_once "usershome.php";
}

} 
else {
    echo "Please log in first to see users page.";
    require_once "user_login.php";
}
?>