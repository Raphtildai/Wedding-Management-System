<?php
    include 'includes/session.php';
    // Adding New event Category
    if(isset($_POST['add_event'])){
        $event = $_POST['name'];
        $cost = $_POST['cost'];
        $category = $_POST['service_category'];
        $metric = $_POST['measure'];
        $event_description =$_POST['event_description'];
        $category_description = $_POST['cat_description'];

        $sql = "SELECT * FROM events WHERE event_name = '$event'";
        $query = $conn->query($sql);
        if($query->num_rows < 1){
            $sql1 = "INSERT INTO events (event_name, event_description) VALUES ('$event', '$event_description')";
            $row = $conn->query($sql1);
            if($row){
                $res = "SELECT * FROM events WHERE event_name = '$event'";
                if (mysqli_query($conn, $res)) {
                    echo "";
                    } else {
                    echo "Error: " . $res . "<br>" . mysqli_error($conn);
                    }
                    $count=1;
                    $result = mysqli_query($conn, $res);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) { 
                        $id = $row['event_id'];
                        $sql2 = "INSERT INTO event_categories (event_id, category_name, category_description, category_cost, max_number_of_people)
                        VALUES ('$id', '$category', '$category_description', '$cost', '$metric')";
                        if($conn->query($sql2)){
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
            $res = "SELECT * FROM events WHERE event_name = '$event'";
            if (mysqli_query($conn, $res)) {
                echo "";
                } else {
                echo "Error: " . $res . "<br>" . mysqli_error($conn);
                }
                $count=1;
                $result = mysqli_query($conn, $res);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
                    $id = $row['event_id'];
                    $sql2 = "INSERT INTO event_categories (event_id, category_name, category_description, category_cost, max_number_of_people)
                    VALUES ('$id', '$category', '$category_description', '$cost', '$metric')";
                    if($conn->query($sql2)){
                        $_SESSION['success'] = 'Event Category created and Added Successfully';
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
    }else{
        $_SESSION['error'] = 'Fill up the form first';
    }
    header('location: home.php')
?>