<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['id'];    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pnumber = $_POST['pnumber'];

    // Register validation
    if(isset($_POST['edit'])){
        $sql = "SELECT * FROM admin WHERE id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "UPDATE admin SET fname = '$fname', lname = '$lname', username = '$username', email = '$email', pnumber = '$pnumber' WHERE id = '$id'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Admin details have been updated Successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'That Admin Record does not exist';
        }
    }
    else{
        $_SESSION['error'] = 'Input Admin credentials first';
    }
    header('location: home.php');

?>