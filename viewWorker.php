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
	
	if(array_key_exists('updateButton',$_POST))
	{
		$query = "UPDATE `workers` SET `W_SALARY` = '".$_POST['W_SALARY']."' WHERE `W_ID` = '".$_SESSION['W_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `workers` SET `W_ADDRESS` = '".$_POST['W_ADDRESS']."' WHERE `W_ID` = '".$_SESSION['W_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `workers_contact` SET `CONTACT1` = '".$_POST['CONTACT1']."' WHERE `W_ID` = '".$_SESSION['W_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `workers_contact` SET `CONTACT2` = '".$_POST['CONTACT2']."' WHERE `W_ID` = '".$_SESSION['W_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `workers` SET `W_NAME` = '".$_POST['W_NAME']."' WHERE `W_ID` = '".$_SESSION['W_ID']."'";
		mysqli_query($link,$query);
	}
	
	$query = "SELECT `workers`.*,`workers_contact`.CONTACT1,`workers_contact`.CONTACT2 FROM `workers` INNER JOIN `workers_contact` ON `workers`.W_ID = `workers_contact`.W_ID where `A_ID` = '".$_SESSION['UserName']."' AND `workers_contact`.W_ID = '".$_SESSION['W_ID']."' ";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);
	
?>

<html>

	<head>

		<title>Jwelery WholeSale Management System</title>
		
		<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
		
		<style>
		
			th
			{
				width:20%;
			}
		
		</style>

	</head>
	
	<body style="background-image:url('background.jpg');">
	
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <h2 style="color:white;margin:0 13px 0 0">WORKER DETAIL</h2>
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal">UPDATE</button>
			</div>
			<ul class="navbar-nav mr-auto">
			</ul>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="ml-auto nav-item">
			  <a href ='workers.php'><button class="btn btn-outline-light" type="submit">Back</button></a>
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			 </div>
		  </div>
		</nav>
		
		<div class="container" style="margin-top:3%;">
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				  <tr>
					<th id="1"><h5><b>W_ID</b></h5></th>
					<th id="1"><h5><b><?php echo $row['W_ID'] ?></b></h5></th>
				  </tr>
				</thead>
			  </tbody>
			<table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark"">
					<tr>
					  <th id="1"><h5><b>W_Name</b></h5></th>
					  <th id="1"><h5><b><?php echo $row['W_NAME'] ?></b></h5></th>
					</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>W_ADDRESS</b></h5></th>
				  <th><h5><b><?php echo $row['W_ADDRESS'] ?></b></h5></th>
				</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>W_SALARY</b></h5></th>
				  <th><h5><b><?php echo $row['W_SALARY'] ?></b></h5></th>
				</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>CONTACT1</b></h5></th>
				  <th><b><h5><?php echo $row['CONTACT1'] ?></b></h5></th>
				</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>CONTACT2</b></h5></th>
				  <th><b><h5><?php echo $row['CONTACT2'] ?></b></h5></th>
				</tr>
				</thead>
			  </tbody>
			</table>
		</div>
		
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			    <form method="post">
				  <div class="modal-body">
					<div class="container">
					  <label for="uname"><b>Worker Id</b></label>
					  <input class="form-control" type="text" name="W_ID" value=<?php echo $row['W_ID'] ?> disabled>

					  <label for="psw"><b>Worker Name</b></label>
					  <input class="form-control" type="text" name="W_NAME" value=<?php echo $row['W_NAME'] ?> >
					  
					  <label for="psw"><b>Worker Salary</b></label>
					  <input class="form-control" type="text" name="W_SALARY" value=<?php echo $row['W_SALARY'] ?> required>
					  
					  <label for="psw"><b>Worker Address</b></label>
					  <input class="form-control" type="text" name="W_ADDRESS" value=<?php echo $row['W_ADDRESS'] ?> required>
					  
					  <label for="psw"><b>Mobile No.</b></label>
					  <input class="form-control" type="text" name="CONTACT1" value=<?php echo $row['CONTACT1'] ?> required>
						
					  <label for="psw"><b>Mobile No.</b></label>
					  <input class="form-control" type="text" name="CONTACT2" value=<?php echo $row['CONTACT2'] ?> >
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" name="updateButton" class="btn btn-dark">Save Changes</button>
				  </div>
				</form>
			</div>
		  </div>
		</div>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>


