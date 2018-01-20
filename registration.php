<?php include('functions.php') ?>
<!DOCTYPE html>
<html lang="en-US">



	<head>
		<title>LM registration</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<style type="text/css">
			body {
				background-color: SkyBlue;
			}
		</style>
	</head>
	
	<body>
		<div class="container">
			<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12" style="margin: auto; margin-top: 4%; margin-bottom: 10%;">
				<h1 style="text-align: center;">Registration</h1>
				<?php include('errors.php'); ?>
				<form method="POST" action="registration.php">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="name" maxlength="45" value="<?php echo $name; ?>" required>
					</div>
					<div class="form-group">
						<label for="surname">Surname:</label>
						<input type="text" class="form-control" name="surname" maxlength="45" value="<?php echo $surname; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control" name="email" maxlength="100" value="<?php echo $email; ?>" required>
					</div>
					<div class="form-group">
						<label for="country">Country:</label>
						<input type="text" class="form-control" name="country" maxlength="45" value="<?php echo $country; ?>" required>
					</div>
					<div class="form-group">
						<label for="region">Region:</label>
						<input type="text" class="form-control" name="region" maxlength="100" value="<?php echo $region; ?>" required>
					</div>
					<div class="form-group">
						<label for="city">City:</label>
						<input type="text" class="form-control" name="city" maxlength="100" value="<?php echo $city; ?>" required>
					</div>
					<div class="form-group">
						<label for="address">Address:</label>
						<input type="text" class="form-control" name="address" maxlength="200" value="<?php echo $address; ?>">
					</div>
					<div class="form-group">
						<label for="pwd1">Password:</label>
						<input type="password" class="form-control" name="pwd1" required>
					</div>
					<div class="form-group">
						<label for="pwd2">Repeat password:</label>
						<input type="password" class="form-control" name="pwd2" required>
					</div>
					<button type="submit" class="btn btn-primary" style="float: right" name="register_btn">Submit</button>
				</form>
			</div>

		</div>
	</body>
</html>