<?php
	session_start();
	include 'conn.php';

    // Parameters to be checked
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword =$_POST['passwordConfirm'];
    $county = $_POST['county'];
    $residence = $_POST['residence'];
    $pnumber = $_POST['pnumber'];

    // Register validation
    if(isset($_POST['register'])){
        $sql = "SELECT * FROM users WHERE email = '$email'AND username = '$username'";
        $query = $conn->query($sql);
        if($query->num_rows < 1){
			if($password == $cpassword){
                
		        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (fname, lname, username, email, pnumber, password) VALUES('$fname', '$lname', '$username', '$email', $pnumber, '$pass')";
                if($conn->query($sql)){
                    $_SESSION['success'] = 'User Registration Successful';
                }
                else{
                    $_SESSION['error'] = $conn->error;
                }
            }
			else{
				$_SESSION['error'] = 'Passwords do not match';
			}
        }
        else{
            $_SESSION['error'] = 'That email address or Username has been taken';
        }
    }
    else{
        $_SESSION['error'] = 'Input your user credentials first';
    }

    header('location: ../home.php');

    // Login validation

	// if(isset($_POST['login'])){

	// 	$sql = "SELECT * FROM users WHERE email = '$email'";
	// 	$query = $conn->query($sql);

	// 	if($query->num_rows < 1){
	// 		$_SESSION['error'] = 'Cannot find account that email address';
	// 	}
	// 	else{
	// 		$row = $query->fetch_assoc();
	// 		if(password_verify($password, $row['password'])){
	// 			$_SESSION['user'] = $row['id'];
	// 		}
	// 		else{
	// 			$_SESSION['error'] = 'Incorrect password';
	// 		}
	// 	}
		
	// }
	// else{
	// 	$_SESSION['error'] = 'Input login credentials first';
	// }

?>