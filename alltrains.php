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
				include_once 'db/db_connect.php';
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
				<h1 align="center"> All Trains   </h1>
               <div id="border" > 
        <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    
                    <th scope="col">Train id</th>
					<th scope="col">Train name</th>
					<th scope="col">Source Station Name</th>
					<th scope='col'>Destination Station Name</th>
                  </tr>
                </thead>
                <tbody>


<?php
			
					
						if (mysqli_connect_errno()) {
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
			
			$tid=mysqli_real_escape_string($connect,$_POST['tid']);
		
		$sql="select t.t_id, t.t_name, s1.station_name as src_name, s2.station_name as dest_name from train t, station s1,station s2 where
								t.src_id=s1.station_id
								and t.dest_id=s2.station_id;";
				
				$j=0;
				$result= mysqli_query($connect, $sql);
		while($row = mysqli_fetch_array($result))
			{		if($j==0)		
				{	
						echo "<tr>";
						echo "<td><font color='black'>" . $row['t_id'] . "</font></td>";
						echo "<td><font color='black'>" . $row['t_name'] . "</font></td>";
						echo "<td><font color='black'>" . $row['src_name']. "</font></td>";
						echo "<td><font color='black'>" . $row['dest_name']. "</font></td>";
						
				
					
					//$source=str_replace(' ', '-', $src );
					//$desti=str_replace(' ', '-', $dest );
					echo '<td> <a href="book.php?tid='. $row['t_id'] .'&src='.$row['src_name'].'" class="btn btn-primary btn-sm active" name= "book" role="button">BOOK</a></td>';
					echo "</tr>";
				
		}
			
			mysqli_close($connect);
			

?>				
                </tbody>
              </table>
            </div> 
    
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="require.js" type="text/javascript" ></script>
<script src="sql.js" type="text/javascript"  ></script>



</html> 