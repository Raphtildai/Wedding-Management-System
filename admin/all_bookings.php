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
                All Event Bookings
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Category Name</th>
                            <th>Customer Name</th>
                            <th>Description</th>
                            <th>Capacity/Type</th>
                            <th>Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Category Name</th>
                            <th>Customer Name</th>
                            <th>Description</th>
                            <th>Capacity/Type</th>
                            <th>Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <?php 
                        $sql = 'SELECT * FROM `bookings` INNER join events 
                        ON bookings.event_id = events.event_id INNER JOIN users 
                        ON users.customer_id = bookings.customer_id INNER JOIN event_categories
                        ON event_categories.category_id = bookings.category_id
                        ORDER BY(status)';
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
                                <?php echo $count ?>
                            </th>
                            <td>
                                <?php echo $row['event_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['fname']. ' '. $row['lname']; ?>
                            </td>
                            <td>
                                <?php echo $row['booking_description']; ?>
                            </td>
                            <td>
                                <?php echo $row['max_number_of_people']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_cost']; ?>
                            </td>
                            <td>
                                <?php echo $row['date_booked']; ?>
                            </td>
                            <td>
                                <?php 
                                    if($row['status'] == 0){
                                        echo "<div class = "."btn-primary".">Pending</div>";
                                    }else if($row['status'] == 1){
                                        echo "<div class = "."btn-success".">Approved</div>";
                                    }else{
                                        echo "<div class = "."btn-danger".">Cancelled</div>";
                                    }
                                ?>
                                <!-- <button type="button" class="btn btn-success">Approve</button> -->
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