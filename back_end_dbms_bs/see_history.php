<html>
<head>
    <title>Bus Mangement System | Userhome</title>
    <link rel="stylesheet" href="./layout/layout.css"type="text/css"> 
	<link href="css/bootstrap.min.css.map" rel="stylesheet" type="text/css"  >

</head>
  
    <body>
    	<div class="heading">
    		<h1>Bus Booking Platform<-see_history</h1>
    	</div>
        <div class="options">
            <a href="book_ticket.php" type="submit" >Book ticket</a>
            <a href="see_history.php" type="submit" >History</a>
            
            <a href="user_login.php" type="submit" >Logout</a>
        </div>

        <?php 
            require_once "dbconnect.php";
            session_start();
            $created_by=$_SESSION["username"];
            $query=mysqli_query($con," SELECT Ticket.Ticket_id,Bus.vehicle_no,Ticket.total_fare,Ticket.no_of_pass,Ticket.contact_no,Ticket.Source_code,Ticket.Dest_code,tts.arrv_time as sat,tts.dept_time as sdt,ttd.arrv_time as dat,ttd.dept_time as ddt FROM Ticket,Bus,Travels_through as ttd,Travels_through as tts WHERE Bus.Bus_id=Ticket.Bus_id and tts.station_code=Ticket.Source_code and ttd.station_code=Ticket.Dest_code and Ticket.created_by='$created_by' and Bus.Bus_id=tts.Bus_id and Bus.Bus_id=ttd.Bus_id");
            $numResults=mysqli_num_rows($query);
            if($numResults==0){
                echo '<label>No Tickets Booked !</label><br>';

            }
            else{
                echo '<label>TIckets Booked :</label><br>';
                while($row=mysqli_fetch_array($query)){
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Ticket_id: {$row[0]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Vehicle_no: {$row[1]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">From: {$row[5]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Arrival: {$row[7]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Departure: {$row[8]}</h3><br>";

                    echo"<h3 style=\"color:black;background-color:lightblue;\">To: {$row[6]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Arrival: {$row[9]}</h3>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Departure: {$row[10]}</h3>";

                    echo"<h3 style=\"color:black;background-color:lightblue;\">Contact: {$row[4]}</h3><br>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">No of passengers: {$row[3]}</h3><br>";
                    echo"<h3 style=\"color:black;background-color:lightblue;\">Total Fare: {$row[2]}</h3><br>";
                    echo "----------------------------------------------------------------------------------------------------------------";
                }
            }
        ?>
    </body>
</html>