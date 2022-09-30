<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    
    $service = $_POST['sname'];
    $category = $_POST['cname'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $budget = $_POST['budget'];
    $description = $_POST['description'];
    $customer_id = $_SESSION['user'];

    // Register validation
    if(isset($_POST['book_event'])){
        if($date == date('m-d-y')){
            $_SESSION['error'] = 'You cannot book event scheduled for today';

        }else if($date < date('m-d-y')){
            $_SESSION['error'] = 'You cannot book event on a past day';
        }else{
            $sql = "INSERT INTO bookings (category_id,budget, booking_description, date_booked, location_of_event, customer_id, event_id) 
            VALUES('$category','$budget', '$description', '$date', '$location', $customer_id, '$service')";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Booking done successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
    }
    else{
        $_SESSION['error'] = 'Input your user credentials first';
    }
    header('location: home.php');

?>