<?php
    include 'includes/session.php';
    $id = $_POST['id'];
    $discount = $_POST['discount'];
    $comment = $_POST['comment'];

    if(isset($_POST['approve'])){
        if($discount == null || $discount == ""){
            $sql = "UPDATE bookings SET (discount = 0, approval_comment = '$comment', status = 1) WHERE booking_id = $id";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Event Approved successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }else{
            $sql = "UPDATE bookings SET discount = $discount, approval_comment = '$comment', status = 1 WHERE booking_id = $id";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Event Approved successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}
	else{
		$_SESSION['error'] = 'Please enter the discount and comment first';
	}

	header('location: home.php');
?>