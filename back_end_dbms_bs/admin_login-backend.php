<?php

require_once 'dbconnect.php';
$admin_username = $_POST["username"];
$admin_password = $_POST["password"];
$query = "SELECT * FROM admins WHERE username='$admin_username' and password='$admin_password'";

$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	$query = "UPDATE admins SET admin_login_count = admin_login_count + 1 WHERE username='$admin_username'";
	mysqli_query($con, $query);
	require_once"adminshome.php";

}
else
{
	echo "<br><br><br><center><h1>Invalid credentials!</h1></center>";
}

?>
