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

	$mydate=getdate(date("U"));
	$mydate= $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
	
	if(!isset($_SESSION['transactionData']))
	{
		$_SESSION['transactionData']="";
	}
	
?>

<html>

	<head>

		<title>Jwelery WholeSale Management System</title>
		
		<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
		
		<style>
		
		
		
		</style>

	</head>
	
	<body style="background-image:url('background.jpg');">
	
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <h2 style="color:white;margin:0 13px 0 0">Generate Bill</h2>
			<ul class="navbar-nav mr-auto">
			</ul>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="mr-auto nav-item">
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#customerListModalLong">Customer List</button>
			  <button class="btn btn-outline-light" data-toggle="modal" data-target="#salesmenListModalLong">Salesmen List</button>
			</div>
			<div class="ml-auto nav-item">
			  <a href ='transaction.php'><button class="btn btn-outline-light" type="submit">Back</button></a>
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			 </div>
		  </div>
		</nav>
		
		<form method="post">
			<div class="container">
				<br>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"><h4>Customer Id :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="C_ID" value="<?php if(isset($_POST['C_ID'])) { echo htmlentities ($_POST['C_ID']); }?>" placeholder="Enter Customer Id"></div>
					<label class="col-sm-2 col-form-label"><h4>Salesmen Id :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="S_ID" value="<?php if(isset($_POST['S_ID'])) { echo htmlentities ($_POST['S_ID']); }?>" placeholder="Enter Salesmen Id"></div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"><h4>Product Id :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="P_ID" placeholder="Enter Product Id" style="width:350px;" ></div>
					<label class="col-sm-2 col-form-label"><h4>Gold Price :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="goldPrice" value="<?php if(isset($_POST['goldPrice'])) { echo htmlentities ($_POST['goldPrice']); }?>" placeholder="Enter Gold Price" style="width:350px;" ></div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"><h4>Purity :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="purity" value="<?php if(isset($_POST['purity'])) { echo htmlentities ($_POST['purity']); }?>" placeholder="Enter Gold Purity" style="width:350px;" ></div>
					<label class="col-sm-2 col-form-label"><h4>Touch :-</h4></label>
					<div class="col-sm-4"><input class="form-control" type="text" name="touch" placeholder="Enter Touch" style="width:350px;" ></div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
						<label class="form-control"><input type="checkbox" name="isPaid"><b>Is Paid</b></label>
					</div>
					<div class="col" style="margin-left:20px;">
						<button type="submit" class="btn btn-dark" name="add_Data" style="width:100px;">Add</button>
					</div>
				</div>
			</div>
		</form>
		
		
		<div class="container">
			<table class="table table-striped">
			  <?php	
				  if(isset($_POST['isPaid']))
					  $isPaid = 1;
				  else
					  $isPaid = 0;
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>P_ID</h4></th>
					  <th scope='col'><h4>P_Type</h4></th>
					  <th scope='col'><h4>P_Weight</h4></th>
					  <th scope='col'><h4>TOUCH</h4></th>
					  <th scope='col'><h4>FINE</h4></th>
					  <th scope='col'><h4>AMOUNT</h4></th>
					</tr>
				  </thead>
				  <tbody>";
				if(array_key_exists('C_ID',$_POST))
				{
					$query = "select * from customers where C_ID = '".$_POST['C_ID']."' and A_ID = '".$_SESSION['UserName']."' ";
					$result = mysqli_query($link, $query);
					$row = mysqli_fetch_array($result);
					$billPending = $row['BILL PENDING'];
					$bill = $row['BILL'];
					if (isset($row)) 
					{
						$query = "select * from salesmen where S_ID = '".$_POST['S_ID']."' and A_ID = '".$_SESSION['UserName']."' ";
						$result = mysqli_query($link, $query);
						$row = mysqli_fetch_array($result);
						$comm = $row['COMMISSION'];
						if (isset($row)) 
						{
							$query = "select * from products where P_ID = '".$_POST['P_ID']."' and A_ID = '".$_SESSION['UserName']."' ";
							$result = mysqli_query($link, $query);
							$row = mysqli_fetch_array($result);
							if (isset($row))
							{
								$productID = $row['P_ID'];
								$productTYPE = $row['P_TYPE'];
								$productWEIGHT = $row['P_WEIGHT'];
								if(array_key_exists('add_Data',$_POST))
								{
									$fine = ($row['P_WEIGHT']*$_POST['touch'])/100;
									$price = ($fine*$_POST['goldPrice'])/10;
									$query = "DELETE FROM `products` WHERE `P_ID` = '".$_POST['P_ID']."'";
									if(mysqli_query($link, $query))
									{
										$query = " INSERT INTO `transaction` (`A_ID`, `S_ID`, `C_ID`, `T_DATE`, `P_ID`,`AMOUNT`, `PAID`,`P_TYPE`,`P_WEIGHT`) VALUES ('".$_SESSION['UserName']."', '".$_POST['S_ID']."', '".$_POST['C_ID']."','". $mydate ."','".$_POST['P_ID']."', '".$price."', '".$isPaid."','".$productTYPE."','".$productWEIGHT."'); ";
										mysqli_query($link, $query);
										$billPending += $price; 
										$bill += $price;
										$comm += ($price*0.015);
										if($isPaid == 0)
										{
											$query = "UPDATE `customers` SET `BILL PENDING`=".$billPending.",`BILL`=".$bill." WHERE `C_ID` = '".$_POST['C_ID']."'";
										}
										else
										{
											$query = "UPDATE `customers` SET `BILL`=".$bill." WHERE `C_ID` = '".$_POST['C_ID']."'";
										}
										mysqli_query($link,$query);
										$query = "UPDATE `salesmen` SET `COMMISSION`=".$comm." WHERE `S_ID` = '".$_POST['S_ID']."'";
										mysqli_query($link,$query);
									}
									$temp = "
									<tr>
									  <td><b>".$productID."</b></td>
									  <td><b>".$productTYPE."</b></td>
									  <td><b>".$productWEIGHT."</b></td>
									  <td><b>".$_POST['touch']."</b></td>
									  <td><b>".$fine."</b></td>
									  <td><b>".$price."</b></td>
									</tr>";
									$_SESSION['transactionData'] .= $temp;
									echo  $_SESSION['transactionData'];
								}
							}						
						}
					}
				}
			  ?>
			  </tbody>
			</table>
		</div>
		
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
				    $customersresult = mysqli_query($link, "SELECT `C_ID`,`C_NAME` FROM `customers` WHERE `A_ID`= '".$_SESSION['UserName']."' ORDER BY C_NAME ");
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
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>


