<?php 
    function add_time($time1,$time2){
        $hr1=substr($time1,0,2);
        $min1=substr($time1,3,2);

        $int_total1=(int)$hr1;
        $int_min1=(int)$min1;
        $int_total1=60*$int_total1;
        $int_total1=$int_total1+$int_min1;
        
        $hr2=substr($time2,0,2);
        $min2=substr($time2,3,2);

        $int_total2=(int)$hr2;
        $int_min2=(int)$min2;
        $int_total2=60*$int_total2;
        $int_total2=$int_total2+$int_min2;

        $int_total=$int_total1+$int_total2;
        $int_total=$int_total%1440;
        $hr=floor($int_total/60);
        $min=$int_total%60;
        if($min>=10)
        {
            if($hr>=10)$total=strval($hr).":".strval($min);
            else $total="0".strval($hr).":".strval($min);
        }
        else{
            if($hr>=10)$total=strval($hr).":0".strval($min);
            else $total="0".strval($hr).":0".strval($min);

        }
        return $total;
    }
    require_once "dbconnect.php";
    session_start();
    if(isset($_SESSION["a_loggedin"])&&($_SESSION["a_loggedin"]==true)){
        $ass_route=$_POST["ass_route"];
        $ass_bus=$_POST["ass_bus"];
        $arrival_time=$_POST["start_time"];
        $break_time=$_POST["break_time"];
        
        $created_by=$_SESSION["a_username"];
	    $sql=mysqli_query($con, "insert into  Travel_on(Bus_id,Route_id,created_by) values ('$ass_bus', '$ass_route', '$created_by')");
	    if($sql){
            echo'<center><h2 style="color:white;background-color:#333;">Bus Successfully Assigned</h2></center>';
            $results=mysqli_query($con,"SELECT * FROM Route WHERE Route.Route_id='$ass_route' order by Route.time_from_source ASC");
            $a_time=$arrival_time;
            $d_time=$arrival_time;
            while($rows=mysqli_fetch_array($results)){
                $a_time=add_time($d_time,$rows[3]);
                $d_time=add_time($a_time,$break_time);
                $time_insert=mysqli_query($con,"INSERT INTO Travels_through(Bus_id,station_code,arrv_time,dept_time,created_by) VALUES('$ass_bus','{$rows[1]}','$a_time','$d_time','$created_by');");
            }            
            require_once "assign_bus.php";
        }
        else require_once "assign_bus.php";//echo("Error description: ".mysqli_error($con));

    }
    else{
        echo "Please log in first to see users page.";
        require_once "admin_login.php";
    }
?>