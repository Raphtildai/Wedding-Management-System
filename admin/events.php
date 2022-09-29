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
        <a href="events_add.php">
            <button type="button" class="btn btn-primary">Add New Event Category</button>
        </a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Event Categories
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Cost(KSH.)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Service Name</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Cost(KSH.)</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php 
                        $sql = 'SELECT * from events JOIN event_categories
                        ON event_categories.event_id = events.event_id ORDER BY events.event_id';
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
                            <th>
                                <?php echo $row['event_name']; ?>
                            </th>
                            <td>
                                <?php echo $row['category_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_description']; ?>
                            </td>
                            <td>
                                <?php echo $row['category_cost']; ?>
                            </td>
                            <td>
                                <!-- <tr> -->
                                    <td>
                                        <form action="events_edit.php" method = "POST">
                                            <input type="hidden" name = "edit_id" value = "<?php echo $row['category_id'] ?>">
                                            <input type="submit" name = "edit_cat" class="btn btn-primary" value = "Edit">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_category.php" method = "POST">
                                            <input type="hidden" name = "del_id" value = "<?php echo $row['category_id'] ?>">
                                            <input type="submit" name = "delete_cat" class="btn btn-danger" value = "Delete">
                                        </form>
                                    </td>

                                <!-- </tr> -->
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
    </div>
</main>

<?php
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>