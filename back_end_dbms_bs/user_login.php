<html>
<head>
	<title>Bus Management System</title>
	<link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >

	<style>
		
			a:link, a:visited {
  background-color: #2196F3;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 25px;
  margin-right:  10px;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    font-family: "Comic Sans MS", cursive, sans-serif;
}
a:hover, a:active {
  background-color: #0b7dda;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
		
	</style>
</head>
<body >
	<br><br>
	<center>
		<h1 class="heading">Welcome to Bus Booking Database Management Platform</h1>
		<p class = "heading">Please Login to Manage BusBooking Database</p>
		<?php 
		session_start();
			if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true){
				unset($_SESSION["loggedin"]);
				unset($_SESSION["username"]);
				echo "<center><h3>logged out succesfully...</h3></center>\n";
			}			
		?>
		<form  action="user_login-backend.php" method = "POST" class="column container">
			<label>username:</label>
			<input name = "username" placeholder = "Username" type="text"><br><br>
			<label>Password:</label>
			<input name = "password" type = "password" placeholder = "Password"><br><br>
			<button class="btn success" type = "submit">Submit</button>   <button class="btn danger" type = "reset">Clear</button>
	    </form>
		<form action="reg_user.php" method ="POST" class= "create_new_user_bttn">
			<br /><button class="create_user" type ="submit">Create new User</button>	
		</form>
	</center>
</body>
</html> 

