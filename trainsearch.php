

<html>
<head>

    <title>Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="trainsearch.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<style type="text/css">
  #book{

  position: absolute ;
  left: 47% ;
  top: 40% ;
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  }
  #border
  {
    border: 5px solid gray;
    margin-left: 3% ;
    margin-right: 3% ;


  }
#schedulesearch
{
	color: blue;
}
</style>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
        <div >
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
               </div>
				<h1 align="center"> Schedule   </h1>
               <div id="border" > 
        <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Train id</th>
					<th scope="col">Train name</th>
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

							echo "<th scope='col'>Arrival(" . $src . ")</th>";
							echo"<th scope='col'>Departure(" . $src . ")</th>";
							echo "<th scope='col'>Arrival(" . $dest . ")</th>";
							echo "<th scope='col'>Departure(" . $dest . ")</th>";
			}
			else{
				header("Location: home.html?search_properly");
			}
?>
					<th scope='col'>   Fare   </th>
					<th scope='col'>Click to book.</th>
                  </tr>
                </thead>
                <tbody>


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
		$sql="select s1.t_id , s1.day_num as day_src,s2.day_num as day_dest, da._day, s1.arrival as arrival_src , s1.departure as departure_src, s2.arrival as arrival_dest, s2.departure as departure_dest, s1.fare_cum_sleep as fare_src, s2.fare_cum_sleep as fare_dest, t.t_name from schedule s1, schedule s2,train t, days_available da 
				where s1.t_id=s2.t_id 
				and da.t_id=s1.t_id 
				and t.t_id=s1.t_id
				and s1.station_index < s2.station_index 
				and s1.station_id in (select station_id from station where station_name='$src') 
				and s2.station_id in (select station_id from station where station_name='$dest');";
				
				
		
//Get the day of the week using PHP's date function.
		$dayOfWeek = date("l", strtotime($date));

		$result= mysqli_query($connect, $sql);
		$check=mysqli_num_rows($result);	
		
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
					$i=0;
					
					$date = str_replace('/', '-', $_POST['date'] );
					$res = explode("-", $date);
					$newDate = $res[2]."-".$res[0]."-".$res[1];
	while($row = mysqli_fetch_array($result))
			{	
				
				$day_available=$row['_day'];
				$day_number=$map_day['daytonum'][$dayOfWeek] - $row['day_src'] + 1;
				if($day_number<=0)
					{
						$day_number+=7;
					}
				$day_prime=$map_day['numtoprime'][$day_number] ;
				$check_day=(($day_available)%($day_prime));
				if($check_day==0)
				{
					$i++;
					
					echo "<tr>";
					echo "<td><font color='black'>" . $i . "</font></td>";
					echo "<td><a id='schedulesearch' href='scheduleresult.php?tid=". $row['t_id'] ."'>" . $row['t_id'] . "</a></td>";
					echo "<td><font color='black'>" . $row['t_name'] . "</font></td>";
					if($row['arrival_src']==NULL)
					{
						echo "<td><font color='black'> Source</font></td>";
					}
					else
					{
						echo "<td><font color='black'>" . $row['arrival_src'] . "</font></td>";	
					}
					echo "<td><font color='black'>" . $row['departure_src'] . "</font></td>";
					
					echo "<td><font color='black'>" . $row['arrival_dest'] . "</font></td>";
					if($row['departure_dest']==NULL)
					{
						echo "<td><font color='black'>Destination</font></td>";
					}
					else
					{
						echo "<td><font color='black'>" . $row['departure_dest'] . "</font></td>";	
					}
					echo "<td><font color='black'>" . ($row['fare_dest'] - $row['fare_src']). "</font></td>";
					
					//$source=str_replace(' ', '-', $src );
					//$desti=str_replace(' ', '-', $dest );
					echo '<td> <a href="book.php?tid='. $row['t_id'] .'&src='. $src .'&dest='. $dest .'&date='. $newDate .'" class="btn btn-primary btn-sm active" name= "book" role="button">BOOK</a></td>';
					echo "</tr>";
				}
			}
			
			mysqli_close($connect);
			
			}
			else
			{
				header("Location: home.html");
						exit();
			}

?>				
                </tbody>
              </table>
            </div> 
    <form action="/booking.html" method="POST ">
     <button type="Submit" id="book"> Booking </button>


    </form>
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="require.js" type="text/javascript" ></script>
<script src="sql.js" type="text/javascript"  ></script>



</html> 