<?php
	$conn = new mysqli('localhost', 'root', '', 'wedding');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>