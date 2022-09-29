<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Approved Event Bookings
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th>Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th>Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                        $sql = 'SELECT * FROM `bookings` INNER join events 
                        ON bookings.event_id = events.event_id INNER JOIN users 
                        ON users.customer_id = bookings.customer_id INNER JOIN event_categories
                        ON event_categories.event_id = events.event_id WHERE status = 1';
                        if (mysqli_query($conn, $sql)) {
                        echo "";
                        } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        $count=1;
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tbody>
                        <tr>
                            <th>
                                <?php echo $row['booking_id']; ?>
                            </th>
                            <td>
                                <?php echo $row['fname']. ' '. $row['lname']; ?>
                            </td>
                            <td>
                                <?php echo $row['event_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_name']; ?>
                            </td>
                            <td>
                                <?php
                                    $cost = $row['category_cost'] - $row['discount']; 
                                    echo $cost;
                                    // if($row['event_name'] == 'Photography'){
                                    //     $cost = $row['cost'] - $row['discount'];
                                    //     echo $cost;
                                    // }else{  
                                    //     $cost = ($row['population'] * $row['cost']) - $row['discount'];
                                    //     echo $cost;
                                    // } 
                                ?>
                            </td>
                            <td>
                                <?php echo $row['date_booked']; ?>
                            </td>
                            <td>
                                <?php echo 'Paid Ksh. '.$row['payment_status'].''?>
                            </td>
                            <td>
                                <form action="#" method = "POST">
                                    <input type="hidden" name = "delete_id" value = "<?php echo $row['booking_id'] ?>">
                                    <input type="submit" name = "delete" class="btn btn-danger" value = "DELETE">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                            $count++;
                            }
                        } else {
                        // echo 'No entries found';
                        }
                    ?>
                </table>
            </div>
        </div>
</main>

<?php
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>