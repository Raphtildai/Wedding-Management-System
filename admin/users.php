<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <?php
            if(isset($_SESSION['success'])){
                echo "
                    <div class='alert alert-success alert-dismissible fade show'>                                      
                        <p>".$_SESSION['success']."</p> 
                    </div>
                ";
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['error'])){
                echo "
                    <div class='alert alert-danger alert-dismissible fade show'>                                      
                        <p>".$_SESSION['error']."</p> 
                    </div>
                ";
                unset($_SESSION['error']);
            }
        ?>
        <a href="user_add.php">
            <button type="button" class="btn btn-primary">Add New User</button>
        </a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Registered Users
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                        $sql = 'SELECT * from users';
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
                                <?php echo $row['customer_id']; ?>
                            </th>
                            <td>
                                <?php echo $row['username']; ?>
                            </td>
                            <td>
                                <?php echo $row['fname']. ' '.$row['lname'].''; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['date_registered']; ?>
                            </td>
                            <td>
                                <form action="delete_user.php" method = "POST">
                                    <input type="hidden" name = "delete_id" value = "<?php echo $row['customer_id'] ?>">
                                    <input type="submit" name = "delete" class="btn btn-danger" value = "Delete">
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