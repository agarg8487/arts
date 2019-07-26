<?php

if (isset($_POST['book']))
	{
		include_once 'db/db_connect.php';
		if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
	}	echo $_POST['tid'];
		echo "  ";
	
		$tid=mysqli_real_escape_string($connect,$_POST['tid']);
		$from=mysqli_real_escape_string($connect,$_POST['from']);
		$to=mysqli_real_escape_string($connect,$_POST['to']);
		$date=mysqli_real_escape_string($connect,$_POST['date']);
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$age=$_POST['age'];
		$phone=mysqli_real_escape_string($connect,$_POST['phone']);
		
		
		
		$class = $_POST['c'];
		echo $_POST['c'];
		echo " ";
		
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="select station_id from station where station_name='".$from."'";
		echo $sql;
		$result= mysqli_query($connect, $sql);
		$from= mysqli_fetch_array($result);
		$sql="select station_id from station where station_name='".$to."'";
		echo $sql;
		$result= mysqli_query($connect, $sql);
		$to= mysqli_fetch_array($result);
		
		$sql="insert into booked(trans_id, pnr_num, t_id, email_id, date_num, from_station, to_station) values(125,125,'".$tid."','".$_SESSION['email_id']."','".$date."','".$from['station_id']."','".$to['station_id']."')";
		$result= mysqli_query($connect, $sql);
		for($a=0;$a<count($name);$a+=1)
		{
				$sql="insert into passenger(pnr_num, passenger_name, age, gender, seat_num, seat_type, date_num) values(125,'$name[$a]','$age[$a]','$gender[$a]',(50+$a),'$class','$date')";
				$result= mysqli_query($connect, $sql);
				$sql="insert into pnr_seat(pnr_num,seat_num, seat_type) values(125,(40+$a),'$class')";
				$result= mysqli_query($connect, $sql);
				echo $a;
				
		}
			header("Location: home.php?booked")
?>