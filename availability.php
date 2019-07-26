<?php
session_start();
?>

<html>
<head>


<title>Availability</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="availability.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
	 .search-box1{
        width: 250px;
        position: relative;
       
        font-size: 14px;
    }
    
    .result1{
        position: absolute;        
        z-index: 999;
        top: 100%;
		background: #fff;
        left: 0;
		color:#000
    }
    .search-box1 input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
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
	
    /* Formatting search box */
    .search-box{
        width: 250px;
        position: relative;
       
        font-size: 14px;
    }
    
    .result{
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
</style>

<script type="text/javascript">


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

              <div class="login-box">
                     <h1>Check Availability Here</h1>
                    <form id="login"  name="form" action="avail_result.php" method="post" >
                        
                        <div class="search-box1">
							<label for="name"></label>						 
						<input list="data" autocomplete="off" type="text" id="tid" name="tid" placeholder="Train Number"  >
							<datalist id="data"></datalist>
						  <div class="result1"></div>
						</div>
                      <label for="name"></label>
                      <div class="search-box">
							<input list="data" autocomplete="off"  type="text" id="from" name="from" placeholder="From*" >
							<datalist id="data"></datalist>
						  <div class="result"></div>
						</div>
                    
                  
					<label for="name"></label>
					<div class="search-box">
							<input type="text" list="data" autocomplete="off" name="to" placeholder="To*" >
							<datalist id="data"></datalist>
						  <div class="result"></div>
						</div>
					<label for="name"></label>
                      	<select class="class" name="class">
								  <option value="" selected disabled hidden>Choose Class to travel in.</option>
								  <option  value="sleeper"><font color="blue">Sleeper</font></option>
								  <option  value="ac"><font color="blue">AC</font></option>
						</select> 

					<input id="datepicker" name ="date" placeholder="Date*" width="270 " />
                      <script>
                   $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap'
                        });
                     </script>
                       <br>
                      <input id="do" name="avail" value="Find if any ticket is available." title="Click to LOG IN" type="submit">
                    
               
                      
                    
              
                   
                    </form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="j.js" type="text/javascript" ></script>
</html>