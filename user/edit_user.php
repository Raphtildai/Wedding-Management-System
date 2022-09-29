<?php
    include '../includes/logged_in_header.php';
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    include 'includes/conn.php';
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
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
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update your Details</h3></div>
                    <div class="card-body">
                        <?php 
                            // include 'includes/session.php';
                            $uid = $_SESSION['user'];
                            $sql = "SELECT * FROM users WHERE customer_id = '$uid'";
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
                        <form method = 'POST' action = "update_user.php">
                            <input type="hidden" name = "id" value = "<?php echo $row['customer_id'] ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="fname" type="text" value="<?php echo $row['fname'] ?>"  required/>
                                        <label for="inputFirstName">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="lname" type="text" value="<?php echo $row['lname'] ?>" required/>
                                        <label for="inputLastName">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="username" type="text" value="<?php echo $row['username'] ?>" required/>
                                <label for="inputEmail">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" type="email" value="<?php echo $row['email'] ?>" required/>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="county" type="text" value="<?php echo $row['county'] ?>" required/>
                                        <label for="inputFirstName">County</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="residence" type="text" value="<?php echo $row['residence'] ?>" required/>
                                        <label for="inputLastName">Area of Residence</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="pnumber" type="number" value="<?php echo $row['pnumber'] ?>" required/>
                                <label for="inputEmail">Phone Number</label>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grname">
                                <input class="btn btn-primary btn-block" name = "edit" type="submit" value = "Update">
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


