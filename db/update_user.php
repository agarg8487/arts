<?php

if (isset($_POST['register']))
	{
		include_once 'db_connect.php';
		if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

		$name=mysqli_real_escape_string($connect,$_POST['name']);
		$email=mysqli_real_escape_string($connect,$_POST['email']);
		$pass=mysqli_real_escape_string($connect,$_POST['pass']);
		$gender=mysqli_real_escape_string($connect,$_POST['gender']);
		$age=mysqli_real_escape_string($connect,$_POST['age']);
		$phone=mysqli_real_escape_string($connect,$_POST['phone']);
		$zipcode=mysqli_real_escape_string($connect,$_POST['zipcode']);
		
	
		
		$time= date("h:i:sa",time()+(16200));
		$date= date("d-m-Y",time()+(16200));
		$sql="SELECT * FROM users WHERE email='$email'";
		$result= mysqli_query($connect, $sql);
		$check=mysqli_num_rows($result);		
		if($check<1)
		{
			$sql="Delete from user where email_id='$email'";
			$result1=mysqli_query($connect, $sql);
			$sql="INSERT INTO user(name,email_id,gender, age, mobile, zipcode, pass) values('$name','$email', '$gender', $age, '$phone', $zipcode, '$pass')";
			$result=mysqli_query($connect, $sql);
			header("Location: ../home.php?password_updated");
				exit();
		}
		else
		{
			header("Location: ../login.php?email_already_exits");
		}
	}
	else
	{
		header("Location: ../login.php");
				exit();
	}

?>