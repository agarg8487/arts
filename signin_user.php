<?php

include_once 'db/db_connect.php';
if(isset($_POST['login']))
{
	$email=mysqli_real_escape_string($connect, $_POST['email']);
	$pass=mysqli_real_escape_string($connect, $_POST['pass']);
	
	$sql="SELECT * FROM user WHERE email_id='$email'";
	$result=mysqli_query($connect, $sql);
	$check=mysqli_num_rows($result);
	if(empty($email) || empty($pass))
	{
		header("Location: login.php?empty");
		exit();
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("Location: login.php?not_a_valid_email");
		exit();
	}
	elseif($check<1)
	{
		
		header("Location: register.php?please_sign_up");
		exit();
	}
	else
	{
		$row= mysqli_fetch_assoc($result);
		
		if($pass == $row['pass'])
		{
			$_SESSION['name']=$row['name'];
			$_SESSION['mobile']=$row['mobile'];
			$_SESSION['email_id']=$row['email_id'];
			
			
			if(isset($_SESSION['login_status']))
			{
				unset($_SESSION['login_status']);	
				header("Location: book.php?login_success");
			}
			else
			{
				header("Location: login.php?login_success");
			}
			
			exit();
			
		}
		else
		{
			header("Location: login.php?wrong_password");
			exit();
		}
		
	}
	
	
}
else
{
	header("Location: ../home.php?lol");
		exit();
}
?>