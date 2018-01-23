<?php include 'functions.php'; 

	if (isset($_GET['idOffer'])) {
		$offer = getOfferById($_GET['idOffer']);
	} else {
		header('location: index.php');
	}

	if (isset($_POST['buy_btn'])) {
		//dokończyć
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LM offers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid" style="background-color: skyblue">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php" style="color: #190967;">Last Minute</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<form class="navbar-form navbar-left" method="GET" action="index.php">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search offers" name="value">
					</div>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
				</form>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" style="color: #190967;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sort by <span class=" glyphicon glyphicon-sort"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#" style="font-size: 110%; color: #190967;"><span class=" glyphicon glyphicon-sort-by-alphabet"> Hotel A-Z</a></li>
							<li><a href="#" style="font-size: 110%; color: #190967;"><span class=" glyphicon glyphicon-sort-by-alphabet-alt"> Hotel Z-A </a></li>
							<li><a href="#" style="font-size: 110%; color: #190967;"><span class=" glyphicon glyphicon-sort-by-order"> Price UP</a></li>
							<li><a href="#" style="font-size: 110%; color: #190967;"><span class=" glyphicon glyphicon-sort-by-order-alt"> Price DOWN </a></li>
						</ul>
					</li>
					<?php 
						if(isAdmin()) {
							?>
							<li><a href="add_offer.php" style="color: #190967;"><span class="glyphicon glyphicon-plus"></span> Add offer</a></li>
							<li><a href="users.php" style="color: #190967;"><span class="glyphicon glyphicon-user"></span> <span class="glyphicon glyphicon-user"></span> Users</a></li>
						<?php }
						if(isLoggedIn() && !isAdmin()) { ?>
							<li><a href="shopping_cart.php" style="color: #190967;"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
							<li><a href="account.php" style="color: #190967;"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<?php }
						if(!isLoggedIn()) { ?>
							<li><a href="registration.php" style="color: #190967;"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
							<li><a href="login.php" style="color: #190967;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<?php }
						if(isLoggedIn()) {
							?>
							<li><a href="index.php?logout='1'" style="color: red;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						<?php } ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>


	<div class="container-fluid" style="margin-top: 50px">
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Offer</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php $photo = getPhoto($offer['idOffer']); ?>
						<img src="<?php echo $photo['source'];?>" alt="<?php echo $photo['name']; ?>" name="<?php echo $photo['name']; ?>"width="20%" height="20%"" / > 
					</td>
					<td>
						<a href="<?php echo "offer.php?idOffer=" . $offer['idOffer']; ?>"><?php echo getHotelPath($offer['idHotel']); ?></a>
						<br>
						Organizer = <?php echo getOrganizerName($offer['idOrganizer']); ?>
						<br>
						<b>price: <?php echo $offer['price'] . " " . $offer['currency']; ?></b>
					</td>
				</tr>
				<?php 
					if (isLoggedIn() && !isAdmin()) {
						?>
						<form method="POST" action="offer.php">
							<button type="submit" class="btn btn-primary" style="float: right;" name="buy_btn" value="<?php echo $offer['idOffer']; ?>">Add to shopping cart</button>
						</form>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>

<?--
///////////////////////////////
//	Dodać warunek			///
///////////////////////////////

?>
<? php /*
	if (!isLoggedIn()) {
		header('location: login.php');
	}*/
?>