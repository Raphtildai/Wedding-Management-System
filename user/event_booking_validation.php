<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    
    $category = $_POST['category'];
    $number = $_POST['npeople'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $budget = $_POST['budget'];
    $description = $_POST['description'];
    $customer_id = $_SESSION['user'];

    // Register validation
    if(isset($_POST['book_event'])){
        $sql = "INSERT INTO bookings (population, budget, booking_description, date_booked, location_of_event, customer_id, event_id) VALUES('$number', '$budget', '$description', '$date', '$location', $customer_id, '$category')";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Booking done successfully';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }
    }
    else{
        $_SESSION['error'] = 'Input your user credentials first';
    }
    header('location: home.php');

?>