<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $id = $_POST['del_id'];   

    // Register validation
    if(isset($_POST['delete_cat'])){
        $sql = "SELECT * FROM event_categories WHERE category_id = '$id'";
        $query = $conn->query($sql);
        if($query->num_rows){
            $sql = "DELETE FROM event_categories WHERE category_id = '$id'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Category Deleted Successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'This category Does not exist';
        }
    }
    else{
        $_SESSION['error'] = 'Select the Category to Delete first';
    }
    header('location: home.php');

?>