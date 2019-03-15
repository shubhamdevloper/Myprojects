<?php

    session_start();

    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if (array_key_exists("id", $_SESSION)) {
        
    } else {
        
        header("Location: login.php");
        
    }
	
	if (array_key_exists("transactionData", $_SESSION)) {
        
        $_SESSION['transactionData'] = "";
        
    }
	
	$link = mysqli_connect("localhost","root","","dbms project");
	if(mysqli_connect_error())
	{
		die("DataBase Connection Error");
	}
	$query = "SELECT * FROM `admin` WHERE id= '".$_SESSION['UserName']."' ";
	$row = mysqli_fetch_array(mysqli_query($link, $query));
	$user = $row['Name'];
	
	$mydate=getdate(date("U"));
	$mydate= $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
?>

<html>

	<head>

		<title>Jwelery WholeSale Management System</title>
		
		<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
		
		<style>
			.vl {
				border-left: 2px solid grey;
				height: 40px;
				margin-right:3px;
			}
		</style>

	</head>
	
	<body style="background-image:url('background.jpg');">
	
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <h2 style="color:white;margin:0 13px 0 0">TRANSACTION</h2>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#customerListModalLong">Customer List</button>
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#salesmenListModalLong">Salesmen List</button>
			  <button class="btn btn-outline-light" data-toggle="modal" data-target=".bd-Today-modal-lg">Today's Transaction</button>
			</div>
			<div class="ml-auto nav-item">
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			</div>
		  </div>
		</nav>
		
		
	  <?php
	  
		if(array_key_exists('addView',$_POST))	
		{
			if($_POST['addView'] == '0')
			{
				$query = "INSERT INTO `customers`(`C_ID`,`S_ID`,`A_ID`,`C_ADDRESS`,`C_NAME`) VALUES('".mysqli_real_escape_string($link, $_POST['C_ID'])."','".mysqli_real_escape_string($link, $_POST['S_ID'])."','".$_SESSION['UserName']."','".mysqli_real_escape_string($link, $_POST['C_ADDRESS'])."','".mysqli_real_escape_string($link, $_POST['C_NAME'])."')";
					
				if(!mysqli_query($link,$query))
				{
					$error = "<p>Could not add Customer - please try again later.</p>";
				}
				
				$query = "INSERT INTO `customer_contact`(`C_ID`,`CONTACT1`,`CONTACT2`) VALUES('".mysqli_real_escape_string($link, $_POST['C_ID'])."','".mysqli_real_escape_string($link, $_POST['CONTACT1'])."','".mysqli_real_escape_string($link, $_POST['CONTACT2'])."')";
				
				if(!mysqli_query($link,$query))
				{
					$error = "<p>Could not add Customer Contact - please try again later.</p>";
				}
			}
		}
		
		if(array_key_exists('viewCustomer',$_POST))
		{
			$_SESSION['C_ID'] = mysqli_real_escape_string($link, $_POST['C_ID']);
			
			header("Location: viewCustomer.php");
		}
				
		if(array_key_exists('deleteCustomer',$_POST))
		{
			$query = "DELETE FROM `customer_contact` WHERE `C_ID` = '".mysqli_real_escape_string($link, $_POST['C_ID'])."' ";
			if(!mysqli_query($link,$query))
			{
				$error = "<p>Could not delete Customer - please try again later.</p>";
			}
			
			$query="DELETE FROM `customers` WHERE `C_ID` = '".mysqli_real_escape_string($link, $_POST['C_ID'])."' AND `A_ID` = '".$_SESSION['UserName']."'";
			if(!mysqli_query($link,$query))
			{
				$error = "<p>Could not delete Customer - please try again later.</p>";
			}
		}
		
	  ?>
	  
	  <div class="mx-auto row">
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 30%;" data-toggle="modal" data-target="#billModalCenter">BILL</button></div>
			<div class="col"><button type="button" class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 15% auto 20%;" data-toggle="modal" data-target="#viewTransactionModalCenter">VIEW TRANSACTION</button></div>
			<div class="col"><button class="btn-lg btn-dark" style="width:250px;height:250px;margin:30% 10% auto 10%;" data-toggle="modal" data-target="#deleteCustomerModal">DELETE TRANSACTION</button></div>
	  </div>
	  
	    <div class="modal fade" id="billModalCenter" tabindex="-1" role="dialog" aria-labelledby="BillModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Generate Bill For</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col">
							<button onclick="location.href = 'billGenerationCustomer.php';" type="button" class="btn btn-dark">Customers</button>
						</div>
						<div class="col">
							<button onclick="location.href = 'billGenerationToSupplier.php';" type="button" class="btn btn-dark">To Suppliers</button>
						</div>
						<div class="col">
							<button onclick="location.href = 'billGenerationBySupplier.php';" type="button" class="btn btn-dark">By Suppliers</button>
						</div>
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="viewTransactionModalCenter" tabindex="-1" role="dialog" aria-labelledby="BillModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">View Transaction By</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="container">
					<button onclick="location.href = 'viewTransactionByCustomer.php';" class="btn btn-outline-dark" style="width:100%">By Customers</button><br>
					<button onclick="location.href = 'viewTransactionToSupplier.php';" type="button" class="btn btn-outline-dark" style="width:100%">To Suppliers</button><br>
					<button onclick="location.href = 'viewTransactionBySupplier.php';" type="button" class="btn btn-outline-dark" style="width:100%">By Suppliers</button><br>
					<button onclick="location.href = 'viewTransactionBySalesmen.php';" type="button" class="btn btn-outline-dark" style="width:100%">By Salesmen</button><br>
					<button onclick="location.href = 'viewTransactionByDate.php';" type="button" class="btn btn-outline-dark" style="width:100%">By Date</button>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <form method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Transaction</h5>
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
					<button type="submit" name="deleteTransaction" class="btn btn-dark">Delete</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		<?php
			if(isset($_POST['deleteTransaction']))
			{
				$query = "select * from transaction where A_ID = '".$_SESSION['UserName']."' AND P_ID = '".$_POST['P_ID']."'";
				$result = mysqli_query($link,$query);
				$row = mysqli_fetch_array($result);
				$productID = $row['P_ID'];
				$productTYPE = $row['P_TYPE'];
				$productWEIGHT = $row['P_WEIGHT'];
				$query = "INSERT INTO `products`(`P_ID`,`A_ID`,`P_TYPE`,`P_WEIGHT`) VALUES('".$productID."','".$_SESSION['UserName']."','".$productTYPE."','".$productWEIGHT."')";
				mysqli_query($link,$query);
				$query = "DELETE FROM `transaction` WHERE A_ID = '".$_SESSION['UserName']."' AND P_ID = '".$_POST['P_ID']."'";
				mysqli_query($link,$query);
			}
		?>
		
		<div class="modal fade" id="customerListModalLong" tabindex="-1" role="dialog" aria-labelledby="customerListModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="customerListModalLongTitle">Customer List</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<table class="table table-striped">
				  <?php	
					  echo "<thead>
						<tr>
						  <th scope='col'>C_ID</th>
						  <th scope='col'>C_NAME</th>
						</tr>
					  </thead>
					  <tbody>";
				    $customersresult = mysqli_query($link, "SELECT `C_ID`,`C_NAME` FROM `customers` WHERE `A_ID`= '".$_SESSION['UserName']."' ORDER BY C_NAME");
					while($customersrow = mysqli_fetch_array($customersresult))
					{
						echo "
						<tr>
						  <td>".$customersrow['C_ID']."</td>
						  <td>".$customersrow['C_NAME']."</td>
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
		
		
		
		<div class="modal fade" id="salesmenListModalLong" tabindex="-1" role="dialog" aria-labelledby="customerListModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="customerListModalLongTitle">Salesmen List</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<table class="table table-striped">
				  <?php	
					  echo "<thead>
						<tr>
						  <th scope='col'>S_ID</th>
						  <th scope='col'>S_NAME</th>
						</tr>
					  </thead>
					  <tbody>";
				    $Salesmenresult = mysqli_query($link, "SELECT `S_ID`,`S_NAME` FROM `salesmen` WHERE `A_ID`= '".$_SESSION['UserName']."'  ORDER BY S_NAME");
					while($salesmenrow = mysqli_fetch_array($Salesmenresult))
					{
						echo "
						<tr>
						  <td>".$salesmenrow['S_ID']."</td>
						  <td>".$salesmenrow['S_NAME']."</td>
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
		
		<div class="modal fade bd-Today-modal-lg" tabindex="-1" role="dialog" aria-labelledby="TodayLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="customerListModalLongTitle">Today's Transaction</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<table class="table table-striped">
					  <?php	
						  echo "<thead>
							<tr>
							  <th scope='col'>Type</th>
							  <th scope='col'>Weigth</th>
							  <th scope='col'>Salesmen</th>
							  <th scope='col'>Supplied</th>
							  <th scope='col'>Supplier</th>
							  <th scope='col'>Customer</th>
							  <th scope='col'>Amount</th>
							  <th scope='col'>Is Paid</th>
							</tr>
						  </thead>
						  <tbody>";
						$Salesmenresult = mysqli_query($link, "SELECT * FROM `transaction` WHERE `A_ID`= '".$_SESSION['UserName']."' AND `T_DATE` = '".$mydate."'");
						$Pamount = 0;
						$Lamount = 0;
						$Pgold = 0;
						$Lgold = 0;
						while($salesmenrow = mysqli_fetch_array($Salesmenresult))
						{
							$S = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM `salesmen` WHERE `A_ID`= '".$_SESSION['UserName']."' AND `S_ID`='".$salesmenrow['S_ID']."'"));
							$TS = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM `supplied` WHERE `A_ID`= '".$_SESSION['UserName']."' AND `S_ID`='".$salesmenrow['TS_ID']."'"));
							$BS = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM `supplier` WHERE `A_ID`= '".$_SESSION['UserName']."' AND `S_ID`='".$salesmenrow['BS_ID']."'"));
							$C = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM `customers` WHERE `A_ID`= '".$_SESSION['UserName']."' AND `C_ID`='".$salesmenrow['C_ID']."'"));
							echo "
							<tr>
							  <td>".$salesmenrow['P_TYPE']."</td>
							  <td>".$salesmenrow['P_WEIGHT']."</td>
							  <td>".$S['S_NAME']."</td>
							  <td>".$TS['S_NAME']."</td>
							  <td>".$BS['S_NAME']."</td>
							  <td>".$C['C_NAME']."</td>
							  <td>".$salesmenrow['AMOUNT']."</td>
							  <td>";if($salesmenrow['PAID']==0){echo 'No';}else{echo 'Yes';}echo "</td>
							</tr>";
							if(isset($salesmenrow['BS_ID']))
							{
								$Lamount += $salesmenrow['AMOUNT'];
							}
							else
							{
								$Pamount += $salesmenrow['AMOUNT'];
							}
							if(isset($salesmenrow['BS_ID']))
							{
								$Lgold += $salesmenrow['P_WEIGHT'];
							}
							else
							{
								$Pgold += $salesmenrow['P_WEIGHT'];
							}
						}			
					  ?>
					  </tbody>
					</table>
				  </div>
				  <div class="modal-footer">
					<div class="mr-auto">
						<label><b>Amount :</b></label>
						<div class="btn btn-outline-success" data-dismiss="modal"><?php echo $Pamount; ?></div>
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><?php echo $Lamount; ?></button>
						<span class="vl"></span>
						<label><b>Gold :</b></label>
						<div class="btn btn-outline-success" data-dismiss="modal"><?php echo $Pgold; ?></div>
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><?php echo $Lgold; ?></button>
					</div>
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