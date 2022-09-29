<?php
	session_start();
	include 'includes/conn.php';

    // Parameters to be checked
    $eid = $_POST['eid'];
    $cid = $_POST['cid'];
    $event = $_POST['name'];
    $cost = $_POST['cost'];
    $category = $_POST['service_category'];
    $metric = $_POST['measure'];
    $event_description = $_POST['event_description'];
    $category_description = $_POST['cat_description'];

    // updating validation
    if(isset($_POST['update_event'])){
        // Select the records from the database
        $sql = "SELECT * FROM events INNER JOIN event_categories
        ON event_categories.event_id = events.event_id WHERE category_id = '$eid'";
        $query = $conn->query($sql);
        if($query->num_rows > 0){  
            // This updates the events table  
            $sql = "UPDATE events SET event_description = '$event_description' WHERE event_name = '$event'";
            if($conn->query($sql)){
                // This updates the event categories table after updating the events table
                $sql1 = "UPDATE event_categories SET category_name = '$category', 
                category_cost = '$cost', max_number_of_people = '$metric', category_description = '$category_description'
                WHERE category_id = '$cid'";
                if($conn->query($sql1)){
                    $_SESSION['success'] = 'Service and Event Category Details have been updated Successfully';
                }
                else{
                    $_SESSION['error'] = $conn->error;
                }
                // $_SESSION['success'] = 'Event Category Details have been updated Successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else if($query->num_rows < 1){
            // $sql2 = "INSERT INTO events (event_name, event_description) VALUES ('$event', '$event_description')";
            // $row2 = $conn->query($sql2);
            // if($row2){
            //     $res2 = "SELECT * FROM events WHERE event_name = '$event'";
            //     if (mysqli_query($conn, $res2)) {
            //         echo "";
            //         } else {
            //         echo "Error: " . $res . "<br>" . mysqli_error($conn);
            //         }
            //         $count=1;
            //         $result3 = mysqli_query($conn, $res2);
            //         if (mysqli_num_rows($result) > 0) {
            //         while($row = mysqli_fetch_assoc($result3)) { 
            //             $id = $row2['event_id'];
            //             $sql3 = "INSERT INTO event_categories (event_id, category_name, category_description, 
            //             category_cost, max_number_of_people)
            //             VALUES ('$id', '$category', '$category_description', '$cost', '$metric')";
            //             if($conn->query($sql3)){
            //                 $_SESSION['success'] = 'Service and Event Category created Successfully';
            //             }else{
            //                 $_SESSION['error'] = $conn->error;
            //             }
            //             $count++;
            //         }
            //         } else {
            //             $_SESSION['error'] = $conn->error;
            //         }
            //     } else {
            //         $_SESSION['error'] = $conn->error;                // echo 'No entries found';
            //     }
            // // 

            $sql5 = "SELECT * FROM events WHERE event_name = '$event'";
            $query = $conn->query($sql5);
            if($query->num_rows < 1){
                $sql6 = "INSERT INTO events (event_name, event_description) 
                VALUES ('$event', '$event_description')";
                $row1 = $conn->query($sql6);
                if($row1){
                    $res6 = "SELECT * FROM events WHERE event_name = '$event'";
                    if (mysqli_query($conn, $res6)) {
                        echo "";
                        } else {
                        echo "Error: " . $res6 . "<br>" . mysqli_error($conn);
                        }
                        $count=1;
                        $result6 = mysqli_query($conn, $res6);
                        if (mysqli_num_rows($result6) > 0) {
                        while($row7 = mysqli_fetch_assoc($result6)) { 
                            $id = $row7['event_id'];
                            $sql7 = "INSERT INTO event_categories (event_id, category_name, category_description, category_cost, max_number_of_people)
                            VALUES ('$id', '$category', '$category_description', '$cost', '$metric')";
                            if($conn->query($sql7)){
                                $_SESSION['success'] = 'Service and Event Category created and Added Successfully';
                            }else{
                                $_SESSION['error'] = $conn->error;
                            }
                            $count++;
                        }
                        } else {
                            $_SESSION['error'] = $conn->error;
                        }
                } else {
                    $_SESSION['error'] = $conn->error;                // echo 'No entries found';
                }
            }else if($query->num_rows > 0){ 
                // This updates the events table  
                $sql4 = "UPDATE events SET event_description = '$event_description' WHERE event_name = '$event'";
                if($conn->query($sql4)){
                    // This updates the event categories table
                    $sql8 = "UPDATE event_categories SET category_name = '$category', 
                    category_cost = '$cost', max_number_of_people = '$metric', category_description = '$category_description'
                    WHERE category_id = '$cid'";
                    if($conn->query($sql8)){
                        $_SESSION['success'] = 'Service and Event Category Details have been updated Successfully';
                    }
                    else{
                        $_SESSION['error'] = $conn->error;
                    }
                    // $_SESSION['success'] = 'Event Category Details have been updated Successfully';
                }
                else{
                    $_SESSION['error'] = $conn->error;
                }
            }else{
                $_SESSION['error'] = $conn->error;
            }
            // // $_SESSION['error'] = 'That Admin Record does not exist';
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
    else{
        $_SESSION['error'] = 'Input the category details to update first';
    }
    header('location: home.php');

?>