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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Payment Method</h3></div>
                    <div class="card-body">
                        <?php
                            if(isset($_POST['payment'])){
                                $id = $_POST['id'];
                                $cost = $_POST['amount'];
                                echo 
                                    '<h5 class="font-weight-light my-4">
                                    Total Amount to be Paid: '."$cost".'<br><hr><br>
                                    You can pay via MPESA Number:<br> +254 748 392 907 <br>
                                    MARY MUNG\'ALI.
                                </h5>';
                            }else{ $_SESSION['error'] = 'Select the Event You want to PAY first';}
                        ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Amount Paid</h3></div>
                    <div class="card-header"> <h3>After Paying kindly enter the amount paid</h3> </div>
                    <div class="card-body">
                        <form method = 'POST' action = "payment_validate.php">
                            <input type="hidden" class="id" name="id" value = "<?php echo $id; ?>">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="amount" name = "amount" type="number" placeholder="Enter Amount Paid" required/>
                                <label for="discount">Amount Paid</label>
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
                                  <input class="btn btn-primary btn-block" name = "paid" type="submit" value = "Submit">
                                </div>
                                  <!-- <a class="btn btn-primary btn-block" id = "submit">Create Account</a></div> -->
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