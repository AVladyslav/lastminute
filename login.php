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
				<h1 style="text-align: center;">Login</h1>
				<?php include('errors.php'); ?>
				<form method="POST" action="login.php">
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control" name="email" maxlength="100" value="<?php echo $email; ?>" required>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pwd" required>
					</div>
					<button type="submit" class="btn btn-primary" style="float: right" name="login_btn">Submit</button>
				</form>

			</div>
		</div>
	</body>
</html>