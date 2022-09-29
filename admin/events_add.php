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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add New Event Category</h3></div>
                    <div class="card-body">
                        <form method = 'POST' action = "events_validate.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="name" type="text" placeholder="Category name"  required/>
                                        <label for="inputFirstName">Name of Service</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="service_category" type="service_category" placeholder="Enter Category of the service" required/>
                                        <label for="service_category">Category of the Service</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="measure" type="measure" placeholder="measure" required/>
                                        <label for="measure">Quality/Size/No</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="cost" type="number" placeholder="cost" required/>
                                        <label for="inputLastName">Cost of service in this category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="serviceCategory">Service Description</label>
                                <textarea class="form-control" rows = "3" name="event_description" type="text" placeholder = "Enter Service description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="CategoryDesscription">Category Description</label>
                                <textarea class="form-control" rows = "3" name="cat_description" type="text" placeholder = "Enter category description" required></textarea>
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
                                  <input class="btn btn-primary btn-block" name = "add_event" type="submit" value = "Add Category">
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
