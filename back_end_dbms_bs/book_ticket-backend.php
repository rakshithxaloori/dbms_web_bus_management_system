<?php 
function insert_ticket($con,$ticket_no,$Bus_id,$Source_code,$Dest_code,$model_name,$created_by,$contact_no,$n_passengers){
    $bus_id_=strval($Bus_id);
    echo $model_name;

    $query_f="SELECT (Model.farepkm*(d.dis_from_source_in_km-s.dis_from_source_in_km)) as fare FROM Bus,Route as s,Route as d, Model,Travel_on WHERE Model.Model_name='$model_name' and Bus.Bus_id=4 and Bus.Model_name=Model.Model_name and s.station_code='$Source_code' and d.station_code='$Dest_code' and Bus.Bus_id=Travel_on.Bus_id and s.Route_id=Travel_on.Route_id and d.Route_id=Travel_on.Route_id and s.Route_id=d.Route_id";
    $query_fare=mysqli_query($con,$query_f);
    $num_RES=mysqli_num_rows($query_fare);
    echo $num_RES;
    // if($num_RES>0){
        $row_fare=mysqli_fetch_array($query_fare);

        $total_fare=$row_fare[0]*$n_passengers;
        $add_ticket=mysqli_query($con,"INSERT INTO Ticket(Ticket_id,Bus_id,Source_code,Dest_code,total_fare,created_by,contact_no) VALUES ('$ticket_no',$Bus_id,'$Source_code','$Dest_code','$total_fare',$created_by','$contact_no')");
        if(!($add_ticket))echo("Error description: ".mysqli_error($con));
    // }
    

}
function insert_sql_pass($con,$p_no,$p_name,$p_age,$p_gender,$created_by,$ticket_no){
    
    $sql = "INSERT INTO Passenger(Pass_id,Ticket_id,Name,Age, gender,created_by)
                    VALUES('$p_no', '$ticket_no', '$p_name', '$p_age','$p_gender','$created_by')";
    $SQ=mysqli_query($con, $sql);
    if(!($SQ)) echo("Error description: ".mysqli_error($con));
    else {
    echo'<center><h2 style="color:white;background-color:#333;">Ticket Successfully Generated!</h2></center>';

    }
    return ;
}

require_once "dbconnect.php";
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        while(1)
            {
                $number=1;
                $query_ticket=mysqli_query($con,"SELECT Ticket.Ticket_id FROM Ticket WHERE Ticket.Ticket_id=$number");
                $num_rand=mysqli_num_rows($query_ticket);
                if($num_rand==0){
                    break;
                }
                $number=$number+1;
            }
        $created_by=$_SESSION["username"];
        $bus_id=$_POST["bus_id_ticket"];
        $contact_no=$_POST["contact_no"];
        $source_code=$_POST["source_code_ticket"];
        $dest_code=$_POST["dest_code_ticket"];
        echo $dest_code;

        $model_name=$_POST["model_name_ticket"];
        $no_of_pass=0;
            
        $p_no_1 = mysqli_real_escape_string($con, $_POST['p_no_1']);
        $p_name_1=mysqli_real_escape_string($con, $_POST['p_name_1']);
        $p_age_1=mysqli_real_escape_string($con, $_POST['p_age_1']);
        $p_gender_1=mysqli_real_escape_string($con, $_POST['p_gender_1']);
        


        if($p_name_1!=NULL){    
            $no_of_pass=$no_of_pass+1;            
        }
        else{
            echo "<h2>Enter Atleast one paseenger!</h2>";
            require_once "book_ticket.php";
        }
        
        // $p_no_2 = mysqli_real_escape_string($con, $_POST['p_no_2']);
        // $p_name_2=mysqli_real_escape_string($con, $_POST['p_name_2']);
        // $p_age_2=mysqli_real_escape_string($con, $_POST['p_age_2']);
        // $p_gender_2=mysqli_real_escape_string($con, $_POST['p_gender_3']);

        // if($p_name_2!=NULL){    
        //     insert_sql_pass($p_no_2,$p_name_2,$p_age_2,$p_gender_2,$created_by,$number);    
        //     $no_of_pass=$no_of_pass+1;        
        // }


        // $p_no_3 = mysqli_real_escape_string($con, $_POST['p_no_3']);
        // $p_name_3=mysqli_real_escape_string($con, $_POST['p_name_3']);
        // $p_age_3=mysqli_real_escape_string($con, $_POST['p_age_3']);
        // $p_gender_3=mysqli_real_escape_string($con, $_POST['p_gender_3']);

        // if($p_name_3!=NULL){    
        //     insert_sql_pass($p_no_3,$p_name_3,$p_age_3,$p_gender_3,$created_by,$number);  
        //     $no_of_pass=$no_of_pass+1;          
        // }

        // $p_no_4 = mysqli_real_escape_string($con, $_POST['p_no_4']);
        // $p_name_4=mysqli_real_escape_string($con, $_POST['p_name_4']);
        // $p_age_4=mysqli_real_escape_string($con, $_POST['p_age_4']);
        // $p_gender_4=mysqli_real_escape_string($con, $_POST['p_gender_4']);

        // if($p_name_4!=NULL){    
        //     insert_sql_pass($p_no_4,$p_name_4,$p_age_4,$p_gender_4,$created_by,$number);  
        //     $no_of_pass=$no_of_pass+1;          
        // }

        // $p_no_5 = mysqli_real_escape_string($con, $_POST['p_no_5']);
        // $p_name_5=mysqli_real_escape_string($con, $_POST['p_name_5']);
        // $p_age_5=mysqli_real_escape_string($con, $_POST['p_age_5']);
        // $p_gender_5=mysqli_real_escape_string($con, $_POST['p_gender_5']);

        // if($p_name_6!=NULL){    
        //     insert_sql_pass($p_no_5,$p_name_5,$p_age_5,$p_gender_5,$created_by,$number); 
        //     $no_of_pass=$no_of_pass+1;           
        // }

        // $p_no_6 = mysqli_real_escape_string($con, $_POST['p_no_6']);
        // $p_name_6=mysqli_real_escape_string($con, $_POST['p_name_6']);
        // $p_age_6=mysqli_real_escape_string($con, $_POST['p_age_6']);
        // $p_gender_6=mysqli_real_escape_string($con, $_POST['p_gender_6']);
        // if($p_name_6!=NULL){    
        //     insert_sql_pass($p_no_6,$p_name_6,$p_age_6,$p_gender_6,$created_by,$number);  
        //     $no_of_pass=$no_of_pass+1;          
        // }

        insert_ticket($con,$number,$bus_id,$source_code,$dest_code,$model_name,$created_by,$contact_no,$no_of_pass);
        // insert_sql_pass($con,$p_no_1,$p_name_1,$p_age_1,$p_gender_1,$created_by,$number);
        
        if($_SESSION['username']=="guest@guest"){
            require_once "home.php";
        }
        else{
            require_once "usershome.php";
        }
    }


else{
    echo "Please log in first to see users page.";
    require_once "users_login.php";
}