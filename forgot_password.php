<?php
    include 'includes/header.php';
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                    <div class="card-body">
                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                        <form>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                <label for="email">Email address</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="user/index.php">Return to login</a>
                                <a class="btn btn-primary" href="reset_password.php">Reset Password</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="user/register.php">Need an account? Sign up!</a></div>
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