
<html>
<head>
  <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >
  <title>Bus Mangement System | AddStation</title>
  
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
} -->
		
	</style>
</head>
    <body>
    	<div class="heading">
    		<h1>Bus Booking Platform<-AddStation</h1>
        </div>
        
        <div class="options">
            <a href="add_station.php">Add Station</a>
            <a href="add_model.php" type="submit">Add Model</a>
            <a href="add_bus.php" type="submit">Add Bus</a>
            <a href="add_route.php" type="submit">Add Route</a>
            <a href="assign_bus.php" type="submit">Assign Bus</a>
            <a href="admin_login.php" type="submit">Logout</a>

    	  </div>

    <form action="add_station-backend.php" method="POST" class ="container">
      <center>
        <label>Station Code:</label>
        <input name = "station_code" placeholder = "Station code" type="text"><br><br>
        <label>Place:</label>
        <input name = "place" placeholder = "Place" type="text"><br><br>
        <label>Station Name:</label>
        <input name = "station_name" placeholder = "Station_name" type="text"><br><br>

        <button class="btn success" type = "submit">Create Station</button>   <button class="btn danger" type = "reset">Clear</button>
      </center>
    </form>
</body>
</html>