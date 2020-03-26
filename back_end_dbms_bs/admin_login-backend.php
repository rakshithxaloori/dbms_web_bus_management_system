<?php

require_once 'dbconnect.php';
$admin_username = $_POST["username"];
$admin_password = $_POST["password"];
$admin_password=md5($admin_password);

$query = "SELECT * FROM admins WHERE username='$admin_username' and password='$admin_password'";

$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	$query = "UPDATE admins SET admin_login_count = admin_login_count + 1 WHERE username='$admin_username'";
	mysqli_query($con, $query);
	require_once"adminshome.php";
	session_start();
	$_SESSION['a_loggedin']=true;
	$_SESSION['a_username']=$admin_username;
	require_once "adminshome-backend.php";

}
else
{
	echo "<br><br><br><h3>Invalid credentials!</h3>";
	require_once "admin_login.php";

}

?>
