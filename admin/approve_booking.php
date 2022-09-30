<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>
<main>
    <div class="container">
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
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-5"> 
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Event Particulars</h3></div>
                    <div class="card-body">
                        <?php
                            if(isset($_POST['approve'])){
                                $id = $_POST['id'];
                                $capacity = $_POST['capacity'];
                                $cost = $_POST['cost'];
                                $location = $_POST['location'];
                                $organizer = $_POST['organizer'];
                                $date = $_POST['date'];
                                echo '<h5 class="font-weight-light my-4">
                                    Event Organizer: '."$organizer".'<br> 
                                    Date Booked: '."$date".'<br>
                                    Capacity/Type: '."$capacity".'<br>
                                    Total cost: '."$cost".'</br>
                                    Venue of the Event: '."$location".'
                                </h5>';
                            }else{ $_SESSION['error'] = 'Select the Event to Approve first';}
                        ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Approve Event Booking</h3></div>
                    <div class="card-header">
                    <div class="card-body">
                        <form method = 'POST' action = "approve_validate.php">
                            <input type="hidden" class="id" name="id" value = "<?php echo $id; ?>">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="discount" name = "discount" type="number" placeholder="Discount Given" required/>
                                <label for="discount">Discount Given</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows = "5" name="comment" type="text" placeholder="Enter comment" required></textarea>
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
                                  <input class="btn btn-primary btn-block" name = "approve" type="submit" value = "Approve Event">
                                </div>
                            </div>
                        </form>
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