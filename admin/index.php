<?php
    session_start();

    if(isset($_SESSION['user'])){
    header('location: ../user/home.php');
    }
    if(isset($_SESSION['admin'])){
		header('location: home.php');
	}
  include '../includes/header.php';
?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Login</h3></div>
                            <div class="card-body">
                                <form action = "login.php" method = "POST">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="username" type="text" placeholder="Enter Your Username" required/>
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" type="password" placeholder="Password" required/>
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="forgot_password.php">Forgot Password?</a>
                                        <input class="btn btn-primary btn-block" name = "login" type="submit" value = "Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<div id="layoutAuthentication_footer">
<?php
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>