<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Event Category</h3></div>
                    <div class="card-body">
                        <?php 
                            // include 'includes/session.php';
                            $eid = $_POST['edit_id'];
                            $sql = "SELECT * FROM events INNER JOIN event_categories
                            ON event_categories.event_id = events.event_id
                            WHERE event_categories.category_id = '$eid'";
                            if (mysqli_query($conn, $sql)) {
                                echo "";
                                } else {
                                echo "Error: .'$eid'. " . $sql . "<br>" . mysqli_error($conn);
                                }
                                $count=1;
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) { 
                        ?>
                        <form method = 'POST' action = "events_update.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="name" type="text" value = "<?php echo $row['event_name'] ?>" required/>
                                        <label for="inputFirstName">Name of Service</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="service_category" type="service_category" value = "<?php echo $row['category_name'] ?>" required/>
                                        <label for="service_category">Category of the Service</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="measure" type="measure"value = "<?php echo $row['max_number_of_people'] ?>" required/>
                                        <label for="measure">Quality/Size/No</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="cost" type="number" value = "<?php echo $row['category_cost'] ?>" required/>
                                        <label for="cost">Cost of service in this category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="serviceCategory">Service Description</label>
                                <textarea class="form-control" rows = "3" name="event_description" type="text" placeholder = "<?php echo $row['event_description'] ?>" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="CategoryDesscription">Category Description</label>
                                <textarea class="form-control" rows = "3" name="cat_description" type="text" placeholder = "<?php echo $row['category_description'] ?>" required></textarea>
                            </div>
                            <?php
                                if(isset($_SESSION['error'])){
                                    echo "
                                        <div class='alert alert-danger alert-dismissible fade show'>
                                            <p>".$_SESSION['error']."</p> 
                                        </div>
                                    ";
                                    unset($_SESSION['error']);
                                }
                            ?>
                            <div class="mt-4 mb-0">
                                <div class="d-grname">
                                    <input type="hidden" name = "cid" value = "<?php echo $row['category_id'] ?>">
                                    <input type="hidden" name = "eid" value = "<?php echo $row['event_id'] ?>">
                                  <input class="btn btn-primary btn-block" name = "update_event" type="submit" value = "Update Category">
                                </div>
                                  <!-- <a class="btn btn-primary btn-block" id = "submit">Create Account</a></div> -->
                            </div>
                        </form>
                        <?php $count ++;
                                }
                            }else{
                                echo 'No Record can be found';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>
