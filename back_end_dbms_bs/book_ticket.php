<?php   
    if(isset($_POST['SubmitButton'])){
        $source = $_POST["source_station"];
        $dest=$_POST["dest_station"];
        $quer="SELECT Bus.vehicle_no,Bus.Model_name,a.arrv_time as source_arrv,a.dept_time as source_dept,b.arrv_time as dest_arrv,b.dept_time as dest_dept,ALL_ROUTES.Route_name,Bus.Bus_id FROM Route as r,Route as s,Travel_on,Travels_through as a,Travels_through as b,ALL_ROUTES,Bus WHERE r.station_code='$source' and s.station_code='$dest'and r.dis_from_source_in_km <=s.dis_from_source_in_km and r.Route_id=s.Route_id and r.Route_id=Travel_on.Route_id and Travel_on.Bus_id=a.Bus_id and Travel_on.Bus_id=b.Bus_id and a.station_code=r.station_code and b.station_code=s.station_code and ALL_ROUTES.Route_id=r.Route_id and Bus.Bus_id=Travel_on.Bus_id ORDER BY Travel_on.Bus_id";
    }
    else{
        $quer=NULL;
    }
    if(isset($_POST["Book_now"])){
        $vehicle_no=$_POST["vehicle_no_name"];
        $source_arrv=$_POST["source_arrv_name"];
        $dest_arrv=$_POST["dest_arrv_name"];
        $source_dept=$_POST["source_dept_name"];
        $dest_dept=$_POST["dest_dept_name"];
        $Route_name=$_POST["route_name_name"];
        $model_name=$_POST["model_name"];
        $bus_id=$_POST["bus_id_name"];

    }
    else{
        $vehicle_no=NULL;
        $source_arrv=NULL;
        $dest_arrv=NULL;
        $source_dept=NULL;
        $dest_dept=NULL;
        $Route_name=NULL;
        $model_name=NULL;
        $bus_id=NULL;

    }
    // if(isset($_POST["Add_more"])){
    //     $p_name=array();
    //     array_push($p,$_POST["p_name"]);
    //     echo $p_name[0];
    // }
    // else{
    //     $p_name=NULL;
    //     $p_name=NULL;
    //     $p_name=NULL;
    //     $p_name=NULL;

    // }
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
    <form action="" method="POST" class="container" >
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
    
                echo "<table><tr><th>Vehicle_no</th><th>Model</th><th>source_arrv</th><th>source_dept</th><th>dest_arrv</th><th>dest_dept</th><th>Route Name</th></tr>";
                while($query_row=mysqli_fetch_array($res_query)){
                    echo "<tr><td>'{$query_row[0]}'</td><td>'{$query_row[1]}'</td><td>'{$query_row[2]}'</td><td>'{$query_row[3]}'</td><td>'{$query_row[4]}'</td><td>'{$query_row[5]}'</td><td name=\"Route_name\">'{$query_row[6]}'</td><td><button class=\"btn success\" type = \"submit\" name=\"Book_now\">Book_now</button></td></tr>";
                    echo "<input type=\"hidden\" name=\"vehicle_no_name\" value=\"{$query_row[0]}\"/>";
                    echo "<input type=\"hidden\" name=\"model_name\" value=\"{$query_row[1]}\"/>";
                    echo "<input type=\"hidden\" name=\"source_arrv_name\" value=\"{$query_row[2]}\"/>";
                    echo "<input type=\"hidden\" name=\"source_dept_name\" value=\"{$query_row[3]}\"/>";
                    echo "<input type=\"hidden\" name=\"dest_arrv_name\" value=\"{$query_row[4]}\"/>";
                    echo "<input type=\"hidden\" name=\"dest_dept_name\" value=\"{$query_row[5]}\"/>";
                    echo "<input type=\"hidden\" name=\"route_name_name\" value=\"{$query_row[6]}\"/>";
                    echo "<input type=\"hidden\" name=\"bus_id_name\" value=\"{$query_row[7]}\"/>";

                }
                echo "</table>";
                
            }
        }
    ?>
    </form>
    <label>Book Ticket For Bus : 
        <?php
            echo "$Route_name;($source_arrv --> $dest_arrv) Model :$model_name";
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
            <div class="field-wrap">
                <label>
                    Contact_no<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name="contact_no"/>
            </div>
            <?php 
                echo "<input type=\"hidden\" name=\"bus_id_ticket\" value=\"$bus_id\">";
                echo "<input type=\"hidden\" name=\"model_name_ticket\" value=\"$model_name\">";
                echo "<input type=\"hidden\" name=\"source_code_ticket\" value=\"$source\">";
                echo $source;
                echo "<input type=\"hidden\" name=\"dest_code_ticket\" value=\"$dest\">";

            ?> 
			<button class="btn success" type = "submit">Submit</button>   <button class="btn danger" type = "reset">Clear</button>
            
            
        </form>

</body>
</html>
<!-- 
<script>
  $(document).ready(function(){
      var i = 1;
      $('#add').click(function(){
          i++;

          $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="field-wrap"><?php //$inc=1;echo"<input name = \"p_no[]\" id=\"p_no\" type=\"hidden\"f" value=\"$inc\"/>";echo "<label>$inc.</label>";?></div></td><td><div class="field-wrap"><input type="text"required autocomplete="off" name="p_name[]"/></div></td><td><div class="field-wrap"><input type="number"required autocomplete="off" name="p_age[]"/></div></td><td><div class="field-wrap"><input type="text"required autocomplete="off" name="p_gender[]"/></div></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click','.btn_remove', function(){
          var button_id = $(this).attr("id");
          $("#row"+button_id+"").remove();
      });

      $('#submit').click(function(){
          $.ajax({
              async: true,
              url: "book_tickect-backend.php",
              method: "POST",
              data).serialize(),
              success:function(rt)
              {
                  alert(rt);
            )[0].reset();
              }
          });
      });
  });
</script> -->