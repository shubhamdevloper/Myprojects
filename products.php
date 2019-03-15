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
		  <h2 style="color:white;margin:0 13px 0 0">PRODUCT</h2>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModalLong">Product List</button>
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#workerModalLong">Worker List</button>
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
				<h5 class="modal-title" id="addCustomerModalTitle">New Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <form method="post">
				  <div class="modal-body">
						<div class="container">
						  <label for="uname"><b>Id</b></label>
						  <input class="form-control" type="text" name="P_ID" placeholder="Enter Product ID" required>

						  <label for="psw"><b>Type</b></label>
						  <input class="form-control" type="text" name="P_TYPE" placeholder="Enter  Product Type" required>
						  
						  <label for="psw"><b>Weight</b></label>
						  <input class="form-control" type="text" name="P_WEIGHT" placeholder="Enter Weight" required>
						  
						  <label for="psw"><b>Worker Id</b></label>
						  <input class="form-control" type="text" name="W_ID" placeholder="Enter Worker Id" required>
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
				$query = "INSERT INTO `products`(`P_ID`,`A_ID`,`P_TYPE`,`P_WEIGHT`,`W_ID`) VALUES('".mysqli_real_escape_string($link, $_POST['P_ID'])."','".$_SESSION['UserName']."','".mysqli_real_escape_string($link, $_POST['P_TYPE'])."','".mysqli_real_escape_string($link, $_POST['P_WEIGHT'])."','".mysqli_real_escape_string($link, $_POST['W_ID'])."')";
					
				if(!mysqli_query($link,$query))
				{
					$error = "<p>Could not add Salesmen - please try again later.</p>";
					echo $error;
				}
			}
		}
		
		if(array_key_exists('viewProduct',$_POST))
		{
			$_SESSION['P_ID'] = mysqli_real_escape_string($link, $_POST['P_ID']);
			
			header("Location: viewProduct.php");
		}
				
		if(array_key_exists('deleteProduct',$_POST))
		{
			$query="DELETE FROM `products` WHERE `P_ID` = '".mysqli_real_escape_string($link, $_POST['P_ID'])."' AND `A_ID` = '".$_SESSION['UserName']."'";
			if(!mysqli_query($link,$query))
			{
				$error = "<p>Could not delete Customer - please try again later.</p>";
			}
		}
		
	  ?>
	  
	  <div class="mx-auto row">
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 30%;" data-toggle="modal" data-target="#addCustomerModal">ADD PRODUCT</button></div>
			<div class="col"><button type="button" class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 15% auto 20%;" data-toggle="modal" data-target="#viewCustomerModal">VIEW PRODUCT</button></div>
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 10%;" data-toggle="modal" data-target="#deleteCustomerModal">DELETE PRODUCT</button></div>
	  </div>
	  
		<div class="modal fade" id="viewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <form method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="viewCustomerModalLabel">Find Product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<div class="container">
							<input type="text" name="P_ID" placeholder="Enter Product ID" class="form-control">
						</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button name="viewProduct" type="submit" class="btn btn-dark" style="width:25%;">Find</button>
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
					<h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
					  <div class="modal-body">
						<div class="container">
							<input type="text" name="P_ID" placeholder="Enter Product ID" class="form-control">
						</div>
					  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" name="deleteProduct" class="btn btn-dark">Delete</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Salesmen List</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<table class="table table-striped">
				  <?php	
					  echo "<thead>
						<tr>
						  <th scope='col'>P_ID</th>
						  <th scope='col'>P_TYPE</th>
						</tr>
					  </thead>
					  <tbody>";
				    $result = mysqli_query($link, "SELECT `P_ID`,`P_TYPE` FROM `products` WHERE `A_ID`= '".$_SESSION['UserName']."' ");
					while($row = mysqli_fetch_array($result))
					{
						echo "
						<tr>
						  <td>".$row['P_ID']."</td>
						  <td>".$row['P_TYPE']."</td>
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
		
		<div class="modal fade" id="workerModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Salesmen List</h5>
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
						  <th scope='col'>W_Name</th>
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