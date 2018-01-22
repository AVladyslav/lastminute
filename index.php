<?php include 'functions.php'; 

	
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
	<?php
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
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Last Minute</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="countries.php"><span class="glyphicon glyphicon-globe"></span> Countries</a></li>
				</ul>
				<form class="navbar-form navbar-left" method="GET" action="index.php">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search everywhere" name="value">
					</div>
					<button type="submit" class="btn btn_main_search">Search</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> User</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="sidenav">
		<form action="index.php" method="GET">
			<div class="form-group">
				<label for="min">min:</label>
				<input type="text" class="form-control" name="min" style="padding-left: 20px">
				<label for="max">max:</label>
				<input type="text" class="form-control" name="max">
			</div>
			<fieldset>
				<legend>Country</legend>
				<?php 
					foreach (getAllCountries() as $countryRow) {
						if (in_array($countryRow[0], $countries)) {
						 	?> <input type="checkbox" name="countries[]" value="<?php echo $countryRow[0]; ?>" checked/><?php echo $countryRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="countries[]" value="<?php echo $countryRow[0]; ?>" /><?php echo $countryRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend>Rooms types</legend>
				<?php 
					foreach (getAllRoomsTypes() as $roomsTypeRow) {
						if (in_array($roomsTypeRow[0], $roomsTypes)) {
						 	?> <input type="checkbox" name="roomsTypes[]" value="<?php echo $roomsTypeRow[0]; ?>" checked/><?php echo $roomsTypeRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="roomsTypes[]" value="<?php echo $roomsTypeRow[0]; ?>" /><?php echo $roomsTypeRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend>Rooms facilities</legend>
				<?php 
					foreach (getAllRoomsFacilities() as $roomsFacilityRow) {
						if (in_array($roomsFacilityRow[0], $roomsFacilities)) {
						 	?> <input type="checkbox" name="roomsFacilities[]" value="<?php echo $roomsFacilityRow[0]; ?>" checked/><?php echo $roomsFacilityRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="roomsFacilities[]" value="<?php echo $roomsFacilityRow[0]; ?>" /><?php echo $roomsFacilityRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<fieldset>
				<legend>Hotels services</legend>
				<?php 
					foreach (getAllHotelsServices() as $hotelsServiceRow) {
						if (in_array($hotelsServiceRow[0], $hotelsServices)) {
						 	?> <input type="checkbox" name="hotelsServices[]" value="<?php echo $hotelsServiceRow[0]; ?>" checked/><?php echo $hotelsServiceRow[1]; ?><br /> <?php
						} else {
							?> <input type="checkbox" name="hotelsServices[]" value="<?php echo $hotelsServiceRow[0]; ?>" /><?php echo $hotelsServiceRow[1]; ?><br /> <?php
						}
					} ?>
			</fieldset>
			<button type="submit" class="btn btn-default" style="float: right; margin-bottom: 50px">Apply</button>
		</form>
	</div>

	<div class="container" style="margin-left:200px; margin-top: 50px">
		<h1><?php echo getUserInfo(); ?> </h1>
		<?php 
		foreach ($countries as $country => $value) {
			echo $value . "<br>";
		}
		?>
		<h1>Fixed Navbar</h1>
		
		<h1>jasdfkhsakjdlhf</h1> sadkfjhsalkdjfh asdkjkfhakjsdfasdkfh
		asiduhfklashdfkjshdafkj

		asuhdfkahsdlkfj
		asdkhfkljsadh
		hsajkdhfksjahfd
		hsgfkjhgsadfgasdkj
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