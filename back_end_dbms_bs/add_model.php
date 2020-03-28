
<html>
<head>
  <link rel="stylesheet" type="text/css" href="layoutsstyle.css">
  <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >

	<title>Bus Mangement System | AddModel</title>
	<!-- <style>
		
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
		
	</style> -->
</head>
    <body>
    	<div class="heading">
    		<h1>Bus Booking Platform<-AddModel</h1>
        </div>

        <!-- <div class="admins_top_nav">

          <form action="add_station.php" method="POST" class="a_topnav">
            <button class="a_add_station" type="submit">Add Station</button>
          </form>
          <form action="add_model.php" method="POST" class="a_topnav">
            <button class="a_add_model" type="submit">Add Model</button>
          </form>
          <form action="add_bus.php" method="POST" class="a_topnav">
            <button class="a_add_bus" type="submit">Add Bus</button>
          </form>
          <form action="add_route.php" method="POST" class="a_topnav">
            <button class="a_add_route" type="submit">Add Route</button>
          </form>
          <form action="assign_bus.php" method="POST" class="a_topnav">
            <button class="assign_bus" type="submit">Assign Bus</button>
          </form>
          <form action="admin_login.php" method = "POST" class="a_topnav">
            <button class="a_logout" type="submit">Logout</button>
          </form>

    	  </div>  -->
        <div class="options">
            <a href="add_station.php">Add Station</a>
            <a href="add_model.php" type="submit">Add Model</a>
            <a href="add_bus.php" type="submit">Add Bus</a>
            <a href="add_route.php" type="submit">Add Route</a>
            <a href="assign_bus.php" type="submit">Assign Bus</a>
            <a href="admin_login.php" type="submit">Logout</a>

    	  </div>

    <form action="add_model-backend.php" method="POST" class ="container">
      <center>
        <label>Model_Name:</label>
        <input name = "model_name" placeholder = "Model name" type="text"><br><br>
        <label>farepkm:</label>
        <input name = "farepkm" placeholder = "" type="text"><br><br>

        <button class="btn success" type = "submit">Create model</button>   <button class="btn danger" type = "reset">Clear</button>
      </center>
    </form>
</body>
</html>