
<html>
<head>
	<link rel="stylesheet" type="text/css" href="layoutsstyle.css">
	<title>Bus Mangement System | AddModel</title>
	<style>
		
			a:link, a:visited {
  background-color: #2196F3;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 25px;
  margin-right:  10px;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    font-family: "Comic Sans MS", cursive, sans-serif;
}
a:hover, a:active {
  background-color: #0b7dda;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
		
	</style>
</head>
  
    <body>
    	<div class="header">
    		<h1>Bus Booking Platform<-AddModel</h1>
        <div class="admins_top_nav">
            <form action="add_bus.php" method="POST" class="a_topnav">
              <button class="a_add_bus" type="submit">Add Bus</button>
            </form>
            <form action="admin_login.php" method = "POST" class="a_topnav">
              <button class="a_logout" type="submit">Logout</button>
            </form>
    	  </div>
          <form action="add_model-backend.php" method="POST" class ="a_adddetails">
                <center>
                    <label>Model_Name:</label>
			        <input name = "model_name" placeholder = "Model name" type="text"><br><br>
                    <label>farepkm:</label>
			        <input name = "farepkm" placeholder = "" type="text"><br><br>

			        <button class="btn success" type = "submit">Create model</button>   <button class="btn danger" type = "reset">Clear</button>
                </center>
          </form>
    </div>
</body>
</html>