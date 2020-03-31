<?php
    if(isset($_POST['SubmitButton'])){
        $source = $_POST["source_station"];
        $dest=$_POST["dest_station"];    
        $quer="SELECT Bus.vehicle_no,Bus.Model_name,a.arrv_time as source_arrv,a.dept_time as source_dept,b.arrv_time as dest_arrv,b.dept_time as dest_dept,ALL_ROUTES.Route_name,Bus.Bus_id,s.station_code as dest,r.station_code as source,Bus.Capacity FROM Route as r,Route as s,Travel_on,Travels_through as a,Travels_through as b,ALL_ROUTES,Bus WHERE r.station_code='$source' and s.station_code='$dest'and r.dis_from_source_in_km <=s.dis_from_source_in_km and r.Route_id=s.Route_id and r.Route_id=Travel_on.Route_id and Travel_on.Bus_id=a.Bus_id and Travel_on.Bus_id=b.Bus_id and a.station_code=r.station_code and b.station_code=s.station_code and ALL_ROUTES.Route_id=r.Route_id and Bus.Bus_id=Travel_on.Bus_id ORDER BY Travel_on.Bus_id";
    }
    else{
        $quer=NULL;
    }
?>
<html>
<head>
    <title>Bus Mangement System | Book_Ticket</title>
    <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >
