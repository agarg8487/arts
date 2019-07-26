
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Register Form</title>
	<link rel="stylesheet" type="text/css" href="register.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Passion+One'>
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Oxygen'>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
<body>
	<?php
					
			include_once 'db/db_connect.php';
			
			if(isset($_SESSION['email_id']))
{
	
}
else
{
	header("Location: home.php");
}

			
				$email=  $_SESSION['email_id'];
				
				$sql="SELECT * FROM user WHERE email_id='$email'";
				$result=mysqli_query($connect, $sql);
				$check=mysqli_num_rows($result);
				$row= mysqli_fetch_assoc($result);
				$name= $row['name'];
		$email= $row['email_id'];
		$pass= $row['pass'];
		$gender= $row['gender'];
		$age= $row['age'];
		$phone= $row['mobile'];
		$zipcode= $row['zipcode'];
		
					
					
	?>

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
	<div class="container">
		<div class="row main">
			<div class="panel-heading">
				<div class="panel-title text-center">
					

				</div>
			</div> 
			<div class="main-login main-center">
				<form class="form-horizontal" method="post"  onsubmit="return check()" action="db/update_user.php">
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Your Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name"  value="<?php echo $name;?>" placeholder="Enter your Name" />
							</div>
							<div class="message" id="message_name">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="cols-sm-2 control-label">Your Email</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
								<input type="email" class="form-control" name="email" value="<?php echo $email;?>" id="email"  placeholder="Enter your Email"/>
							</div>
							<div class="message" id="message_mail">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="age" class="cols-sm-2 control-label">Age</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i></span>
								<input type="number" class="form-control" name="age" value="<?php echo $age;?>" id="age"  placeholder="Enter your Age"/>
							</div>
							<div class="message" id="message_age">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="adderss" class="cols-sm-2 control-label">Your Gender</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-male fa-lg"></i></span>
								
								<select class="form-control" name="class" value="<?php echo $gender;?>>
								  <option value="" selected disabled hidden>Choose your Gender.</option>
								  <option  value="male"><font color="black">Male</font></option>
								  <option  value="female"><font color="black">Female</font></option>
						</select> 

								</div>
							<div class="message" id="message_gender">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="zipcode" class="cols-sm-2 control-label">Zipcode</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
								<input type="number" class="form-control" name="zipcode" value="<?php echo $zipcode;?>" id="zipcode"  placeholder="Enter your Zipcode"/>
							</div>
							<div class="message" id="message_zipcode">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="phone" class="cols-sm-2 control-label">Phone Number</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></span>
								<input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $phone;?>" placeholder="Enter your Phone Number(+911234567890)"/>
							</div>
							<div class="message" id="message_phone">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Enter Your New Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="pass" id="pass"  placeholder="Enter your New Password"/>
							</div>
							<div class="message" id="message_password">
							</div>
						</div>
					</div>
					
					<div class="form-group ">
						<input type="submit" name= "register" value="Update" class="btn btn-primary btn-lg btn-block login-button"/>
					</div>
				</form>
			</div>
			<div class="panel-heading">
				<div class="panel-title text-center">
					
					
				</div>
			</div> 
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="register.js"></script>
</body>
</html>