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
		
		
		$sql="SELECT * FROM users WHERE email='$email'";
		$result= mysqli_query($connect, $sql);
		$check=mysqli_num_rows($result);		
			$sql="INSERT INTO user(name,email,gender, age, phone, zipcode, pass) values('$name','$email', '$gender', $age, '$phone', $zipcode, '$pass')";
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
