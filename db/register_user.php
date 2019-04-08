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
		
		$ip=$_SERVER['REMOTE_ADDR'];
		
		$time= date("h:i:sa",time()+(16200));
		$date= date("d-m-Y",time()+(16200));
		$sql="SELECT * FROM users WHERE email='$email'";
		$result= mysqli_query($connect, $sql);
		$check=mysqli_num_rows($result);		
			$hashedpass = password_hash($pass, PASSWORD_DEFAULT);
			$sql="INSERT INTO user(name,email,gender, age, phone, zipcode, pass,time,date) values('$name','$email', '$gender', $age, '$phone', $zipcode, '$hashedpass','$time','$date')";
			$result=mysqli_query($connect, $sql);
			header("Location: ../index.html?email_registered");
				exit();
		
	}
	else
	{
		header("Location: ../index.html");
				exit();
	}

?>