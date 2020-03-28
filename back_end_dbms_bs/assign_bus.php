
<html>
<head>
	<link rel="stylesheet" type="text/css" href="layoutsstyle.css">
	<title>Bus Mangement System | Assign_bus</title>
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
    		<h1>Bus Booking Platform<-AddStation</h1>

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
                if(!$SQ) echo("Error description: ".mysqli_error($con));  
              }
            }
            $echo_st=$echo_st."</table>";
            echo $echo_st;
          }

        ?>
      </div>
      <div class = "Assign">
      <h2>Assign Buses with Route</h2>
      <form action="assign_bus-backend.php" method="POST" class ="a_adddetails">
        <label>Assign Bus:</label>
        <select class= assign_bus_select name ="ass_bus">
        <?php 
              require_once "dbconnect.php";
              $res1=mysqli_query($con,"SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
              $numR1=mysqli_num_rows($res1);
              if($numR1==0){
                echo "<h2>NO BUSES !</h1>";
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
            // require_once "dbconnect.php";
            // $res=mysqli_query($con,"SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;");
            // $numR=mysqli_num_rows($res);
            // if($numR==0){
            //   echo "<h2>NO BUSES !</h1>";
            // }
            // else{
            //   while($rows=mysqli_fetch_array($res)){
            //     echo "<option value=\"{$res[0]}\">{$res[0]}</option>";
            //   }
            // }
            require_once "dbconnect.php";
            $get_routes1="SELECT DISTINCT Route_id from Route ORDER BY Route_id;";
            $result_routes1 = mysqli_query($con, $get_routes1);
            $numResults_routes1=mysqli_num_rows($result_routes1);
        
            // $flag=0;
            if($numResults_routes1==0){
            echo "<h3>No routes are created!</h3>";
            }
            else{
            while($row_routes1=mysqli_fetch_array($result_routes1)){
                echo "<option value=\"{$row_routes1[0]}\">{$row_routes1[0]}</option>";
              }
            }
          ?>
        </select>
        <button class="btn success" type = "submit">AssignBus</button>   <button class="btn danger" type = "reset">Clear</button>
        
      </form>
    </div>
</body>
</html>