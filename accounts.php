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
	$stockWeight = 0;
	$stockReceivable = 0;
	$stockPayable = 0;
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
		  <h2 style="color:white;margin:0 13px 0 0">ACCOUNTS</h2>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="mr-auto nav-item">
			</div>
			<div class="ml-auto nav-item">
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			</div>
		  </div>
		</nav>
		
		<div class="container" style="width:55%;">
			<p><h3><b>CUSTOMERS</b></h3></p>
			<table class="table table-striped">
			  <?php	
				  if(isset($_POST['isPaid']))
					  $isPaid = 1;
				  else
					  $isPaid = 0;
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>Id</h4></th>
					  <th scope='col'><h4>Name</h4></th>
					  <th scope='col'><h4>Contact</h4></th>
					  <th scope='col'><h4>AMOUNT(Receivable)</h4></th>
					</tr>
				  </thead>
				  <tbody>";
					$query = "select * from customers where A_ID = '".$_SESSION['UserName']."' ";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_array($result))
				    {
						$CC = mysqli_fetch_array(mysqli_query($link,"select * from customer_contact where C_ID = '".$row['C_ID']."' "));
						$stockReceivable += $row['BILL PENDING'];
						echo "
						<tr>
						  <td><b>".$row['C_ID']."</b></td>
						  <td><b>".$row['C_NAME']."</b></td>
						  <td><b>".$CC['CONTACT1']."</b></td>
						  <td><b>".$row['BILL PENDING']."</b></td>
						</tr>";
					}
			    ?>
			  </tbody>
			</table>
		</div>
		
		<div class="container" style="width:55%;">
			<p><h3><b>To Suppliers</b></h3></p>
			<table class="table table-striped">
			  <?php
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>Id</h4></th>
					  <th scope='col'><h4>Name</h4></th>
					  <th scope='col'><h4>Contact</h4></th>
					  <th scope='col'><h4>AMOUNT(Receivable)</h4></th>
					</tr>
				  </thead>
				  <tbody>";
					$query = "select * from supplied where A_ID = '".$_SESSION['UserName']."' ";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_array($result))
				    {
						$SS = mysqli_fetch_array(mysqli_query($link,"select * from supplied_contact where S_ID = '".$row['S_ID']."' "));
						$stockReceivable += $row['BILL PENDING'];
						echo "
						<tr>
						  <td><b>".$row['S_ID']."</b></td>
						  <td><b>".$row['S_NAME']."</b></td>
						  <td><b>".$SS['CONTACT1']."</b></td>
						  <td><b>".$row['BILL PENDING']."</b></td>
						</tr>";
					}
			    ?>
			  </tbody>
			</table>
		</div>
		
		<div class="container" style="width:55%;">
			<p><h3><b>By Suppliers</b></h3></p>
			<table class="table table-striped">
			  <?php
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>Id</h4></th>
					  <th scope='col'><h4>Name</h4></th>
					  <th scope='col'><h4>Contact</h4></th>
					  <th scope='col'><h4>AMOUNT(Payable)</h4></th>
					</tr>
				  </thead>
				  <tbody>";
					$query = "select * from supplier where A_ID = '".$_SESSION['UserName']."' ";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_array($result))
				    {
						$SS = mysqli_fetch_array(mysqli_query($link,"select * from supplier_contact where S_ID = '".$row['S_ID']."' "));
						$stockPayable += $row['BILL PENDING'];
						echo "
						<tr>
						  <td><b>".$row['S_ID']."</b></td>
						  <td><b>".$row['S_NAME']."</b></td>
						  <td><b>".$SS['CONTACT1']."</b></td>
						  <td><b>".$row['BILL PENDING']."</b></td>
						</tr>";
					}
			    ?>
			  </tbody>
			</table>
		</div>
		
		<div class="container" style="width:55%;">
			<p><h3><b>Salesmen</b></h3></p>
			<table class="table table-striped">
			  <?php
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>Id</h4></th>
					  <th scope='col'><h4>Name</h4></th>
					  <th scope='col'><h4>Contact</h4></th>
					  <th scope='col'><h4>AMOUNT(Payable)</h4></th>
					</tr>
				  </thead>
				  <tbody>";
					$query = "select * from salesmen where A_ID = '".$_SESSION['UserName']."' ";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_array($result))
				    {
						$SS = mysqli_fetch_array(mysqli_query($link,"select * from salesmen_contact where S_ID = '".$row['S_ID']."' "));
						echo "
						<tr>
						  <td><b>".$row['S_ID']."</b></td>
						  <td><b>".$row['S_NAME']."</b></td>
						  <td><b>".$SS['CONTACT1']."</b></td>
						  <td><b>".$row['COMMISSION']."</b></td>
						</tr>";
					}
			    ?>
			  </tbody>
			</table>
		</div>
		
		<div class="container" style="width:55%;">
			<p><h3><b>Product</b></h3></p>
			<table class="table table-striped">
			  <?php
					echo "<thead>
					<tr>
					  <th scope='col'><h4>Type</h4></th>
					  <th scope='col'><h4>No. Of Items</h4></th>
					  <th scope='col'><h4>Weight Of Items</h4></th>
					</tr>
					  </thead>
					  <tbody>";
					$query = "select *,COUNT(P_TYPE),SUM(P_WEIGHT) from products where A_ID = '".$_SESSION['UserName']."' GROUP BY P_TYPE";
					$r = mysqli_query($link,$query);
					while($result = mysqli_fetch_array($r))
					{
						$typeCount = $result['COUNT(P_TYPE)'];
						$weightCount = $result['SUM(P_WEIGHT)'];
						$stockWeight += $weightCount;
						echo "
						<tr>
						  <td><b>".$result['P_TYPE']."</b></td>
						  <td><b>".$typeCount."</b></td>
						  <td><b>".$weightCount."</b></td>
						</tr>";
					}
			    ?>
			  </tbody>
			</table>
		</div>
		
		<div class="container" style="width:65%;">
			<div class="row">
				<label class="col"><h5><b>Stock Weight : </b></h5></label>
				<button class="btn btn-success"><?php echo $stockWeight; ?> </button>
				<label class="col"><h5><b>Total Receivable Amount : </b></h5></label>
				<button class="btn btn-success"><?php echo $stockReceivable; ?> </button>
				<label class="col"><h5><b>Total Payable Amount : </b></h5></label>
				<button class="btn btn-success"><?php echo $stockPayable; ?> </button>
			</div>
		</div>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>