<?php 
	session_start();

	$db = mysqli_connect('localhost', 'root', 'root', 'last_minute_db');

	$name = "";
	$surname = "";
	$email    = "";
	$country = "";
	$region = "";
	$city = "";
	$address = "";
	$errors   = array(); 
	$logged_in_user_id = 0;

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	// REGISTER USER
	function register(){
		global $db, $errors, $logged_in_user_id;

		registrationCheckForErrors();
		getAllRegistrationData();

		if (count($errors) == 0) {

			//rejestracja dla określonego typu użytkownika
			if (isset($_POST['user_role'])) {
				
				$idCountry = writeCountry();
				$idRegion = writeRegion($idCountry);
				$idCity = writeCity($idRegion);
				$idAddress = writeAddress($idCity);
				$idRole = getIdRole();
				writeUser($idRole, $idAddress);

				$_SESSION['success']  = "New user successfully created!!";
				//header('location: home.php');
			}else{
				$idCountry = writeCountry();
				$idRegion = writeRegion($idCountry);
				$idCity = writeCity($idRegion);
				$idAddress = writeAddress($idCity);
				$logged_in_user_id = writeUser(2, $idAddress);

				// get id of the created user

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				//header('location: index.php');				
			}

		}

	}


	function registrationCheckForErrors()
	{
		global $errors, $db;

		if (e($_POST['pwd1']) != e($_POST['pwd2'])) {
			array_push($errors, "The two passwords do not match");
		}

		$email = e($_POST['email']);
		$sql = "SELECT COUNT(*) AS number_of_users FROM user WHERE email = '$email'";
		$result = mysqli_query($db, $sql);

		$row = mysqli_fetch_assoc($result);
		if ($row['number_of_users'] > 0) {
			array_push($errors, "Sorry, but user with this email already exist. Choose another one.");
		}
	}

	function getAllRegistrationData()
	{
		global $country, $region, $city, $address, $name, $surname, $email;

		$country = e($_POST['country']);
		$region = e($_POST['region']);
		$city = e($_POST['city']);
		$address = e($_POST['address']);
		$name = e($_POST['name']);
		$surname = e($_POST['surname']);
		$email = e($_POST['email']);
	}

	function getIdRole()
	{
		global $db;
		$user_role = e($_POST['user_role']);

		//pobieranie idRole uzytkownika
		$query = "SELECT * FROM role WHERE role = '$user_role";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		$idRole = $row['idRole'];
		return $idRole;
	}


	function writeCountry()
	{
		global $db, $country;

		$query = "SELECT idCountry FROM country WHERE country = '$country'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);

		if (isset($row['idCountry'])) {
			$idCountry = $row['idCountry'];
		} else {
			$query = "INSERT INTO country (country) VALUES('$country')";
			mysqli_query($db, $query);
			$idCountry = mysqli_insert_id($db);
		}
		return $idCountry;
	}


	function writeRegion($idCountry)
	{
		global $db, $region;

		$query = "SELECT idRegion FROM region WHERE region = '$region' AND idCountry = '$idCountry'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);

		if (isset($row['idRegion'])) {
			$idRegion = $row['idRegion'];
		} else {
			$query = "INSERT INTO region (region, idCountry) VALUES('$region', '$idCountry')";
			mysqli_query($db, $query);
			$idRegion = mysqli_insert_id($db);
		}
		return $idRegion;
	}


	function writeCity($idRegion)
	{
		global $db, $city;

		$query = "SELECT idCity FROM city WHERE city = '$city' AND idRegion = '$idRegion'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);

		if (isset($row['idCity'])) {
			$idCity = $row['idCity'];
		} else {
			$query = "INSERT INTO city (city, idRegion) VALUES('$city', '$idRegion')";
			mysqli_query($db, $query);
			$idCity = mysqli_insert_id($db);
		}
		return $idCity;
	}



	function writeAddress($idCity)
	{
		global $db, $address;

		if (isset($address)) {
			$query = "SELECT idAddress FROM address WHERE address = '$address' AND idCity = '$idCity'";
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);

			if (isset($row['idAddress'])) {
				$idAddress = $row['idAddress'];
			} else {
				$query = "INSERT INTO address (address, idCity) VALUES('$address', '$idCity')";
				mysqli_query($db, $query);
				$idAddress = mysqli_insert_id($db);
			}
		} else {

			$query = "SELECT idAddress FROM address WHERE address = empty AND idCity = '$idCity'";
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);

			if (isset($row['idAddress'])) {
				$idAddress = $row['idAddress'];
			} else {
				$query = "INSERT INTO address (idCity) VALUES('$idCity')";
				mysqli_query($db, $query);
				$idAddress = mysqli_insert_id($db);
			}
		}
		return $idAddress;
	}


	function writeUser($idRole, $idAddress)
	{
		global $db, $name, $surname, $email;

		$pwd1 = e($_POST['pwd1']);
		$pwd2 = e($_POST['pwd2']);

		$password = md5($pwd1);

		//zapis usera do tabeli
		$query = "INSERT INTO user (name, surname, email, password) VALUES('$name', '$surname', '$email', '$password')";
		mysqli_query($db, $query);

		//pobieranie user id
		$user_id = mysqli_insert_id($db);
		
		//przypisanie roli użytkownikowi
		$query = "INSERT INTO user_role (idUser, idRole) VALUES('$user_id', '$idRole')";
		mysqli_query($db, $query);

		$query = "INSERT INTO user_address (idUser, idAddress) VALUES('$user_id', '$idAddress')";
		mysqli_query($db, $query);

		return $user_id;
	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM user WHERE idUser=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>