</head>
<body>
    <div class="heading">
        <h1>Bus Booking Platform<- Book_Ticket</h1>
    </div>
    <div class="options">
            <a href="book_ticket.php" type="submit" >Book ticket</a>
            <a href="see_history.php" type="submit" >History</a>
            
            <a href="user_login.php" type="submit" >Logout</a>
    </div>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class= "container" name="Book_now">
        <label>Source Station : </label>
        <select name="source_station" id="source_station">
            <?php 
                require_once "dbconnect.php";
                $query="SELECT * FROM Station ORDER BY Station_Name";
                $result = mysqli_query($con, $query);
                $numResults = mysqli_num_rows($result);

                if($numResults==0){
                  echo'<center><h3 style="color:white;background-color:#333;">No Stations created create_new!</h3></center>';
                  require_once "add_station.php";
                  // echo "<form action=\"add_model.php\" method =\"POST\" class=\"if_no_models\"><button class=\"btn success\" type = \"submit\">Create Model</button></form>"
                }
                else{
                while ($row=mysqli_fetch_array($result)) {
                    //printf("ID: %s  Name: %s", $row[0], $row[1]);  
                    echo "<option value=\"{$row[0]}\">{$row[0]}-{$row[2]}</option>";
                    }
                }
            ?>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label> Destination Station : </label>
        <select name="dest_station" id="dest_station">
            <?php 
                require_once "dbconnect.php";
                $query="SELECT * FROM Station ORDER BY Station_Name";
                $result = mysqli_query($con, $query);
                $numResults = mysqli_num_rows($result);

                if($numResults==0){
                  echo'<center><h3 style="color:white;background-color:#333;">No Stations created !</h3></center>';
                //   require_once "add_station.php";
                  // echo "<form action=\"add_model.php\" method =\"POST\" class=\"if_no_models\"><button class=\"btn success\" type = \"submit\">Create Model</button></form>"
                }
                else{
                while ($row=mysqli_fetch_array($result)) {
                    //printf("ID: %s  Name: %s", $row[0], $row[1]);  
                    echo "<option value=\"{$row[0]}\">{$row[0]}-{$row[2]}</option>";
                    }
                }
            ?>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn success" type = "submit" name="SubmitButton">Search buses</button>
    </form>
    <form action="book_now.php" method="POST" class="container" >
    <?php 
        require_once "dbconnect.php";
        if($quer!=NULL)
        {
            $res_query=mysqli_query($con,$quer);
            $num_query=mysqli_num_rows($res_query);
            if($num_query==0 || $source==$dest){
            echo "<h3>No_buses</h3>";
            }
            else{
                $vehicle_no_bn=array();
                $model_name_name_bn=array();
                $source_arrv_name_bn=array();
                $source_dept_name_bn=array();
                $dest_arrv_name_bn=array();
                $dest_dept_name_bn=array();
                $route_name_name_bn=array();
                $bus_id_name_bn=array();
                $source_code_name_bn=array();
                $dest_code_name_bn=array();
                $j=0;
                echo "<table><tr><th>Bus_no</th><th>Vehicle_no</th><th>Model</th><th>source_arrv</th><th>source_dept</th><th>dest_arrv</th><th>dest_dept</th><th>Route Name</th><th>Remaining seats</th></tr>";
                while($query_row=mysqli_fetch_array($res_query)){
                    if($query_row[10]>0){
                        array_push($vehicle_no_bn,$query_row[0]);
                        array_push($model_name_name_bn,$query_row[1]);
                        array_push($source_arrv_name_bn,$query_row[2]);
                        array_push($source_dept_name_bn,$query_row[3]);
                        array_push($dest_arrv_name_bn,$query_row[4]);
                        array_push($dest_dept_name_bn,$query_row[5]);
                        array_push($route_name_name_bn,$query_row[6]);
                        array_push($bus_id_name_bn,$query_row[7]);
                        array_push($source_code_name_bn,$query_row[9]);
                        array_push($dest_code_name_bn,$query_row[8]);
                        $j=$j+1;

                        echo "<tr><td>$j.</td><td>{$query_row[0]}</td><td>{$query_row[1]}</td><td>{$query_row[2]}</td><td>{$query_row[3]}</td><td>{$query_row[4]}</td><td>{$query_row[5]}</td><td name=\"Route_name\">{$query_row[6]}</td><td>{$query_row[10]}</td></tr>";
                    }
                    
                }
                echo "<tr><td><label>Contact_no</label><input type=\"text\" name=\"contact_no\" /></td></tr>";
                echo "</table>";
                echo '<input type="hidden" name="vehicle_no_bn" value="'.htmlspecialchars(json_encode($vehicle_no_bn)).'">';
                echo '<input type="hidden" name="model_name_name_bn" value="'.htmlspecialchars(json_encode($model_name_name_bn)).'">';
                echo '<input type="hidden" name="source_arrv_name_bn" value="'.htmlspecialchars(json_encode($source_arrv_name_bn)).'">';
                echo '<input type="hidden" name="source_dept_name_bn" value="'.htmlspecialchars(json_encode($source_dept_name_bn)).'">';
                echo '<input type="hidden" name="dest_arrv_name_bn" value="'.htmlspecialchars(json_encode($dest_arrv_name_bn)).'">';
                echo '<input type="hidden" name="dest_dept_name_bn" value="'.htmlspecialchars(json_encode($dest_dept_name_bn)).'">';
                echo '<input type="hidden" name="route_name_name_bn" value="'.htmlspecialchars(json_encode($route_name_name_bn)).'">';
                echo '<input type="hidden" name="bus_id_name_bn" value="'.htmlspecialchars(json_encode($bus_id_name_bn)).'">';
                echo '<input type="hidden" name="dest_code_name_bn" value="'.htmlspecialchars(json_encode($dest_code_name_bn)).'">';
                echo '<input type="hidden" name="source_code_name_bn" value="'.htmlspecialchars(json_encode($source_code_name_bn)).'">';

            }
        }
    ?>
    <label>Select Bus:</label>
    <select name="no_of_buses" >
        <?php 
            for ($k=0; $k <$j ; $k++) { 
                echo "<option value= '$k'>Bus-$k-{$vehicle_no_bn[$k]}</option>";
            }
        ?>
    </select>
    <label>No of Passengers:</label>
    <input type="number" name="no_of_passengers" />
    <button class="btn success" type = "submit">Submit</button>   

    </form>


</body>
</html>