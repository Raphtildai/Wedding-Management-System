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
                My Approved Event Service
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Comments</th>
                            <th>Capacity</th>
                            <th>Total Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Comments</th>
                            <th>Capacity</th>
                            <th>Total Cost(KSH.)</th>
                            <th>Date Booked</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                    // session_start();
                        $c_id = $_SESSION['user'];
                        $sql = 'SELECT * FROM `bookings` INNER join events
                         ON bookings.event_id = events.event_id INNER JOIN users
                         ON users.customer_id = bookings.customer_id INNER JOIN event_categories
                         ON event_categories.event_id = events.event_id
                         WHERE (bookings.customer_id = '."$c_id".' AND status = 1 )';
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
                                <?php echo 'You were given a discount of KSH '.$row['discount'].' <br>'.$row['approval_comment'].''; ?>
                            </td>
                            <td>
                                <?php echo $row['max_number_of_people']; ?>
                            </td>
                            <td>
                                <?php 
                                    $cost = $row['category_cost'] - $row['discount'];
                                    echo $cost; 
                                 ?>
                            </td>
                            <td>
                                <?php echo $row['date_booked']; ?>
                            </td>
                            <td>
                                <form action="payment.php" method = "POST">
                                    <input type="hidden" name = "id" value = "<?php echo $row['booking_id']?>">
                                    <input type="hidden" name = "amount" value = "<?php $cost = $row['category_cost'] - $row['discount']; echo $cost; ?>">
                                    <input type = "submit" name = "payment" class="btn btn-success" value = "Proceed to PAY">
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