<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['delete_id'];   

    // Register validation
    if(isset($_POST['delete'])){
        $sql = "SELECT * FROM users WHERE customer_id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "DELETE FROM users WHERE customer_id = '$id'";
            if($conn->query($sql)){
                $sql1 = "DELETE FROM bookings WHERE customer_id = '$id'";
                if($conn->query($sql)){
                    // $_SESSION['success'] = 'User Deleted Successfully';
                }
                else{
                    $_SESSION['error'] = $conn->error;
                }

                $_SESSION['success'] = 'User Deleted Successfully';
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