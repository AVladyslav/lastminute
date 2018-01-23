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
		header("location: login.php");
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
				header('location: home.php');
			}else{
				$idCountry = writeCountry();
				$idRegion = writeRegion($idCountry);
				$idCity = writeCity($idRegion);
				$idAddress = writeAddress($idCity);
				$logged_in_user_id = writeUser(2, $idAddress);

				// get id of the created user

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['user_role'] = 'USER';
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
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
		$query = "SELECT COUNT(*) AS number_of_users FROM user WHERE email = '$email'";
		$result = mysqli_query($db, $query);

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


	function getUserRoleById($id)
	{
		global $db;

		$query = "SELECT idRole FROM user_role WHERE idUser = '$id'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		$idRole = $row['idRole'];

		$query = "SELECT role FROM role WHERE idRole = '$idRole'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);

		echo "idUser = " . $id . ", idRole = " . $idRole . ", role = " . $row['role'];
		return $row['role'];
	}

	// LOGIN USER
	function login(){
		global $db, $email, $errors;

		// grap form values
		$email = e($_POST['email']);
		$password = e($_POST['pwd']);

		// make sure form is filled properly
		if (empty($email)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				$user_role = getUserRoleById($logged_in_user['idUser']);
				if ($user_role == 'ADMIN') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['user_role'] = $user_role;
					$_SESSION['success']  = "You are now logged in";
					header('location: index.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['user_role'] = $user_role;
					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong email/password combination");
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
		if (isset($_SESSION['user']) && $_SESSION['user_role'] == 'ADMIN' ) {
			return true;
		}else{
			return false;
		}
	}


//TODO dokończyć w razie potrzeby
	function getUserInfo()
	{
		return "Name: " . $_SESSION['user']['name'];
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function getAllBoardBasis(){
		global $db;

		$sql = "SELECT * FROM board_basis";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getAllCountries(){
		global $db;

		$sql = "SELECT * FROM country";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getAllHotelsServices(){
		global $db;

		$sql = "SELECT * FROM hotels_service";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getAllRoomsFacilities(){
		global $db;

		$sql = "SELECT * FROM rooms_facility";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getAllRoomsTypes(){
		global $db;

		$sql = "SELECT * FROM rooms_type";
		$result = $db->query($sql);
		return $result->fetch_all();
	}


	function getAllOrganizers()
	{
		global $db;

		$sql = "SELECT * FROM organizer";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getAllOffers()
	{
		global $db;

		$sql = "SELECT * FROM offer";
		$result = $db->query($sql);
		return $result->fetch_all();
	}

	function getHotelPath($idHotel)
	{
		global $db;
		$out = "";

		$sql = "SELECT * FROM hotel WHERE idHotel = '$idHotel'";
		$result = $db->query($sql);
		$hotel = mysqli_fetch_assoc($result);

		$idCity = $hotel['idCity'];
		$sql = "SELECT * FROM city WHERE idCity = '$idCity'";
		$result = $db->query($sql);
		$city = mysqli_fetch_assoc($result);

		$idRegion = $city['idRegion'];
		$sql = "SELECT * FROM region WHERE idRegion = '$idRegion'";
		$result = $db->query($sql);
		$region = mysqli_fetch_assoc($result);

		$idCountry = $region['idCountry'];
		$sql = "SELECT * FROM country WHERE idCountry = '$idCountry'";
		$result = $db->query($sql);
		$country = mysqli_fetch_assoc($result);

		$out = $country['country'] . "/" . $region['region'] . "/" . $city['city'] . "/" . $hotel['hotel'];

		return $out;
	}

	function getOrganizerName($idOrganizer)
	{
		global $db;

		$sql = "SELECT * FROM organizer WHERE idOrganizer = '$idOrganizer'";
		$result = $db->query($sql);
		$organizer = mysqli_fetch_assoc($result);

		return $organizer['organizer'];
	}

	function getPhoto($idOffer)
	{
		global $db;

		$sql = "SELECT * FROM offer_photo WHERE idOffer = '$idOffer' LIMIT 1";
		$result = $db->query($sql);
		$offer_photo = mysqli_fetch_assoc($result);

		$idPhoto = $offer_photo['idPhoto'];
		$sql = "SELECT * FROM photo WHERE idPhoto = '$idPhoto'";
		$result = $db->query($sql);
		$photo = mysqli_fetch_assoc($result);

		return $photo;
	}

	function getOfferById($idOffer)
	{
		global $db;

		$sql = "SELECT * FROM offer WHERE idOffer = '$idOffer'";
		$result = $db->query($sql);

		return  mysqli_fetch_assoc($result);
	}
?>