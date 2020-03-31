<?php
    require_once "dbconnect.php";
    session_start();
    if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]==true){
        $vehicle_no_bn=json_decode(htmlspecialchars_decode($_POST["vehicle_no_bn"]));
        $model_name_name_bn=json_decode(htmlspecialchars_decode($_POST["model_name_name_bn"]));
        $source_arrv_name_bn=json_decode(htmlspecialchars_decode($_POST["source_arrv_name_bn"]));
        $dest_arrv_name_bn=json_decode(htmlspecialchars_decode($_POST["dest_arrv_name_bn"]));
        $source_dept_name_bn=json_decode(htmlspecialchars_decode($_POST["source_dept_name_bn"]));
        $dest_dept_name_bn=json_decode(htmlspecialchars_decode($_POST["dest_dept_name_bn"]));
        $route_name_name_bn=json_decode(htmlspecialchars_decode($_POST["route_name_name_bn"]));
        $bus_id_name_bn=json_decode(htmlspecialchars_decode($_POST["bus_id_name_bn"]));
        $source_code_name_bn=json_decode(htmlspecialchars_decode($_POST["source_code_name_bn"]));
        $dest_code_name_bn=json_decode(htmlspecialchars_decode($_POST["dest_code_name_bn"]));
        $index =$_POST["no_of_buses"];
        $n_passengers=$_POST["no_of_passengers"];
        $contact_no=$_POST["contact_no"];

        $created_by=$_SESSION["username"];

        $number=$_SESSION["ticket_no"];
        $query_ticket=mysqli_query($con,"SELECT Ticket.Ticket_id FROM Ticket WHERE Ticket.Ticket_id=$number");
        $num_rand=mysqli_num_rows($query_ticket);
        $_SESSION["ticket_no"]=$_SESSION["ticket_no"]+1;
        $total_fare =0;
        $query_f="SELECT (Model.farepkm*(d.dis_from_source_in_km-s.dis_from_source_in_km)) as fare FROM Bus,Route as s,Route as d, Model,Travel_on WHERE Model.Model_name='{$model_name_name_bn[$index]}' and Bus.Bus_id={$bus_id_name_bn[$index]} and Bus.Model_name=Model.Model_name and s.station_code='{$source_code_name_bn[$index]}' and d.station_code='{$dest_code_name_bn[$index]}' and Bus.Bus_id=Travel_on.Bus_id and s.Route_id=Travel_on.Route_id and d.Route_id=Travel_on.Route_id and s.Route_id=d.Route_id";
        $query_fare=mysqli_query($con,$query_f);
        $num_RES=mysqli_num_rows($query_fare);
        $row_fare=mysqli_fetch_array($query_fare);
        $total_fare=$row_fare[0]*$n_passengers;
        $add_ticket=mysqli_query($con,"INSERT INTO Ticket(Ticket_id,Bus_id,Source_code,Dest_code,total_fare,created_by,contact_no,no_of_pass) VALUES ('$number','{$bus_id_name_bn[$index]}','{$source_code_name_bn[$index]}','{$dest_code_name_bn[$index]}','$total_fare','$created_by','$contact_no','$n_passengers')");
        if(!($add_ticket))echo("Error description: ".mysqli_error($con));
    }
    else{
        echo "Please log in first to see users page.";
        require_once "users_login.php";
    }
?>

<html>
<head>
    <title>Bus Mangement System | Book_Now</title>
    <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >
</head>
<body>
    <div class="heading">
        <h1>Bus Booking Platform<- Book_Now</h1>
    </div>
    <div class="options">
      <a class="=home" href="./home.php">HOME</a>
      <a class="=book_ticket" href="./book_ticket.php">BOOK TICKET</a> 
      <a class="=Register_admin" href="./reg_admin.php">REGISTER ADMIN</a> 
      <a class="=Register_user" href="./reg_user.php">REGISTER USER</a> 
      <a class="=Login_admin" href="./admin_login.php">LOGIN ADMIN</a> 
      <a class="=Login_user" href="./user_login.php">LOGIN USER</a>
    </div>

    <label>Book Ticket For Bus : 
            <?php
                echo "($source_arrv_name_bn[$index] --> $dest_arrv_name_bn[$index]) Model :$model_name_name_bn[$index]";
            ?> 
        </label>

    <form action="book_ticket-backend.php" method="POST" class="container" >
                
                <?php 
                    require_once "dbconnect.php";
                    echo "<label>Bus:$bus_id_name_bn[$index]<label><br>";
                    echo "<label>Model:$model_name_name_bn[$index]<label><br>";
                    echo "<label>Source-code:$source_code_name_bn[$index]<label><br>";
                    echo "<label>Destination code:$dest_code_name_bn[$index]<label><br>";
                    echo "<label>-----------------------------------------------------------------</label>";
                    echo "<label>Total_fare:$total_fare<label><br>";
                    
                    
                    echo "<input type=\"hidden\" name=\"bus_id_ticket\" value=\"$bus_id_name_bn[$index]\">";
                    echo "<input type=\"hidden\" name=\"contact_no\" value=\"$contact_no\">";
                    echo "<input type=\"hidden\" name=\"model_name_ticket\" value=\"$model_name_name_bn[$index]\">";
                    echo "<input type=\"hidden\" name=\"source_code_ticket\" value=\"$source_code_name_bn[$index]\">";
                    echo "<input type=\"hidden\" name=\"dest_code_ticket\" value=\"$dest_code_name_bn[$index]\">";
                    echo "<input type=\"hidden\" name=\"fare_per_person\" value=\"$total_fare\">";
                    echo "<input type=\"hidden\" name=\"n_pass\" value=\"$n_passengers\">";



                ?> 
                <button class="btn success" type = "submit">Pay</button>
                
                
            </form>

    </body>
    </html>

