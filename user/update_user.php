<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['id'];    
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
    if(isset($_POST['edit'])){
        $sql = "SELECT * FROM users WHERE customer_id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "UPDATE users SET fname = '$fname', lname = '$lname', username = '$username', email = '$email', pnumber = '$pnumber', residence = '$residence', county = '$county' WHERE customer_id = '$id'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Your details have been updated Successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'Your Record does not exist';
        }
    }
    else{
        $_SESSION['error'] = 'Input your user credentials first';
    }
    header('location: home.php');

?>