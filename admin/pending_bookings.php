<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pending Event Approval
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Category</th>
                            <th>Customer Name</th>
                            <th>Description</th>
                            <th>Population</th>
                            <th>Budget(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Event Category</th>
                            <th>Customer Name</th>
                            <th>Description</th>
                            <th>Population</th>
                            <th>Budget(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                        $sql = 'SELECT * FROM `bookings` INNER join events ON bookings.event_id = events.event_id INNER JOIN users ON users.customer_id = bookings.customer_id WHERE status = 0';
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
                                <?php echo $row['event_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['fname']; ?>
                            </td>
                            <td>
                                <?php echo $row['booking_description']; ?>
                            </td>
                            <td>
                                <?php echo $row['population']; ?>
                            </td>
                            <td>
                                <?php echo $row['budget']; ?>
                            </td>
                            <td>
                                <?php echo $row['date_booked']; ?>
                            </td>
                            <td>
                                <form action="approve_booking.php" method = "POST">
                                    <input type="hidden" class="id" name="id" value = "<?php echo $row['booking_id']; ?>">
                                    <input type="hidden" class="id" name="date" value = "<?php echo $row['date_booked']; ?>">
                                    <input type="hidden" class="organizer" name="organizer" value = "<?php echo $row['fname'] .' '. $row['lname']; ?>">
                                    <input type="hidden" class="location" name="location" value = "<?php echo $row['location_of_event']; ?>">
                                    <input type="hidden" class="population" name="population" value = "<?php echo $row['population']; ?>">
                                    <input type="hidden" class="budget" name="budget" value = "<?php echo $row['budget']; ?>">
                                    <input type="hidden" class="cost" name="cost" value = "<?php $cost = $row['cost'] * $row['population']; echo $cost; ?>">
                                    <input type="submit" name = "approve" value = "Approve" class="btn btn-success">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                            $count++;
                            }
                        } else {
                        echo 'No more pending event approvals at this time';
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