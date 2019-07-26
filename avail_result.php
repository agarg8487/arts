<?
session_start();
?>

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
<?php
				
					
			   
			   
			
				  


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
				$map_day['daytoshortdayname']=array(
							'Monday' => 'Mon',
							'Tuesday' => 'Tues',
							'Wednesday' => 'Wed',
							'Thursday' => 'Thur',
							'Friday' => 'Fri',
							'Saturday' => 'Sat',
							'Sunday' => 'Sun'
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
			include_once 'db/db_connect.php';

		if(isset($_POST['avail'] ))
		{
			$tid=mysqli_real_escape_string($connect,$_POST['tid']);
			$src=mysqli_real_escape_string($connect,$_POST['from']);
			$dest=mysqli_real_escape_string($connect,$_POST['to']);
			$date=mysqli_real_escape_string($connect,$_POST['date']);
			$class=mysqli_real_escape_string($connect,$_POST['class']);			
			$date = date("Y-m-d", strtotime($date));
			if($_POST['class']=='sleeper')
			{
			$sql="select s1.day_num as day_src, da._day, t.sleeper_seats from schedule s1, schedule s2,train t, days_available da 
					where s1.t_id='$tid' 
					and s1.t_id=s2.t_id 
					and da.t_id=s1.t_id 
					and t.t_id=s1.t_id
					and s1.station_index < s2.station_index 
					and s1.station_id in (select station_id from station where station_name='$src') 
					and s2.station_id in (select station_id from station where station_name='$dest');";
			}
			else
			{
				$sql="select s1.day_num as day_src, da._day, t.ac_seats from schedule s1, schedule s2,train t, days_available da 
					where s1.t_id='$tid' 
					and s1.t_id=s2.t_id 
					and da.t_id=s1.t_id 
					and t.t_id=s1.t_id
					and s1.station_index < s2.station_index 
					and s1.station_id in (select station_id from station where station_name='$src') 
					and s2.station_id in (select station_id from station where station_name='$dest');";
			}
			$result= mysqli_query($connect, $sql);
			$row = mysqli_fetch_array($result);
			if(empty($row))
			{
				echo'<h1 align ="center"><font size=180>'.$tid.' doesn\'t run from '.$src.' to '.$dest.'.</font> </h1>';
				exit();
			}
			$i=0;
			
					echo '<h1 align="center"> Availability( ';
					if (isset($_POST['avail']) and $_POST['class']== 'sleeper')
					{
						echo "Sleeper"; 
					} 
					else{
						
						echo "AC"; 
					} 
					if (isset($_POST['avail'] ))
					{
						echo' in '.$_POST['tid'].' )</h1>';
					}
			echo '   <div id="border" > 
						<table class="table table-striped table-dark">
							<thead>
							<tr>';
			while($i<7)
			{		
					
					$dayOfWeek = date("l", strtotime($date));
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
					echo '<th scope="col" style="text-align:center">'.$date. ' ( '.$map_day['daytoshortdayname'][$dayOfWeek].' )</th>';
					$date = strtotime("+1 day", strtotime($date));
					$date=date("Y-m-d", $date);
					$i+=1;
				}
				else
				{
					$date = strtotime("+1 day", strtotime($date));
					$date=date("Y-m-d", $date);
				}
			 }
		}

				
          echo"        </tr>
                </thead>
                <tbody>";
						
			if (isset($_POST['avail']))
			{
					
					if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
				$tid=mysqli_real_escape_string($connect,$_POST['tid']);
				$src=mysqli_real_escape_string($connect,$_POST['from']);
				$dest=mysqli_real_escape_string($connect,$_POST['to']);
				$date=mysqli_real_escape_string($connect,$_POST['date']);
		
		
					if(empty($tid) or empty($src) or empty($dest) or empty($date))
					{
						header("Location: availability.php?form=empty");
					}
					
					if($_POST['class']=='sleeper')
					{
						$sql="select sleeper_seats from train where t_id='$tid';"; 
					}
					
					else
					{
						$sql="select ac_seats from train where t_id='$tid';"; 
					}						
					$result= mysqli_query($connect, $sql);
					$total_seats = mysqli_fetch_array($result);
					$i=0;
				
				
				$date = date("Y-m-d", strtotime($date));
			
				while($i<7)
				{		
						$sql="select count(pnr.seat_num) as not_available_seats from booked b, schedule sc1, schedule sc2, pnr_seat pnr
							where sc1.station_id=b.from_station
							and b.t_id='$tid'
							and sc2.station_id= b.to_station
							and pnr.pnr_num=b.pnr_num
							and b.t_id=sc1.t_id
							and b.t_id=sc2.t_id
							and (sc2.station_index>(select station_index from schedule where station_id in (select station_id from station where station_name= '$src') and t_id='$tid')
							and sc1.station_index <(select station_index from schedule where station_id in (select station_id from station where station_name= '$dest') and t_id='$tid'))
							and b.date_num='$date'
							and pnr.seat_type='$class';"; 
						$result= mysqli_query($connect, $sql);
						$row1 = mysqli_fetch_array($result);
						//echo $row1['not_available_seats'];
						$dayOfWeek = date("l", strtotime($date));
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
						
							echo '<th scope="col" style="text-align:center"><font color="black">Available-';
							if($_POST['class']=='sleeper')
							{
								$seats_available=$total_seats['sleeper_seats']- $row1['not_available_seats'];
							}
							else
							{
									$seats_available=$total_seats['ac_seats']- $row1['not_available_seats'];
							}
							echo $seats_available;
							echo ' </font></th>';
							$date = strtotime("+1 day", strtotime($date));
							$date=date("Y-m-d", $date);
							$i+=1;
					}
					else
					{
						$date = strtotime("+1 day", strtotime($date));
						$date=date("Y-m-d", $date);
					}
				}				
						
						
						mysqli_close($connect);
						
			}
			else
			{
				header("Location: home.php");
						exit();
			}

?>				
                </tbody>
              </table>
            </div> 
    

    </form>
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="require.js" type="text/javascript" ></script>
<script src="sql.js" type="text/javascript"  ></script>



</html> 