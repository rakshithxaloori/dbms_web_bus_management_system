<?php

require_once 'dbconnect.php';
$username = $_POST["username"];
$password = $_POST["password"];
$password=md5($password);
$query = "SELECT * FROM users WHERE username='$username' and password='$password'";

$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	$query = "UPDATE users SET user_login_count = user_login_count + 1 WHERE username='$username'";
	mysqli_query($con, $query);
	require_once"usershome.php";

}
else
{
	echo "<br><br><br><center><h1>Invalid credentials!</h1></center>";
}

?>
