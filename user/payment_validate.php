<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['id'];    
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];
    $amount_already_paid = $_POST['amount_already_paid'];
    $total = $amount + $amount_already_paid;

    // Register validation
    if(isset($_POST['paid'])){
        $sql = "SELECT * FROM bookings WHERE booking_id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "INSERT INTO payment (booking_id, amount, payment_comment) VALUES('$id', '$total', '$comment')";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Done Successfully.';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'That booking does not exist';
        }
    }
    else{
        $_SESSION['error'] = 'Input amount paid and comment first';
    }
    header('location: home.php');

?>