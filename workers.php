<?php

    session_start();

    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if (array_key_exists("id", $_SESSION)) {
        
    } else {
        
        header("Location: login.php");
        
    }
	
	$link = mysqli_connect("localhost","root","","dbms project");
	if(mysqli_connect_error())
	{
		die("DataBase Connection Error");
	}
	$query = "SELECT * FROM `admin` WHERE id= '".$_SESSION['UserName']."' ";
	$row = mysqli_fetch_array(mysqli_query($link, $query));
	$user = $row['Name'];
	
?>

<html>

	<head>

		<title>Jwelery WholeSale Management System</title>
		
		<link href="bootstrap.min.css" rel="stylesheet" type="text/css">

	</head>
	
	<body style="background-image:url('background.jpg');">
	
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <h2 style="color:white;margin:0 13px 0 0">WORKERS</h2>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModalLong">Workers List</button>
			</div>
			<div class="ml-auto nav-item">
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			</div>
		  </div>
		</nav>
		
		<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="addCustomerModalTitle">New Worker</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <form method="post">
				  <div class="modal-body">
						<div class="container">
						  <label for="uname"><b>Id</b></label>
						  <input class="form-control" type="text" name="W_ID" placeholder="Enter Worker ID" required>

						  <label for="psw"><b>Name</b></label>
						  <input class="form-control" type="text" name="W_NAME" placeholder="Enter Worker Name" required>
						  
						  <label for="psw"><b>ADDRESS</b></label>
						  <input class="form-control" type="text" name="W_ADDRESS" placeholder="Enter ADDRESS" required>
						  
						  <label for="psw"><b>SALARY</b></label>
						  <input class="form-control" type="text" name="W_SALARY" placeholder="Enter Salary" required>
						  
						  <label for="psw"><b>Mobile No.</b></label>
						  <input class="form-control" type="text" name="CONTACT1" placeholder="Enter Mobile No." required>
							
						  <label for="psw"><b>Mobile No.</b></label>
						  <input class="form-control" type="text" name="CONTACT2" placeholder="Enter Mobile no.">
						  <input class="form-control" type="hidden" name="addView" value="0">
						</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-dark">Add Data</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		
	  <?php
	  
		if(array_key_exists('addView',$_POST))	
		{
			if($_POST['addView'] == '0')
			{
				$query = "INSERT INTO `workers`(`W_ID`,`A_ID`,`W_ADDRESS`,`W_NAME`,`W_SALARY`) VALUES('".mysqli_real_escape_string($link, $_POST['W_ID'])."','".$_SESSION['UserName']."','".mysqli_real_escape_string($link, $_POST['W_ADDRESS'])."','".mysqli_real_escape_string($link, $_POST['W_NAME'])."','".mysqli_real_escape_string($link, $_POST['W_SALARY'])."')" ;
					
				if(!mysqli_query($link,$query))
				{
					$error = "<p>Could not add Customer - please try again later.</p>";
				}
				
				$query = "INSERT INTO `workers_contact`(`W_ID`,`CONTACT1`,`CONTACT2`) VALUES('".mysqli_real_escape_string($link, $_POST['W_ID'])."','".mysqli_real_escape_string($link, $_POST['CONTACT1'])."','".mysqli_real_escape_string($link, $_POST['CONTACT2'])."')";
				
				if(!mysqli_query($link,$query))
				{
					$error = "<p>Could not add Customer Contact - please try again later.</p>";
				}
			}
		}
		
		if(array_key_exists('viewWorker',$_POST))
		{
			$_SESSION['W_ID'] = mysqli_real_escape_string($link, $_POST['W_ID']);
			
			header("Location: viewWorker.php");
		}
				
		if(array_key_exists('deleteWorker',$_POST))
		{
			$query = "DELETE FROM `workers_contact` WHERE `W_ID` = '".mysqli_real_escape_string($link, $_POST['W_ID'])."' ";
			if(!mysqli_query($link,$query))
			{
				$error = "<p>Could not delete Customer - please try again later.</p>";
			}
			
			$query="DELETE FROM `workers` WHERE `W_ID` = '".mysqli_real_escape_string($link, $_POST['W_ID'])."' AND `A_ID` = '".$_SESSION['UserName']."'";
			if(!mysqli_query($link,$query))
			{
				$error = "<p>Could not delete Customer - please try again later.</p>";
			}
		}
		
	  ?>
	  
	  <div class="mx-auto row">
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 30%;" data-toggle="modal" data-target="#addCustomerModal">ADD WORKER</button></div>
			<div class="col"><button type="button" class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 15% auto 20%;" data-toggle="modal" data-target="#viewCustomerModal">VIEW WORKER</button></div>
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 10%;" data-toggle="modal" data-target="#deleteCustomerModal">DELETE WORKER</button></div>
	  </div>
	  
		<div class="modal fade" id="viewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <form method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="viewCustomerModalLabel">Find Worker</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<div class="container">
							<input type="text" name="W_ID" placeholder="Enter Worker ID" class="form-control">
						</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button name="viewWorker" type="submit" class="btn btn-dark" style="width:25%;">Find</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <form method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Worker</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
					  <div class="modal-body">
						<div class="container">
							<input type="text" name="W_ID" placeholder="Enter Worker ID" class="form-control">
						</div>
					  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" name="deleteWorker" class="btn btn-dark">Delete</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Worker List</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<table class="table table-striped">
				  <?php	
					  echo "<thead>
						<tr>
						  <th scope='col'>W_ID</th>
						  <th scope='col'>W_NAME</th>
						</tr>
					  </thead>
					  <tbody>";
				    $result = mysqli_query($link, "SELECT `W_ID`,`W_NAME` FROM `workers` WHERE `A_ID`= '".$_SESSION['UserName']."' ORDER BY W_NAME");
					while($row = mysqli_fetch_array($result))
					{
						echo "
						<tr>
						  <td>".$row['W_ID']."</td>
						  <td>".$row['W_NAME']."</td>
						</tr>";
					}			
	              ?>
				  </tbody>
				</table>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>