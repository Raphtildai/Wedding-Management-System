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
                Pending Booked Service
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Description</th>
                            <th>Capacity</th>
                            <th>Cost (KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Description</th>
                            <th>Capacity</th>
                            <th>Cost (KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                    // session_start();
                        $c_id = $_SESSION['user'];
                        $sql = 'SELECT * FROM `bookings` INNER join events 
                        ON bookings.event_id = events.event_id INNER JOIN users 
                        ON users.customer_id = bookings.customer_id JOIN event_categories
                        ON event_categories.event_id = events.event_id
                        WHERE (bookings.customer_id = '."$c_id".' AND status = 0 AND event_categories.category_id = bookings.category_id)';
                        if (mysqli_query($conn, $sql)) {
                        echo "";
                        } else {
                        echo "Error: .'$c_id'. " . $sql . "<br>" . mysqli_error($conn);
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
                                <?php echo $count; ?>
                            </th>
                            <td>
                                <?php echo $row['event_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_name']; ?>
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
                                <form action="booking_cancel.php" method = "POST">
                                    <input type="hidden" name = "cancel_id" value = "<?php echo $row['booking_id'] ?>">
                                    <input type="submit" name = "cancel" class="btn btn-danger" value = "Cancel">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                            $count++;
                            }
                        } else {
                        echo 'No Pending approvals found';
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