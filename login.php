<?php
session_start();
if(isset($_SESSION['email_id']))
					{
							header("Location: home.php");
					}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Form </title>
    <link rel="stylesheet" href="login.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
    <div class="login-box" 
	
	<?php
	if(isset($_SESSION['login_status']))
	{
		echo"style{height:400px;}";
		}
	else
	{
	echo"style{height:360px;}";
	}
?>
	
	>
     
<?php
	if(isset($_SESSION['login_status']))
	{
		if(isset($_SESSION['login_id']))
		{
			echo "<h1>Please First Login Before Booking</h1>";
			unset($_SESSION['login_id']);
		}
		else
		{
			echo"<h1>Login Here</h1>";
			unset($_SESSION['login_status']);
		}
	}
	else
	{
			echo"<h1>Login Here</h1>";
	}
	
	
?>
	
	 <form id="login" name="form" action="signin_user.php" method="POST" >
        <!-- USERNAME INPUT -->
        <label for="password">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter your Email" >
        <!-- PASSWORD INPUT -->
        <label for="password">Password</label>
        <input type="password" name= "pass" placeholder="Enter Password" >
        
        <input id="do" name="login" value="Log in" title="Click to LOG IN" type="submit">
       
 
        
        <a href="">Lost your Password?</a><br>
        <a href="register.html">Don't have An account?</a>
        <p id="demo"></p>

     
      </form>
      

    
    </div>
  </body>
</html>

<!--<script src="j.js" type="text/javascript" ></script>
