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
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Your payment Comments</th>
                            <th>Total Cost Payable (KSH.)</th>
                            <th>Amount Paid (KSH.)</th>
                            <th>Balance (KSH.)</th>
                            <th>Date Paid</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N</th>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Your payment Comments</th>
                            <th>Total Cost Payable (KSH.)</th>
                            <th>Amount Paid (KSH.)</th>
                            <th>Balance (KSH.)</th>
                            <th>Date Paid</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                    // session_start();
                        $c_id = $_SESSION['user'];
                        $sql = 'SELECT * FROM `bookings` INNER join events 
                        ON bookings.event_id = events.event_id INNER JOIN users 
                        ON users.customer_id = bookings.customer_id INNER JOIN payment 
                        ON bookings.booking_id = payment.booking_id INNER JOIN event_categories
                        ON event_categories.event_id = bookings.event_id
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
                                <?php echo $row['payment_comment']; ?>
                            </td>
                            <td>
                                <?php 
                                    $cost = $row['category_cost'] - $row['discount'];
                                    echo $cost;
                                ?>
                            </td>
                            <td>
                                <?php echo $row['amount']; ?>
                            </td>
                            <td>
                                <?php 
                                    $cost = $row['category_cost'] - $row['discount'];
                                    $bal = $cost - $row['amount'];
                                    echo $bal;
                                 ?>
                            </td>
                            <td>
                                <?php echo $row['date_paid']; ?>
                            </td>
                            <td>
                                <form action="payment.php" method = "POST">
                                    <input type="hidden" name = "id" value = "<?php echo $row['booking_id']?>">
                                    <input type="hidden" name = "amount_already_paid" value = "<?php echo $row['amount']?>">
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