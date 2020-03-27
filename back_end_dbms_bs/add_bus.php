
<html>
<head>
	<link rel="stylesheet" type="text/css" href="layoutsstyle.css">
	<title>Bus Mangement System | AddBus</title>
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
  
    <body>
    	<div class="header">
    		<h1>Bus Booking Platform<-AddBus</h1>
        <div class="admins_top_nav">
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
    	  </div>
    </div>

    <form action="add_bus-backend.php" method="POST" class ="a_adddetails" id="busform">
      <center>
        <label>Bus id:</label>
        <input name = "bus_id" placeholder = "Bus id" type="number"><br><br>
        <label>Capacity:</label>
        <input name = "capacity" placeholder = "Capacity" type="number"><br><br>
        <label>Vehicle No:</label>
        <input name = "vehicle_no" placeholder = "Vehicle no" type="text"><br><br>
        <label>Model:</label>
        <select id="models" name="model_lists" form="busform">
        <?php 
          require_once "dbconnect.php";
          $query="SELECT * FROM Model ORDER BY Model_name";
          $result = mysqli_query($con, $query);
          $numResults = mysqli_num_rows($result);

          if($numResults==0){
            echo'<center><h3 style="color:white;background-color:#333;">No models created create_new!</h3></center>';
            require_once "dbconnect.php";
            // echo "<form action=\"add_model.php\" method =\"POST\" class=\"if_no_models\"><button class=\"btn success\" type = \"submit\">Create Model</button></form>"
          }
          else{
          while ($row=mysqli_fetch_array($result)) {
              //printf("ID: %s  Name: %s", $row[0], $row[1]);  
              echo "<option value=\"{$row[0]}\">{$row[0]}</option>";
          }
        }
      ?>
        </select><br><br> 
        <button class="btn success" type = "submit">create bus</button>   <button class="btn danger" type = "reset">Clear</button>
      </center>
</form>
</body>
</html>