<?php

	session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION['id']);
		unset($_SESSION['UserName']);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedIn.php");
        
    }
	
	if( array_key_exists("submit",$_POST) )
	{
		
		$link = mysqli_connect("localhost","root","","dbms project");
		
		if(mysqli_connect_error())
		{
			die("DataBase Connection Error");
		}
		else
		{
			if($_POST['signUp'] == '1')
			{
				$query = "SELECT id FROM `admin` WHERE id = '".mysqli_real_escape_string($link, $_POST['UserName'])."' LIMIT 1";
				
				$result = mysqli_query($link,$query);
				
				if(mysqli_num_rows($result)	> 0)
				{
					$error = "That  UserName address is taken.";
				}
				else
				{
					$query = "INSERT INTO `admin`(`id`,`Password`,`Name`,`Mobile`,`Email`,`Company_Name`) VALUES('".mysqli_real_escape_string($link, $_POST['UserName'])."','".mysqli_real_escape_string($link, $_POST['Password'])."','".mysqli_real_escape_string($link, $_POST['name'])."','".mysqli_real_escape_string($link, $_POST['contact'])."','".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['company'])."')";
					
					if(!mysqli_query($link,$query))
					{
						$error = "<p>Could not sign you up - please try again later.</p>";
					}
					else
					{
						$query = "UPDATE `admin` SET Password = '".md5($_POST['Password'])."' WHERE id='".mysqli_real_escape_string($link, $_POST['UserName'])."' LIMIT 1";
						
						mysqli_query($link,$query);

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", mysqli_insert_id($link), time() + 60*20);

                        }
						
						$_SESSION['UserName'] = mysqli_real_escape_string($link, $_POST['UserName']);
						
                        header("Location: loggedIn.php");
					}
				}
			
			}
			else
			{
				$query = "SELECT * FROM `admin` WHERE id = '".mysqli_real_escape_string($link, $_POST['UserName'])."' ";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);
				if (isset($row)) {
                        
                        $hashedPassword = md5($_POST['Password']);
                        
                        if ($hashedPassword == $row['Password']) {
                            
                            $_SESSION['id'] = $row['id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*20);

                            } 
							
							$_SESSION['UserName'] = mysqli_real_escape_string($link, $_POST['UserName']);

                            header("Location: loggedIn.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
			}
		}
	}
	
?>


<html>

	<head>
	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Jwelery WholeSale Management System</title>
		
		<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
		
		<link href="w3schoolModal.css" rel="stylesheet" type="text/css">
		
		<style>
		
			
		</style>

	</head>
	
	<body style="background-image:url('background.jpg');">
	
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">Jwellery Wholsale Management System</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Overview</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">About Us</a>
			  </li>
			</ul>
		  </div>
		</nav>
		
		<div class="mx-auto">
					<button class="btn-lg btn-dark" style="width:250px;height:250px;margin:-10% 20% auto -10%;" id="main-button1" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Login</button>
					<button class="btn-lg btn-dark" style="width:250px;height:250px;margin:-10% 20% auto 0%;" id="main-button2" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
		</div>
		
		<div id="id02" class="modal">
		  
		  <form method="post" class="modal-content animate">
			<div class="imgcontainer">
			  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close">&times;</span>
			</div>

			<div class="container">
				<div class="form-group">
					<label for="uname"><b>Username</b></label>
					<input class="form-control" type="text" name="UserName" placeholder="Enter Username" required>
				</div>
				<div class="form-group">
					<label for="psw"><b>Password</b></label>
					<input class="form-control" type="password" name="Password" placeholder="Enter Password" required>
				</div>
				<input class="form-control" type="hidden" name="signUp" value="0">
			    <label>
					<input type="checkbox" name="stayLoggedIn" value=1> Remember me
			    </label>
				<button class="btn btn-dark" type="submit" name="submit">Log In</button>
			</div>

			<div class="container" style="background-color:#f1f1f1">
			  <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
			</div>
		  </form>
		</div>

		<div id="id01" class="modal">
		  
		  <form method="post" class="modal-content animate">
			<div class="imgcontainer">
			  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			</div>

			<div class="container">
			  <label for="uname"><b>Username</b></label>
			  <input class="form-control" type="text" name="UserName" placeholder="Enter Username" required>

			  <label for="psw"><b>Password</b></label>
			  <input class="form-control" type="password" name="Password" placeholder="Password" required>
			  
			  <label for="psw"><b>Name</b></label>
			  <input class="form-control" type="text" name="name" placeholder="Full Name" required>
			  
			  <label for="psw"><b>Email</b></label>
			  <input class="form-control" type="text" name="email" placeholder="ex: abc@xyz.com" required>
			  
			  <label for="psw"><b>Mobile No.</b></label>
			  <input class="form-control" type="text" name="contact" placeholder="Mobile No." required>
				
			  <label for="psw"><b>Company Name</b></label>
			  <input class="form-control" type="text" name="company" placeholder="Company Name" required>
			  <label>
				<input type="checkbox" name="stayLoggedIn" value=1> Remember me
			  </label>
			  <button class="btn btn-dark" type="submit" name="submit">Sign Up</button>
			  <input type="hidden" name="signUp" value="1">
			</div>

			<div class="container" style="background-color:#f1f1f1">
			  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
			</div>
		  </form>
		</div>

	<script>
	// Get the modal
	var modal = document.getElementById('id02');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	</script>
	
	<script>
	// Get the modal
	var modal = document.getElementById('id01');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	</script>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>


