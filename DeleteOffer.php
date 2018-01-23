<?php
	function DeleteOffer() {
		global $conn;
		
		$idOffer = $_POST['delete_btn'];
		
		$sql = "DELETE * FROM offer_history WHERE idOffer = '".$idOffer."';
		
		if ($conn->multi_query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql = "DELETE * FROM offer_photo WHERE idOffer = '".$idOffer."';
		
		if ($conn->multi_query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql = "DELETE * FROM offer WHERE idOffer = '".$idOffer."';
		
		if ($conn->multi_query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}	
		
		$header = "location: " . $_SERVER['REQUEST-URI'];
		header($header);
	}
?>
