<?php

require_once('./../utils/auth.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	$id = $_POST['id'];

	$sql = "DELETE FROM events WHERE id = $id";

	$prepareQuery = $auth->prepare($sql);

	if ($prepareQuery == false) {
	 print_r($auth->errorInfo());
	 die ('Error preparing the query.');
	}

	$executeQuery = $prepareQuery->execute();
	if ($executeQuery == false) {
	 print_r($prepareQuery->errorInfo());
	 die ('Error executing the query.');
	}
	
} else if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['color'])
&& isset($_POST['duration_type'])
&& isset($_POST['booking_type'])
&& isset($_POST['amount']) 
&& isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$color = $_POST['color'];
	$amount = $_POST['amount'];

	$booking_type = $_POST['booking_type'];
	$duration_type = $_POST['duration_type'];

	$sql = "UPDATE events SET  title = '$title', description = '$description', amount = '$amount', color = '$color'
	, duration_type = '$duration_type', booking_type='$booking_type'
	 WHERE id = $id ";

	$prepareQuery = $auth->prepare($sql);

	if ($prepareQuery == false) {
	 print_r($auth->errorInfo());
	 die ('Error preparing the query.');
	}

	$executeQuery = $prepareQuery->execute();

	if ($executeQuery == false) {
	 print_r($prepareQuery->errorInfo());
	 die ('Error executing the query.');
	}
}

header('Location: ../index.php');	
?>
