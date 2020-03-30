(SELECT * FROM Route WHERE Route_id = 1 ORDER by dis_from_source_in_km DESC LIMIT 1) union ALL (SELECT * FROM Route WHERE Route_id = 1 ORDER by dis_from_source_in_km ASC LIMIT 1)
SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;

SELECT b.Bus_id,r.Route_id,ar.Route_name,r.station_code,r.dis_from_source_in_km,r.time_from_source_in_min FROM Travel_on as t,Bus as b,Route as r,ALL_ROUTES as ar WHERE ar.Route_id=t.Route_id and r.Route_id=t.Route_id and b.Bus_id IN(SELECT Bus_id FROM Travel_on)ORDER BY r.time_from_source_in_min ASC;


SELECT Bus.vehicle_no,Bus.Model_name,a.arrv_time as source_arrv,a.dept_time as source_dept,b.arrv_time as dest_arrv,b.dept_time as dest_dept,ALL_ROUTES.Route_name FROM Route as r,Route as s,Travel_on,Travels_through as a,Travels_through as b,ALL_ROUTES,Bus WHERE r.station_code="AN" and s.station_code="PL"and r.dis_from_source_in_km <=s.dis_from_source_in_km and r.Route_id=s.Route_id and r.Route_id=Travel_on.Route_id and Travel_on.Bus_id=a.Bus_id and Travel_on.Bus_id=b.Bus_id and a.station_code=r.station_code and b.station_code=s.station_code and ALL_ROUTES.Route_id=r.Route_id and Bus.Bus_id=Travel_on.Bus_id ORDER BY Travel_on.Bus_id

<td><div class="field-wrap"><?php $inc=1;echo"<input name = \"p_no[]\" id=\"p_no\" type=\"hidden\"form=\"pass_details\" value=\"$inc\"/>";echo "<label>$inc.</label>";?></div></td><td><div class="field-wrap"><input type="text"required autocomplete="off" name="p_name[]"/></div></td><td><div class="field-wrap"><input type="number"required autocomplete="off" name="p_age[]"/></div></td><td><div class="field-wrap"><input type="text"required autocomplete="off" name="p_gender[]"/></div></td>

SELECT (Model.farepkm*(d.dis_from_source_in_km-s.dis_from_source_in_km)) as fare FROM Bus,Route as s,Route as d, Model,Travel_on WHERE Model.Model_name="Volvo" and Bus.Bus_id="4" and Bus.Model_name=Model.Model_name and s.station_code="BG" and d.station_code="AN" and Bus.Bus_id=Travel_on.Bus_id and s.Route_id=Travel_on.Route_id and d.Route_id=Travel_on.Route_id and s.Route_id=d.Route_id






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
                    echo "<input type=\"hidden\" name=\"dest_code_ticket\" value=\"$dest\">";

                ?> 
                <button class="btn success" type = "submit">Submit</button>   <button class="btn danger" type = "reset">Clear</button>
                
                
            </form>

    </body>
    </html>