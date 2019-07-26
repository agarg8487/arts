<?
	session_start();

?>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="schedule.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body>
        <nav class="navbar navbar-inverse">
              
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="availability.php">Availability</a></li>
                    <li><a href="book.php">Booking</a></li>
                    <li><a href="pnr.php">PNR Status</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                <?php
					if(isset($_SESSION['email_id']))
					{
						echo'<li><a href="profile.php" ><span class="glyphicon glyphicon-user"></span>Profile</a></li>';
                        
							echo'<li><a href="logout_user.php" ><span class="glyphicon glyphicon-user"></span>Logout</a></li>';
                        
					}
					else
					{
						echo'<li><a href="register.php" ><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
					}
				?>		
				  </ul>
                  
        
              </nav>


              <div class="login-box">
                    <!-- <img src="" class="avatar" alt="Avatar Image"> -->
                    <h1>Enter your PNR here</h1>
                    <form id="login"  name="form" action="pnrresult.php" method="post" >
        
                      
					  <div class="search-box">
                      <label for="name"></label>
					  <input list = "data" autocomplete="off" type="text" id="pnr" name="pnr" placeholder="PNR number"  />
                      <datalist id="data"></datalist>
								  <div class="result"></div>
									</div>
                      
                      
                      <input id="do" name="pnr" value="Give details of my Ticket." title="PNR" type="submit">
					  
                      <br>
               
                      
                     
              
                   
                    </form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="j.js" type="text/javascript" ></script>
</html>