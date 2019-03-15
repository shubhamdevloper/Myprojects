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
		$query = "UPDATE `supplier` SET `S_ADDRESS` = '".$_POST['S_ADDRESS']."' WHERE `S_ID` = '".$_SESSION['S_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `supplier` SET `S_EMAIL` = '".$_POST['S_EMAIL']."' WHERE `S_ID` = '".$_SESSION['S_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `supplier_contact` SET `CONTACT1` = '".$_POST['CONTACT1']."' WHERE `S_ID` = '".$_SESSION['S_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `supplier_contact` SET `CONTACT2` = '".$_POST['CONTACT2']."' WHERE `S_ID` = '".$_SESSION['S_ID']."'";
		mysqli_query($link,$query);
		$query = "UPDATE `supplier` SET `S_NAME` = '".$_POST['S_NAME']."' WHERE `S_ID` = '".$_SESSION['S_ID']."'";
		mysqli_query($link,$query);
	}
	
	$query = "SELECT `supplier`.*,`supplier_contact`.CONTACT1,`supplier_contact`.CONTACT2 FROM `supplier` INNER JOIN `supplier_contact` ON `supplier`.S_ID = `supplier_contact`.S_ID where `A_ID` = '".$_SESSION['UserName']."' AND `supplier_contact`.S_ID = '".$_SESSION['S_ID']."' ";
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
		  <h2 style="color:white;margin:0 13px 0 0">BY_SUPPLIER DETAIL</h2>
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal">UPDATE</button>
			</div>
			<ul class="navbar-nav mr-auto">
			</ul>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="ml-auto nav-item">
			  <a href ='bysupplier.php'><button class="btn btn-outline-light" type="submit">Back</button></a>
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
					<th id="1"><h5><b>S_ID</b></h5></th>
					<th id="1"><h5><b><?php echo $row['S_ID'] ?></b></h5></th>
				  </tr>
				</thead>
			  </tbody>
			<table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark"">
					<tr>
					  <th id="1"><h5><b>S_Name</b></h5></th>
					  <th id="1"><h5><b><?php echo $row['S_NAME'] ?></b></h5></th>
					</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
					<tr>
					  <th><h5><b>S_EMAIL</b></h5></th>
					  <th><h5><b><?php echo $row['S_EMAIL'] ?></b></h5></th>
					</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>S_ADDRESS</b></h5></th>
				  <th><h5><b><?php echo $row['S_ADDRESS'] ?></b></h5></th>
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
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>BILL PENDING</b></h5></th>
				  <th><b><h5><?php echo $row['BILL PENDING'] ?></b></h5></th>
				</tr>
				</thead>
			  </tbody>
			</table>
			<table class="table" style="margin-bottom:1.5%;">
			  <tbody>
				<thead class="thead-dark">
				<tr>
				  <th><h5><b>TOTAL BILL</b></h5></th>
				  <th><b><h5><?php echo $row['BILL'] ?></b></h5></th>
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
					  <label for="uname"><b>Id</b></label>
					  <input class="form-control" type="text" name="S_ID" value=<?php echo $row['S_ID'] ?> disabled>

					  <label for="psw"><b>Name</b></label>
					  <input class="form-control" type="text" name="S_NAME" value=<?php echo $row['S_NAME'] ?> >
					  
					  <label for="psw"><b>Email</b></label>
					  <input class="form-control" type="text" name="S_EMAIL" value=<?php echo $row['S_EMAIL'] ?> required>
					  
					  <label for="psw"><b>Address</b></label>
					  <input class="form-control" type="text" name="S_ADDRESS" value=<?php echo $row['S_ADDRESS'] ?> required>
					  
					  <label for="psw"><b>Mobile No.</b></label>
					  <input class="form-control" type="text" name="CONTACT1" value=<?php echo $row['CONTACT1'] ?> required>
						
					  <label for="psw"><b>Mobile No.</b></label>
					  <input class="form-control" type="text" name="CONTACT2" value=<?php echo $row['CONTACT2'] ?> >
					  
					  <label for="psw"><b>Bill Pending</b></label>
					  <input class="form-control" type="text" name="BILL PENDING" value=<?php echo $row['BILL PENDING'] ?> disabled>
					  
					  <label for="psw"><b>Total Bill</b></label>
					  <input class="form-control" type="text" name="BILL" value=<?php echo $row['BILL'] ?> disabled>
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


