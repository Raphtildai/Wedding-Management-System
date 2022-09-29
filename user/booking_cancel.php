<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['cancel_id'];   

    // Register validation
    if(isset($_POST['cancel'])){
        $sql = "SELECT * FROM bookings WHERE booking_id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "UPDATE bookings SET status = 2 WHERE booking_id = '$id'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Event Booking Cancelled Successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'Your Service booking does not exist';
        }
    }
    else{
        $_SESSION['error'] = 'Select the Service to Cancel first';
    }
    header('location: home.php');

?>