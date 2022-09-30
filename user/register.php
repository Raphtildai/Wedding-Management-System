<?php
  include '../includes/header.php';
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <?php
                        session_start();
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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                    <div class="card-body">
                        <form method = 'POST' action = "../includes/validation.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="fname" type="text" placeholder="Enter your first name"  required/>
                                        <label for="inputFirstName">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="lname" type="text" placeholder="Enter your last name" required/>
                                        <label for="inputLastName">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="username" type="text" placeholder="username" required/>
                                <label for="inputEmail">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" type="email" placeholder="name@example.com" required/>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="county" type="text" placeholder="Enter your County" required/>
                                        <label for="inputFirstName">County</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="residence" type="text" placeholder="Enter area of residence" required/>
                                        <label for="inputLastName">Area of Residence</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="pnumber" type="number" placeholder="+254712345678" required/>
                                <label for="inputEmail">Phone Number</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="password" type="password" placeholder="Create a password" required/>
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="passwordConfirm" type="password" placeholder="Confirm password" required/>
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grname">
                                <input class="btn btn-primary btn-block" name = "register" type="submit" value = "Create Account">
                                </div>
                                <!-- <a class="btn btn-primary btn-block" id = "submit">Create Account</a></div> -->
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
  include '../includes/footer.php';
?>


