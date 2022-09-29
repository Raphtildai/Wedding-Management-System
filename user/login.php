<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$user = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE email = '$user'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find User with that email';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['user'] = $row['customer_id'];
				$_SESSION['name'] = $row['fname']. ' '. $row['lname'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input User credentials first';
	}

	header('location: index.php');

?>