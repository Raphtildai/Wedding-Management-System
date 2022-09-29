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
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">All Users</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white">
                        <?php
                            $sql = "SELECT * FROM users";
                            $query = $conn->query($sql);

                            echo "<h5>".$query->num_rows."</h5>";
                        ?>
                        </div>
                        <a class="small text-white stretched-link" href="users.php"></a>
                        <div class="small text-white">More Info <i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">All Services</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white">
                        <?php
                            $sql = "SELECT * FROM events";
                            $query = $conn->query($sql);

                            echo "<h5>".$query->num_rows."</h5>";
                        ?>
                        </div>
                        <a class="small text-white stretched-link" href="events.php"></a>
                        <div class="small text-white">More Info <i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Pending Approvals</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white">
                        <?php
                            $sql = "SELECT * FROM bookings WHERE status = 0";
                            $query = $conn->query($sql);

                            echo "<h5>".$query->num_rows."</h5>";
                        ?>
                        </div>
                        <a class="small text-white stretched-link" href="pending_bookings.php"></a>
                        <div class="small text-white">More Info <i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Approved Services</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white">
                        <?php
                            $sql = "SELECT * FROM bookings WHERE status = 1";
                            $query = $conn->query($sql);

                            echo "<h5>".$query->num_rows."</h5>";
                        ?>
                        </div>
                        <a class="small text-white stretched-link" href="approved_bookings.php"></a>
                        <div class="small text-white">More Info <i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div> -->
</main>

<?php
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>