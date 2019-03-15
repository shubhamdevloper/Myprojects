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
	$Pamount = 0;
	$Pgold = 0;
	$Lgold = 0;
	$getAmount = 0;
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
		  <h2 style="color:white;margin:0 13px 0 0">VIEW TRANSACTION</h2>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="ml-auto nav-item">
			  <a href ='transaction.php'><button class="btn btn-outline-light" type="submit">Back</button></a>
			  <a href ='loggedIn.php'><button class="btn btn-outline-light" type="submit">Home</button></a>
			  <a href ='login.php?logout=1'><button class="btn btn-danger" type="submit">Logout</button></a>
			</div>
		  </div>
		</nav>
		
		<div class="container" style="margin-top:20px;">
			<form method="post">
			  <div class="form-group row">
				<label class="col-sm-1 col-form-label"><b>From :-</b></label>
				<input type="date" class="col-sm-3 form-control" name="startSearchDate">
				<label class="col-sm-1 col-form-label"><b>To :-</b></label>
				<input type="date" class="col-sm-3 form-control" name="endSearchDate">
				<div class="col-sm-2"><label class="form-control" style="width:110px"><input type="checkbox" name="allSearch"><b>All Data</b></label></div>
			    <button type="submit" name="searchSubmit" class="btn btn-dark col-sm-1" data-toggle="modal" data-target=".bd-search-modal-lg" style="width:100px;">Search</button>
			  </div>
			</form>
		</div>
		
		<div class="container" >
			<table class="table table-striped">
			  <?php	
				  echo "<thead>
					<tr>
					  <th scope='col'><h4>Product Id</h4></th>
					  <th scope='col'><h4>Type</h4></th>
					  <th scope='col'><h4>Weight</h4></th>
					  <th scope='col'><h4>Date</h4></th>
					  <th scope='col'><h4>Salesmen</h4></th>
					  <th scope='col'><h4>Supplier</h4></th>
					  <th scope='col'><h4>Supplied</h4></th>
					  <th scope='col'><h4>Customer</h4></th>
					  <th scope='col'><h4>Amount</h4></th>
					  <th scope='col'><h4>Paid</h4></th>
					</tr>
				  </thead>
				  <tbody>";
				if(array_key_exists('searchSubmit',$_POST))
				{
					if(array_key_exists('allSearch',$_POST))
					{
						$query = "select * from transaction where A_ID = '".$_SESSION['UserName']."' ";
					}
					else
					{
						$query = "select * from transaction where A_ID = '".$_SESSION['UserName']."' AND T_DATE >= '".$_POST['startSearchDate']."' AND T_DATE <= '".$_POST['endSearchDate']."'";
					}
					$result = mysqli_query($link, $query);
					while($row = mysqli_fetch_array($result))
					{
						if($row['PAID'] == 0)
							$PAID = "No";
						else
							$PAID = "Yes";
						$query = "select * from salesmen where S_ID = '".$row['S_ID']."' and A_ID = '".$_SESSION['UserName']."' ";
						$S = mysqli_fetch_array(mysqli_query($link, $query));
						if(mysqli_query($link, "select * from customers where C_ID = '".$row['C_ID']."' and A_ID = '".$_SESSION['UserName']."' "))
						{
							$Pgold += $row['P_WEIGHT'];
							$Pamount += $row['AMOUNT'];
							if($row['PAID'] == 0)
								$getAmount += $row['AMOUNT'];
							$C= mysqli_fetch_array(mysqli_query($link, "select * from customers where C_ID = '".$row['C_ID']."' and A_ID = '".$_SESSION['UserName']."' "));
						}
						if(mysqli_query($link, "select * from supplier where S_ID = '".$row['BS_ID']."' and A_ID = '".$_SESSION['UserName']."' "))
						{
							$Lgold += $row['P_WEIGHT'];
							$Pamount -= $row['AMOUNT'];
							if($row['PAID'] == 0)
								$getAmount -= $row['AMOUNT'];
							$BS= mysqli_fetch_array(mysqli_query($link, "select * from supplier where S_ID = '".$row['BS_ID']."' and A_ID = '".$_SESSION['UserName']."' "));
						}
						if(mysqli_query($link, "select * from supplied where S_ID = '".$row['TS_ID']."' and A_ID = '".$_SESSION['UserName']."' "))
						{
							$Pgold += $row['P_WEIGHT'];
							$Pamount += $row['AMOUNT'];
							if($row['PAID'] == 0)
								$getAmount += $row['AMOUNT'];
							$TS= mysqli_fetch_array(mysqli_query($link, "select * from supplied where S_ID = '".$row['TS_ID']."' and A_ID = '".$_SESSION['UserName']."' "));
						}
						$temp = "
						<tr>
						  <td><b>".$row['P_ID']."</b></td>
						  <td><b>".$row['P_TYPE']."</b></td>
						  <td><b>".$row['P_WEIGHT']."</b></td>
						  <td><b>".$row['T_DATE']."</b></td>
						  <td><b>".$S['S_NAME']."</b></td>
						  <td><b>".$BS['S_NAME']."</b></td>
						  <td><b>".$TS['S_NAME']."</b></td>
						  <td><b>".$C['C_NAME']."</b></td>
						  <td><b>".$row['AMOUNT']."</b></td>
						  <td><b>".$PAID."</b></td>
						</tr>";
						$_SESSION['transactionData'] .= $temp;
					}
					echo  $_SESSION['transactionData'];
				}
			  ?>
			  </tbody>
			</table>
		
			<div class="row">
				<div class="col">
					<p><label><b>Gold Sold : </b></label><button class="btn btn-success" style="margin-left:20px;"><?php echo $Pgold;?></button></p>
				</div>
				<div class="col">
					<p><label><b>Gold Bought : </b></label><button class="btn btn-success" style="margin-left:20px;"><?php echo$Lgold;?></button></p>
				</div>
				<div class="col">
					<p><label><b>Total Earning : </b></label><button class="btn btn-success" style="margin-left:20px;"><?php echo$Pamount-$getAmount;?></button></p>
				</div>
			</div>
		</div>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>