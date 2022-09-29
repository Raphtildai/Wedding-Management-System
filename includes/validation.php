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
        $sql = "SELECT * FROM users WHERE email = '$email' AND username = '$username'";
        $query = $conn->query($sql);
        if($query->num_rows < 1){
			if($password == $cpassword){
		        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (fname, lname, username, email, pnumber, residence, county, password) VALUES('$fname', '$lname', '$username', '$email', '$pnumber', '$residence', '$county', '$pass')";
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
            $_SESSION['error'] = 'That email or username address has been taken';
        }
    }
    else{
        $_SESSION['error'] = 'Input your user credentials first';
    }
    header('location: ../user/register.php');

?>