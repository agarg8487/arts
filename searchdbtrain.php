<!DOCTYPE html>
<html>
<head>

    <title>Table</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="repeat.css" rel="stylesheet" type="text/css" />


</head>
<body>
      <nav class="navbar navbar-inverse">
              
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="home.html">Home</a></li>
                    <li><a href="schedule.html">Schedule</a></li>
                    <li><a href="availability.html">Availability</a></li>
                    <li><a href="book.php">Booking</a></li>
                    <li><a href="pnr.html">PNR Status</a></li>
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
	  
<?php

if (isset($_POST['search']))
	{
		include_once 'db/db_connect.php';
		if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

		$src=mysqli_real_escape_string($connect,$_POST['from']);
		$dest=mysqli_real_escape_string($connect,$_POST['to']);
		$date=mysqli_real_escape_string($connect,$_POST['date']);
		
		
		if(empty($src) or empty($dest) or empty($date))
		{
			header("Location: home.html?form=empty");
		}
		$sql="select s1.t_id , s1.day_num as day_src,s2.day_num as day_dest, da._day, s1.arrival as arrival_src , s1.departure as departure_src, s2.arrival as arrival_dest, s2.departure as departure_dest, s1.fare_cum_sleep as fare_src, s2.fare_cum_sleep as fare_dest from schedule s1, schedule s2, days_available da 
				where s1.t_id=s2.t_id 
				and da.t_id=s1.t_id 
				and s1.station_index < s2.station_index 
				and s1.station_id in (select station_id from station where station_name='$src') 
				and s2.station_id in (select station_id from station where station_name='$dest');";
				
				
		
		
//Get the day of the week using PHP's date function.
		$dayOfWeek = date("l", strtotime($date));

		$result= mysqli_query($connect, $sql);
		$check=mysqli_num_rows($result);		
		echo "<table class='table table-striped table-dark' border='1'>
			<thead>
			<tr>
				<th scope='col'>Train id</th>
				<th scope='col'>Day(" . $src . " )</th>
				<th scope='col'>Day(" . $dest . ")</th>
				<th scope='col'>Arrival(" . $src . ")</th>
				<th scope='col'>Departure(" . $src . ")</th>
				<th scope='col'>Arrival(" . $dest . ")</th>
				<th scope='col'>Departure(" . $dest . ")</th>
				<th scope='col'>   Fare   </th>
				<th scope='col'>Click to book.</th>
			</tr>
			</thead>
			<tbody>";
				$map_day=array();
				$map_day['daytonum']=array(
							'Monday' => 1,
							'Tuesday' => 2,
							'Wednesday' => 3,
							'Thursday' => 4,
							'Friday' => 5,
							'Saturday' => 6,
							'Sunday' => 7
				);
				$map_day['numtoprime']=array(
							1 => 2,
							2 => 3,
							3 => 5,
							4 => 7,
							5 => 11,
							6 => 13,
							7 => 17
				);
					
	while($row = mysqli_fetch_array($result))
			{	
				
				$day_available=$row['_day'];
				$day_number=$map_day['daytonum'][$dayOfWeek] - $row['day_src'] + 1;
				$day_prime=$map_day['numtoprime'][$day_number] ;
				$check_day=(($day_available)%($day_prime));
				if($check_day==0)
				{
					
					echo "<tr>";
					echo "<td>" . $row['t_id'] . "</td>";
					
					echo "<td>" . $row['day_src'] . "</td>";
					echo "<td>" . $row['day_dest'] . "</td>";
					if($row['arrival_src']==NULL)
					{
						echo "<td> Source</td>";
					}
					else
					{
						echo "<td>" . $row['arrival_src'] . "</td>";	
					}
					if($row['departure_src']==NULL)
					{
						echo "<td>Destination</td>";
					}
					else
					{
						echo "<td>" . $row['departure_src'] . "</td>";	
					}
					echo "<td>" . $row['arrival_dest'] . "</td>";
					echo "<td>" . $row['departure_dest'] . "</td>";
					echo "<td>" . ($row['fare_dest'] - $row['fare_src']). "</td>";
					echo "<td> <input name=Book type=button placeholder='Book' value='Book'></td>";
					echo "</tr>";
				}
			}
			echo "</tbody></table>";

			mysqli_close($connect);
	}
	else
	{
		header("Location: home.html");
				exit();
	}

?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</html> 