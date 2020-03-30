<?php 

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
        
        $created_by=$_SESSION["username"];
        $bus_id=$_POST["bus_id_ticket"];
        $source_code=$_POST["source_code_ticket"];
        $dest_code=$_POST["dest_code_ticket"];
        $fare=$_POST["fare_per_person"];
        $model_name=$_POST["model_name_ticket"];
        $ticket_no=$_SESSION["ticket_no"]-1;
        $no_of_pass=0;

        echo $created_by;
        echo $bus_id;
        echo $contact_no;
        echo $source_code;
        echo $dest_code;
        echo $fare;
        echo $model_name;
        echo $no_of_pass;
    
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

        // insert_ticket($con,$number,$bus_id,$source_code,$dest_code,$model_name,$created_by,$contact_no,$no_of_pass);
        insert_sql_pass($con,$p_no_1,$p_name_1,$p_age_1,$p_gender_1,$created_by,$ticket_no);
        
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