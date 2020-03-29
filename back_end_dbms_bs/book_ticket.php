<?php   
    if(isset($_POST['SubmitButton'])){
        $source = $_POST["source_station"];
        $dest=$_POST["dest_station"];
        $quer="SELECT Bus.vehicle_no,Bus.Model_name,a.arrv_time as source_arrv,a.dept_time as source_dept,b.arrv_time as dest_arrv,b.dept_time as dest_dept,ALL_ROUTES.Route_name FROM Route as r,Route as s,Travel_on,Travels_through as a,Travels_through as b,ALL_ROUTES,Bus WHERE r.station_code='$source' and s.station_code='$dest'and r.dis_from_source_in_km <=s.dis_from_source_in_km and r.Route_id=s.Route_id and r.Route_id=Travel_on.Route_id and Travel_on.Bus_id=a.Bus_id and Travel_on.Bus_id=b.Bus_id and a.station_code=r.station_code and b.station_code=s.station_code and ALL_ROUTES.Route_id=r.Route_id and Bus.Bus_id=Travel_on.Bus_id ORDER BY Travel_on.Bus_id";
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
      <a class="=home" href="./home.php">HOME</a>
      <a class="=book_ticket" href="./book_ticket.php">BOOK TICKET</a> 
      <a class="=Register_admin" href="./reg_admin.php">REGISTER ADMIN</a> 
      <a class="=Register_user" href="./reg_user.php">REGISTER USER</a> 
      <a class="=Login_admin" href="./admin_login.php">LOGIN ADMIN</a> 
      <a class="=Login_user" href="./user_login.php">LOGIN USER</a>
    </div>
    <?php
        require_once "dbconnect.php";
        $username = "guest@guest";
        $password = "lol";
        $password=md5($password);
        $query = "SELECT * FROM users WHERE username='$username' and password='$password'";

        $result = mysqli_query($con, $query);
        $row=mysqli_fetch_array($result);
        $numResults = mysqli_num_rows($result);

        if($numResults == 1)
        {
            $query = "UPDATE users SET user_login_count = user_login_count + 1 WHERE username='$username'";
            mysqli_query($con, $query);
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            echo "<h3>Hi '{$_SESSION['username']}' !</h3>";
        }
        else
        {
            echo "<br><br><br><h1>Invalid credentials!</h1>";
        }
    ?>

    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class= "container">
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
        <label> Desitanation Station : </label>
        <select name="dest_station" id="dest_station">
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
			<button class="btn success" type = "submit" name="SubmitButton">Search buses</button>
    </form>
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
                echo "<form action=\"book_now.php\" method=\"POST\" class=\"container\">";
                echo "<table><tr><th>Vehicle_no</th><th>Model</th><th>source_arrv</th><th>source_dept</th><th>dest_arrv</th><th>dest_dept</th><th>Route Name</th></tr>";
                while($query_row=mysqli_fetch_array($res_query)){
                    echo "<tr><td name=\"vehicle_no_name\">'{$query_row[0]}'</td><td>'{$query_row[1]}'</td><td>'{$query_row[2]}'</td><td>'{$query_row[3]}'</td><td>'{$query_row[4]}'</td><td>'{$query_row[5]}'</td><td name=\"Route_name\">'{$query_row[6]}'</td><td><button class=\"btn success\" type = \"submit\">Book_now</button></td></tr>";
                }
                echo "</table>";
                echo "</form>";
            }
        }
    ?>




</body>
</html>