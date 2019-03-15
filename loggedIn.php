<?php

    session_start();

    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
		
		echo "i ran";
        
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
	  <h4 class="nav-brand" id="#OwnerName" style="color:white;"></h4>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
		<h3 style="color:white;margin:0 13px 0 0">Hello : <?php echo $user; ?></h3>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<div class="ml-auto nav-item">
		  <a href ='login.php?logout=1'>
			<button class="btn btn-danger" type="submit">Logout</button></a>
		 </div>
	  </div>
	</nav>
	<br><br>
	<div class="container">
	  <div class="row" style="margin-top:-2%;">
		<div class="col">
		  <button onclick="location.href = 'customer.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Customers</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'salesmen.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Salesmen</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'products.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Products</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'transaction.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Transactions</h2></button>
		</div>
	  </div>
	  <br>
	  <div class="row">
		<div class="col">
		  <button onclick="location.href = 'workers.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Workers</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'tosupplier.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>To Supplier</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'bysupplier.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>By Supplier</h2></button>
		</div>
		<div class="col">
		  <button onclick="location.href = 'accounts.php';" class="btn-lg btn-dark" style="width:250px;height:250px;"><h2>Accounts</h2></button>
		</div>
	  </div>
	 </div>
	
	<script src="jquery-3.3.1.slim.min.js" type="text/javascript">	</script>
	
	<script src="popper.min.js" type="text/javascript">	</script>
	
	<script src="bootstrap.min.js" type="text/javascript"> </script>
	
	</body>

</html>