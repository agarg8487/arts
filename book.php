<?php


session_start();
if(isset($_SESSION['email_id']))
{
	
}
else
{
	$_SESSION['login_status']='book';
	$_SESSION['login_id']=1;
	header("Location: login.php");
	
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Booking Form</title>
	<link rel="stylesheet" type="text/css" href="book.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Passion+One'>
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Oxygen'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">



<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    ul {
  padding: 0;
  margin: 0;
}

ul li {
  list-style: none;
}


a.remove_field{
  font: bold 11px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;

  }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
		background: #fff;
        left: 0;
		color:#000
    }
	
    .result1{
        position: absolute;        
        z-index: 999;
        top: 100%;
		background: #fff;
        left: 0;
		color:#000
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
	.search-box1 input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
	.result1 p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result1 p:hover{
        background: #f2f2f2;
    }
</style>

<script type="text/javascript">

$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><div class="col-xs-5 row"><input type="text" class="form-control" name="name[]" placeholder="Enter the name of the Passenger."/></div><div class="col-xs-3 row"><select class="form-control" name="gender[]" ><option value="" selected disabled hidden>Gender </option><option value="Male">Male</option><option value="Female">Female</option></select></div><div class="col-xs-4 row"><input type="number" class="form-control" name="age[]" placeholder="Enter the age "/></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

$(document).ready(function(){
    $('.search-box1 input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result1");
        if(inputVal.length){
            $.get("backend-tidsearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result1 p", function(){
        $(this).parents(".search-box1").find('input[type="text"]').val($(this).text());
        $(this).parent(".result1").empty();
    });
});
</script>
<script type="text/javascript">

$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>


	</head>
<body>
<div class="cols-sm-10">
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
			  <h1  align="center" style="font-family:'Passion One', cursive; font-size:70px; " ><font  >Enter the details to book the ticket</font></h1>
              
	<div class="container">
		<div class="row main">
			<div class="panel-heading">
				<div class="panel-title text-center">
					
					
				</div>
			</div> 
			<div class="main-login main-center">
				<form class="form-horizontal" method="post"  onsubmit="return check()" action="booking.php">
					<div class="form-group">
						<label for="tid" class="cols-sm-2 control-label">Train Number</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bus" aria-hidden="true"></i></span>
								
								
	<?php
				if (isset($_GET['tid']))
			{
					
								echo'
								  <input list = "data" type="text" readonly  value=' . $_GET["tid"] . ' class="form-control" autocomplete="off" id="tid" name="tid" placeholder="Enter Train Number" />
								  ';
									
			}
			else
			{
					echo '<div class="search-box1">
								  <input list = "data" type="text" class="form-control" autocomplete="off" id="tid" name="tid" placeholder="Enter Train Number" />
								  <datalist id="data"></datalist>
								  <div class="result1"></div>
									</div>';
			}
			
		?>						
								
								
								</div>
							<div class="message" id="message_name">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="from" class="cols-sm-2 control-label">From</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></span>
<?php
				if (isset($_GET['src']))
				{		
							echo' <input list = "data"  readonly value ="' . $_GET['src'] . '" type="text" class="form-control" autocomplete="off" id="from" name="from" placeholder="Enter the Station Name you want to travel from." />';
									
								
				}
				else{
							echo '	<div class="search-box">
								  <input list = "data" type="text" class="form-control" autocomplete="off" id="from" name="from" placeholder="Enter the Station Name you want to travel from." />
								  <datalist id="data"></datalist>
								  <div class="result"></div>
									</div>';
							}			
?>									
							<div class="message" id="message_mail">
							</div>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="to" class="cols-sm-2 control-label">To</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
											
<?php
				if (isset($_GET['dest']))
				{
					echo'<input type="text" list = "data" readonly value = "  '.$_GET['dest'].' " class="form-control" autocomplete="off" name="to" placeholder="Enter the Station Name you want to travel to. " />';
					}
					else
					{
						echo'		<div class="search-box">
									  <label for="to"></label>
									  <input type="text" list = "data"  class="form-control" autocomplete="off" name="to" placeholder="Enter the Station Name you want to travel to. " />
									  <datalist id="data"></datalist>
									  <div class="result"></div>
									</div>';
					}

					?>

								</div>
							<div class="message" id="message_age">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="adderss" class="cols-sm-2 control-label">Date</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
<?php
						if (isset($_GET['date']))
							{
								
							
								
								echo' <input id="datepicker" value="'.$_GET['date'].'" type= "date" class="form-control" name="date" readonly placeholder="Enter the Date you want to travel on." width="270 " />';
							
							}
							else
							{
								echo' <input id="datepicker" type= "date" class="form-control" name="date" placeholder="Enter the Date you want to travel on." width="270 " />';
							}
   ?>                
								
							</div>
							
							<div class="message" id="message_gender">
							</div>
						</div>
					</div>
					
					
					
						<div class="form-group row">
						<label for="ex3">Passengers list</label>
						
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-male fa-lg" aria-hidden="true"></i></span>

						<div class="input_fields_wrap">
							<div>
						  <div class="col-xs-6 row">
							
						<input type="text" class="form-control" name="name[]" placeholder="Enter the name of the Passenger.">
						  </div>
						  <div class="col-xs-3 row">
							<select class="form-control" name="gender[]" ><option value="" selected disabled hidden>Gender </option><option value="Male">Male</option><option value="Female">Female</option></select>
							</div>
						  <div class="col-xs-4 row">
							<input type="number"  class="form-control" name="age[]" placeholder="Enter the age.">
						  </div>
						  </div>
						</div>
						</div>
						</div>
							<input type="submit" class="add_field_button" value="Add More Fields">
									<br>
					<div class="form-group">
						<label for="phone" class="cols-sm-2 control-label">Phone Number</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></span>
								<input type="phone" class="form-control" name="phone" id="phone"  placeholder="Enter your Phone Number(+911234567890)"/>
							</div>
							<div class="message" id="message_phone">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="c" class="cols-sm-2 control-label">Class</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
								<select class="c" name="c">
								  <option value="" selected disabled hidden>Choose Class to travel in.</option>
								  <option value="sleeper"><font color="black">Sleeper</font></option>
								  <option value="ac"><font color="black">AC</font></option>
								  </select>
								
								</div>
							<div class="message" id="message_password">
							</div>
						</div>
					</div>
					
					<div class="form-group ">
						<input type="submit" name= "book" class="btn btn-primary btn-lg btn-block login-button"/>
					</div>
				</form>
			</div>
			<div class="panel-heading">
				<div class="panel-title text-center">
					
					
				</div>
			</div> 
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>