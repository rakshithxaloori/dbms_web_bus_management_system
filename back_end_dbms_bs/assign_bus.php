
<html>
<head>
  <title>Bus Mangement System | Assign_bus</title>
  <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >
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
        <h1>Bus Booking Platform<-AssignBus</h1>
</div>

        <div class="options">
            <a href="add_station.php">Add Station</a>
            <a href="add_model.php" type="submit">Add Model</a>
            <a href="add_bus.php" type="submit">Add Bus</a>
            <a href="add_route.php" type="submit">Add Route</a>
            <a href="assign_bus.php" type="submit">Assign Bus</a>
            <a href="admin_login.php" type="submit">Logout</a>

        </div>
      <div class=assignbusclasses>  
      <div class="buses_remaining">
        <h2>Buses free to assign route:</h2>
        <?php 
            require_once "dbconnect.php";
            $res=mysqli_query($con,"SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
            $numR=mysqli_num_rows($res);
            if($numR==0){
              echo "<h2>NO BUSES !</h1>";
            }
            else{
              $echo_stm="<table class=\"Buses_free\"><tr><th>Bus_id</th><th>Capacity</th><th>Vehicle_no</th><th>Model_name</th><th>created_by</th></tr>";
              while($rows=mysqli_fetch_array($res)){
                $echo_stm=$echo_stm."<tr><td>{$rows[0]}</td><td>{$rows[1]}</td><td>{$rows[2]}</td><td>{$rows[3]}</td><td>{$rows[4]}</td></tr>";
              }
              $echo_stm=$echo_stm."</table>";
              echo $echo_stm;
            }
        ?>
      </div>

      <div class="Buses_assigned">
      <h2>Assigned Buses:</h2>
      <?php 
          require_once "dbconnect.php";
          $res2=mysqli_query($con,"SELECT b.Bus_id,b.vehicle_no,b.Capacity,b.Model_name,t.Route_id,ar.Route_name FROM Bus as b,Travel_on as t,ALL_ROUTES as ar where ar.Route_id=t.Route_id and b.Bus_id=t.Bus_id and b.Bus_id in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
          $numR2=mysqli_num_rows($res2);
          if($numR2==0){
            echo "<h2>NO BUSES Assigned !</h1>";
          }
          else{
            $st="<table class=\"buses_ass\"><tr><th>Bus_id</th><th>Vehicle_no</th><th>Capacity</th><th>Model_Name</th><th>Route_id</th><th>Route_Name</th></tr>";
             while($rows2=mysqli_fetch_array($res2)){
              $st=$st."<tr><td>{$rows2[0]}</td><td>{$rows2[1]}</td><td>{$rows2[2]}</td><td>{$rows2[3]}</td><td>{$rows2[4]}</td><td>{$rows2[5]}</td></tr>";
              // echo "{$rows2[2]}";
             }
            $st=$st."</table>";
            echo $st;
          }
      ?>
            
      </div>
      <div class="routes_available">
        <h2>Routes Available:</h2>
        <?php 
          require_once "dbconnect.php";
          $get_routes="SELECT DISTINCT Route_id from Route ORDER BY Route_id;";
          $result_routes = mysqli_query($con, $get_routes);
          $numResults_routes=mysqli_num_rows($result_routes);
          
          // $flag=0;
          if($numResults_routes==0){
            echo "<h3>No routes are created!</h3>";
          }
          else{
            // $flag=1;
            $echo_st="<table class=\"Routes_avail\"><tr><th>Route_id</th><th>Route_name</th></tr>";
            while($row_routes=mysqli_fetch_array($result_routes)){
              $get_sd="( SELECT * FROM Route WHERE Route_id = '{$row_routes[0]}' ORDER by dis_from_source_in_km ASC LIMIT 1) union ALL (SELECT * FROM Route WHERE Route_id = '{$row_routes[0]}' ORDER by dis_from_source_in_km DESC LIMIT 1);";
              $result_sd=mysqli_query($con, $get_sd);
              $numResults_sd=mysqli_num_rows($result_routes);

              $row_sd=mysqli_fetch_array($result_sd);
              
              $get_station="SELECT * FROM Station WHERE station_code='{$row_sd[1]}'";
              $result=mysqli_query($con,$get_station);
            
              $row=mysqli_fetch_array($result);
              $source=$row[2]." (".$row[0].")";

              $row_sd=mysqli_fetch_array($result_sd);
      
              $get_station1="SELECT * FROM Station WHERE station_code='{$row_sd[1]}'";
              $result1=mysqli_query($con,$get_station1);

              $row=mysqli_fetch_array($result1);
              $dest=$row[2]." (".$row[0].")";

              $route_name=$source." --> ".$dest;

              // echo "<h4>$route_name</h4>";
              $echo_st=$echo_st."<tr><td>{$row_routes[0]}</td><td>$route_name</td></tr>" ;
              $r=mysqli_query($con,"SELECT * FROM ALL_ROUTES WHERE Route_id='{$row_routes[0]}'");
              $numRs=mysqli_num_rows($r);
              if(!($numRs==1)){
                $sql = "INSERT INTO ALL_ROUTES (Route_id, Route_name)
                VALUES('{$row_routes[0]}', '$route_name')";
                $SQ=mysqli_query($con,$sql);
                if(!$SQ) require_once "assign_bus.php";
                //echo("Error description: ".mysqli_error($con));  
              }
            }
            $echo_st=$echo_st."</table>";
            echo $echo_st;
          }

        ?>
      </div>
      <div class = "Assign">
      <h3>Assign Buses with Route:</h3>
      <form action="assign_bus-backend.php" method="POST" class ="container">
        <label>Assign Bus:</label>
        <select class= assign_bus_select name ="ass_bus">
        <?php 
              require_once "dbconnect.php";
              $res1=mysqli_query($con,"SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
              $numR1=mysqli_num_rows($res1);
              if($numR1==0){
                echo "<h2>NO BUSES to be Assigned!</h1>";
              }
              else{
                while($rows1=mysqli_fetch_array($res1)){
                  echo "<option value=\"{$rows1[0]}\">{$rows1[0]}</option>";
                }
              }
          ?>
        </select>
        <label>Assign Route:</label>
        <select class= assign_route_select name="ass_route">
          <?php 
            require_once "dbconnect.php";
            $get_routes1="SELECT DISTINCT Route_id from Route ORDER BY Route_id;";
            $result_routes1 = mysqli_query($con, $get_routes1);
            $numResults_routes1=mysqli_num_rows($result_routes1);
        
            if($numResults_routes1==0){
            echo "<h3>No routes are created!</h3>";
            }
            else{
            while($row_routes1=mysqli_fetch_array($result_routes1)){
                echo "<option value=\"{$row_routes1[0]}\">{$row_routes1[0]}</option>";
              }
            }
          ?>
        </select><br><br>
        <label>Start_Time:</label>
        <input type ="time" placeholder="start_time" name="start_time"></input><br><br>
        <label>Break_time:</label>
        <input type="time" placeholder="break_time" name="break_time"></input><br><br>

        <button class="btn success" type = "submit">AssignBus</button>

      </form>
    </div>
    <div classgit comi="Delete_buses_assigned">
      <h2>Remove Buses assigned:</h2>
      <form action = "deletebusroute-backend.php" method="POST" class="remove_bus_ass">
      <label>Remove Bus:</label>
        <select class= remove_bus_select name ="rem_bus">
        <?php 
              require_once "dbconnect.php";
              $res2=mysqli_query($con,"SELECT * FROM Bus as b where b.Bus_id  in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
              $numR2=mysqli_num_rows($res2);
              if($numR2==0){
                echo "<h2>NO BUSES Assigned !</h1>";
              }
              else{
                while($rows2=mysqli_fetch_array($res2)){
                  echo "<option value=\"{$rows2[0]}\">{$rows2[0]}</option>";
                }
              }
          ?>
        </select>
        <button class="btn success" type = "submit">RemoveBus</button>

      </form>        
    </div>
    </div>
</body>
</html>