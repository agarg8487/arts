<?php
session_start();
include_once 'db_connect.php';
if(isset($_POST['login']))
{
	$email=mysqli_real_escape_string($connect, $_POST['email']);
	$pass=mysqli_real_escape_string($connect, $_POST['pass']);
	
	$sql="SELECT * FROM user WHERE email='$email'";
	$result=mysqli_query($connect, $sql);
	$check=mysqli_num_rows($result);
	if(empty($email) || empty($pass))
	{
		header("Location: ../index.html?empty");
		exit();
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("Location: ../index.html?not_a_valid_email");
		exit();
	}
	elseif($check<1)
	{
		header("Location: ../register.html?please_sign_up");
		exit();
	}
	else
	{
		$row= mysqli_fetch_assoc($result);
		$passcheck= password_verify($pass, $row['pass']);
		if($passcheck == false)
		{
			header("Location: ../index.html?wrong_password");
			exit();
		}
		elseif($passcheck== true)
		{
			$_SESSION['gender']=$row['gender'];
			$_SESSION['name']=$row['name'];
			$_SESSION['email']=$row['email'];
			header("Location: ../logout.html?login_success");
			exit();
		}
		
	}
	
	
}
else
{
	header("Location: ../index.html");
		exit();
}
?>