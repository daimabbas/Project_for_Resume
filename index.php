<?php
	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	//unset qunatity
	unset($_SESSION['qty_array']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Shopping Cart</title>
	
	<style>
		.product_image{
			height:200px;
		}
		.product_name{
			height:80px; 
			padding-left:20px; 
			padding-right:20px;
		}
		.product_footer{
			padding-left:20px; 
			padding-right:20px;
		}
	</style>
	<link href="bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default" style="background-color:#000;">
	  <div class="container-fluid">
	    <div class="navbar-header">
	 
	      <a class="navbar-brand" href="#">Daim Abbas Shopping center</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<!-- left nav here -->
            <li><a  href="">Home</a></li>
            <li><a  href="">Article</a></li>
            <li><a  href="">Porduct</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
			<li>
				<a href="view_cart.php"><span class="badge">
				<?php echo count($_SESSION['cart']); ?></span> Cart <span class="glyphicon glyphicon-shopping-cart"></span>
                </a>
            </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<?php
		//info message
		if(isset($_SESSION['message'])){
			?>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-6">
					<div class="alert alert-info text-center">
						<?php echo $_SESSION['message']; ?>
					</div>
				</div>
			</div>
			<?php
			unset($_SESSION['message']);
		}
		//end info message
		//fetch our products	
		//connection
		$conn = new mysqli('localhost', 'root', '', 'database');

		$sql = "SELECT * FROM products";
		
		
	$query = mysqli_query($conn,$sql);
		//$query = $conn->query($sql);
		
		while($row =mysqli_fetch_assoc($query)){ //$query->fetch_assoc() 
			
			?>
			<div class="col-sm-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row product_image">
							<img src="<?php echo $row['photo'] ?>" width="80%" height="auto">
						</div>
						<div class="row product_name">
							<h4><?php echo $row['name']; ?></h4>
						</div>
						<div class="row product_footer">
							<p class="pull-left"><b><?php echo $row['price']; ?></b></p>
							<span class="pull-right"><a href="add_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-plus">
                            </span> Cart</a></span>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	
		
		//end product row 
	?>
</div>
</body>
</html>