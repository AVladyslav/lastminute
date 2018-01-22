<?php include 'functions.php'; ?>
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
		f
		<a href="#about">About</a>
		<a href="#services">Services</a>
		<a href="#clients">Clients</a>
		<a href="#contact">Contact</a>
		<form action="index.php" method="GET">
			<div class="form-group">
				<label for="min">min:</label>
				<input type="text" class="form-control" name="min" style="left: 10px">
				<label for="max">max:</label>
				<input type="text" class="form-control" name="max">
			</div>
			<fieldset>
				<legend>Country</legend>
				<<?php 
					foreach ($getAllCountries() as $countryRow) { ?>
						<input type="checkbox" name="countries[]" value="<?php  echos $countryRow['country']?>" />Value 1<br />
				<?php } ?>
				<input type="checkbox" name="countries[]" value="value1" />Value 1<br />
				<input type="checkbox" name="countries[]" value="value2" />Value 2<br />
				<input type="checkbox" name="countries[]" value="value3" />Value 3<br />
			</fieldset>

			<button type="submit" class="btn btn-default" style="float: right; margin-bottom: 50px">Apply</button>
		</form>
	</div>

	<div class="container" style="margin-top:50px">
		<h1>Fixed Navbar</h1>
		
		<h1>jasdfkhsakjdlhf</h1> sadkfjhsalkdjfh asdkjkfhakjsdfasdkfh
		asiduhfklashdfkjshdafkj

		asuhdfkahsdlkfj
		asdkhfkljsadh
		hsajkdhfksjahfd
		hsgfkjhgsadfgasdkj
	</div>
	<h1><?php echo getUserInfo(); ?> </h1>
</body>
</html>


///////////////////////////////
//	Dodać warunek			///
///////////////////////////////


<? php /*
	if (!isLoggedIn()) {
		header('location: login.php');
	}*/
?>