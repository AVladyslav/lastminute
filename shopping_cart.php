<?php include 'functions.php'; 

	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		$boardBasis = array();
		if (isset($_GET['boardBasis'])) {
			$boardBasis = $_GET['boardBasis'];
		}
		$countries = array();
		if (isset($_GET['countries'])) {
			$countries = $_GET['countries'];
		}
		$hotelsServices = array();
		if (isset($_GET['hotelsServices'])) {
			$hotelsServices = $_GET['hotelsServices'];
		}
		$roomsFacilities = array();
		if (isset($_GET['roomsFacilities'])) {
			$roomsFacilities = $_GET['roomsFacilities'];
		}
		$roomsTypes = array();
		if (isset($_GET['roomsTypes'])) {
			$roomsTypes = $_GET['roomsTypes'];
		}
		$organizers = array();
		if (isset($_GET['organizers'])) {
			$organizers = $_GET['organizers'];
		}
	?>
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

	<div class="sidenav" style="background-color: skyblue;">
		<form action="index.php" method="GET">
			<legend><span class="glyphicon glyphicon-filter"></span> Filter</legend>
			<div class="form-group">
				<legend><span class="glyphicon glyphicon-usd"></span> min:</legend>
				<input type="text" class="form-control" name="min" style="padding-left: 20px">
				<legend><span class="glyphicon glyphicon-usd"></span> max:</legend>
				<input type="text" class="form-control" name="max">
			</div>
			<fieldset>
				<legend><span class="glyphicon glyphicon-cutlery"> Board basis</legend>
				<?php 
					foreach (getAllBoardBasis() as $boardBasisRow) {
						if (in_array($boardBasisRow[0], $boardBasis)) {
						 	?> <input type="checkbox" name="boardBasis[]" value="<?php echo $boardBasisRow[0]; ?>" checked/> <?php echo $boardBasisRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="boardBasis[]" value="<?php echo $boardBasisRow[0]; ?>" /> <?php echo $boardBasisRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend><span class="glyphicon glyphicon glyphicon-globe"></span> <span class="glyphicon glyphicon-flag"></span> Country</legend>
				<?php 
					foreach (getAllCountries() as $countryRow) {
						if (in_array($countryRow[0], $countries)) {
						 	?> <input type="checkbox" name="countries[]" value="<?php echo $countryRow[0]; ?>" checked/> <?php echo $countryRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="countries[]" value="<?php echo $countryRow[0]; ?>" /> <?php echo $countryRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend><span class="glyphicon glyphicon-tent"> <span class="glyphicon glyphicon-bed"> Rooms types</legend>
				<?php 
					foreach (getAllRoomsTypes() as $roomsTypeRow) {
						if (in_array($roomsTypeRow[0], $roomsTypes)) {
						 	?> <input type="checkbox" name="roomsTypes[]" value="<?php echo $roomsTypeRow[0]; ?>" checked/> <?php echo $roomsTypeRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="roomsTypes[]" value="<?php echo $roomsTypeRow[0]; ?>" /> <?php echo $roomsTypeRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend><span class="glyphicon glyphicon-lamp"></span> <span class="glyphicon glyphicon-cd"></span> <span class="glyphicon glyphicon-phone-alt"></span> Rooms facilities</legend>
				<?php 
					foreach (getAllRoomsFacilities() as $roomsFacilityRow) {
						if (in_array($roomsFacilityRow[0], $roomsFacilities)) {
						 	?> <input type="checkbox" name="roomsFacilities[]" value="<?php echo $roomsFacilityRow[0]; ?>" checked/> <?php echo $roomsFacilityRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="roomsFacilities[]" value="<?php echo $roomsFacilityRow[0]; ?>" /> <?php echo $roomsFacilityRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend><span class="glyphicon glyphicon-blackboard"></span> <span class="glyphicon glyphicon-tree-deciduous"></span> <span class="glyphicon glyphicon-film"></span> <span class="glyphicon glyphicon-glass"></span> Hotels services</legend>
				<?php 
					foreach (getAllHotelsServices() as $hotelsServiceRow) {
						if (in_array($hotelsServiceRow[0], $hotelsServices)) {
						 	?> <input type="checkbox" name="hotelsServices[]" value="<?php echo $hotelsServiceRow[0]; ?>" checked/> <?php echo $hotelsServiceRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="hotelsServices[]" value="<?php echo $hotelsServiceRow[0]; ?>" /> <?php echo $hotelsServiceRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend> <span class="glyphicon glyphicon-info-sign"></span> Organizer</legend>
				<?php 
					foreach (getAllOrganizers() as $organizerRow) {
						if (in_array($organizerRow[0], $organizers)) {
						 	?> <input type="checkbox" name="organizers[]" value="<?php echo $organizerRow[0]; ?>" checked/> <?php echo $organizerRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="organizers[]" value="<?php echo $organizerRow[0]; ?>" /> <?php echo $organizerRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<button type="submit" class="btn btn-primary" style="float: right; margin-bottom: 50px">Apply</button>
		</form>
	</div>

	<div class="container-fluid" style="margin-left:200px; margin-top: 50px">
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Offer</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (getAllOffers() as $offer) {
					?>
					<tr>
						<td>
							<?php $photo = getPhoto($offer['0']); ?>
							<img src="<?php echo $photo['source'];?>" alt="HTML5 Icon" width="20%" height="20%"" / > 
						</td>
						<td>
							<a href="<?php echo "offer.php?idOffer=" . $offer['0']; ?>"><?php echo getHotelPath($offer['4']); ?></a>
							<br>
							Organizer = <?php echo getOrganizerName($offer['8']); ?>
							<br>
							<b>price: <?php echo $offer['1'] . " " . $offer['2']; ?></b>
						</td>
					</tr>
					<?php
				}
				/*for ($i=0; $i < 2; $i++) {
					?>
					<tr>
					<td>
					 <img src="Photos/costa-caleta-basen-576618070-570-428.jpg" alt="HTML5 Icon" width="20%" height="20%"" / > 
					</td>
					<td>
						<a href=""></a>
					</td>
					</tr>
					<?php
				}*/ ?>
			</tbody>
		</table>
	</div>
</body>
</html>

<?--
///////////////////////////////
//	Dodaæ warunek			///
///////////////////////////////

?>
<? php /*
	if (!isLoggedIn()) {
		header('location: login.php');
	}*/
?>