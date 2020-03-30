<?php
    // function insert_ticket($con,$ticket_no,$Bus_id,$Source_code,$Dest_code,$model_name,$created_by,$contact_no){
    //     // $bus_id_=strval($Bus_id);
    //     // echo $model_name;
    //     // $query_f="SELECT (Model.farepkm*(d.dis_from_source_in_km-s.dis_from_source_in_km)) as fare FROM Bus,Route as s,Route as d, Model,Travel_on WHERE Model.Model_name='$model_name' and Bus.Bus_id=4 and Bus.Model_name=Model.Model_name and s.station_code='$Source_code' and d.station_code='$Dest_code' and Bus.Bus_id=Travel_on.Bus_id and s.Route_id=Travel_on.Route_id and d.Route_id=Travel_on.Route_id and s.Route_id=d.Route_id";
    //     // $query_fare=mysqli_query($con,$query_f);
    //     // $num_RES=mysqli_num_rows($query_fare);
    //     // echo $num_RES;
    //     // if($num_RES>0){
    //         // $row_fare=mysqli_fetch_array($query_fare);
    
    //         // $total_fare=$row_fare[0]*$n_passengers;
        
       
    //     // }
        
    
    // }
    require_once "dbconnect.php";
    session_start();
    if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]==true){
        $vehicle_no =$_POST["vehicle_no_name"];
        $model=$_POST["model_name_name"];
        $source_arrv=$_POST["source_arrv_name"];
        $sourec_dept=$_POST["source_dept_name"];
        $dest_arrv=$_POST["dest_arrv_name"];
        $dest_dept=$_POST["dest_dept_name"];
        $route_name=$_POST["route_name_name"];
        $bus_id=$_POST["bus_id_name"];
        $source_code=$_POST["source_code_name"];
        $dest_code=$_POST["dest_code_name"];
        $contact_no=$_POST["contact_no"];

        $created_by=$_SESSION["username"];

        // while(1)
            // {
                $number=$_SESSION["ticket_no"];
                $query_ticket=mysqli_query($con,"SELECT Ticket.Ticket_id FROM Ticket WHERE Ticket.Ticket_id=$number");
                $num_rand=mysqli_num_rows($query_ticket);
                $_SESSION["ticket_no"]=$_SESSION["ticket_no"]+1;
            // }    
        $total_fare =0;
        $add_ticket=mysqli_query($con,"INSERT INTO Ticket(Ticket_id,Bus_id,Source_code,Dest_code,total_fare,created_by,contact_no) VALUES ('$number','$bus_id','$source_code','$dest_code','$total_fare','$created_by','$contact_no')");
        if(!($add_ticket))echo("Error description: ".mysqli_error($con));
        // insert_ticket($con,$number,$bus_id,$source_code,$dest_code,$model,$created_by,$contact_no);    
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
                echo "($source_arrv --> $dest_arrv) Model :$model";
            ?> 
        </label>

    <form action="book_ticket-backend.php" method="POST" class="container" >
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <th>Passenger_no|</th>
                        <th>----------------Name---------------|</th>
                        <th>Age</th>
                        <th>Gender</th>
                    </tr>
                    <br>
                    <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_1" id="p_no" type="hidden" value="1"/>
                                    <label>1.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_1"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_1"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_1"/>
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_2" id="p_no" type="hidden" value="1"/>
                                    <label>2.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_2"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_2"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_2"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_3" id="p_no" type="hidden" value="1"/>
                                    <label>3.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_3"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_3"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_3"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_4" id="p_no" type="hidden" value="1"/>
                                    <label>4.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_4"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_4"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_4"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_5" id="p_no" type="hidden" value="1"/>
                                    <label>5.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_5"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_5"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_5"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>                        
                            <div class="field-wrap">
                                    <input name = "p_no_6" id="p_no" type="hidden" value="1"/>
                                    <label>6.</label>
                            </div>
                        </td>

                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_name_6"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="number"required autocomplete="off" name="p_age_6"/>
                            </div>
                        </td>
                        <td>
                            <div class="field-wrap">
                                <input type="text"required autocomplete="off" name="p_gender_6"/>
                            </div>
                        </td>
                    </tr> -->
                </table>
                <br>
                <?php 
                    require_once "dbconnect.php";
                    $query_f="SELECT (Model.farepkm*(d.dis_from_source_in_km-s.dis_from_source_in_km)) as fare FROM Bus,Route as s,Route as d, Model,Travel_on WHERE Model.Model_name='$model' and Bus.Bus_id=$bus_id and Bus.Model_name=Model.Model_name and s.station_code='$source_code' and d.station_code='$dest_code' and Bus.Bus_id=Travel_on.Bus_id and s.Route_id=Travel_on.Route_id and d.Route_id=Travel_on.Route_id and s.Route_id=d.Route_id";
                    $res=mysqli_query($con,$query_f);
                        $row=mysqli_fetch_array($res);
                        $fare=$row[0];
                        echo $fare;
                    echo "<input type=\"text\" name=\"bus_id_ticket\" value=\"$bus_id\">";
                    echo "<input type=\"text\" name=\"model_name_ticket\" value=\"$model\">";
                    echo "<input type=\"text\" name=\"source_code_ticket\" value=\"$source_code\">";
                    echo "<input type=\"text\" name=\"dest_code_ticket\" value=\"$dest_code\">";
                    echo "<input type=\"text\" name=\"fare_per_person\" value=\"$fare\">";


                ?> 
                <button class="btn success" type = "submit">Submit</button>   <button class="btn danger" type = "reset">Clear</button>
                
                
            </form>

    </body>
    </html>

