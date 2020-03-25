<?php 
require_once 'dbconnect.php';
$name=$_POST["name"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$contact=$_POST["contact"];
$email=$_POST["email"];
$password= $_POST["password"];
//hash th password
 $password=md5($password);

$query = "SELECT * FROM users WHERE username='$email'";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	echo "<br><br><br><center><h1>Your Email is Already registered!</h1></center>";
}
else
{   
	//require_once 'dbconnect.php';
	echo'<center><h2 style="color:white;background-color:#333;">Successfully Registered</h2></center>';
	$sql=mysqli_query($con, "insert into users (username,password,name,age,gender,contact) values ('$email', '$password', '$name','$age','$gender','$contact')");
	if($sql)require_once"home.php";
    else echo("Error description: ".mysqli_error($con)); 
}

?>

