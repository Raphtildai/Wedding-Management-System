<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['user'])){
		$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();
	}
	else{
		header('location: home.php');
		exit();
	}
?>