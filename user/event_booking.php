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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Book Service</h3></div>
                    <div class="card-body">
                        <form method = 'POST' action = "event_booking_validation.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="categories">Type of Service</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select name="category" id="categories" class = "form-control">
                                            <?php 
                                                $conn = new mysqli('localhost', 'root', '', 'wedding');
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = 'SELECT * from events';
                                                if (mysqli_query($conn, $sql)) {
                                                    echo "";
                                                } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                                }
                                                $count = 1;
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value="<?php 
                                                    echo $row['event_id'];
                                                    ?>">
                                                    <?php echo $row['event_name']. $row['event_id'] ?>
                                                </option>
                                                <?php
                                                    $_SESSION['eid'] = $row['event_id'];
                                                    $eid = $_SESSION['eid'];
                                                    echo $eid;
                                                    $count++;}
                                                } else {
                                                    echo 'No Services found';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <!-- This outputs the categories of the selected event -->
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="Service categories">Select Category<?php echo $eid ?></label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select name="cname" id="cname" class = "form-control">
                                            <?php 
                                                $conn = new mysqli('localhost', 'root', '', 'wedding');
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql1 = 'SELECT * from event_categories WHERE event_id = $eid';
                                                if (mysqli_query($conn, $sql1)) {
                                                    echo "";
                                                } else {
                                                echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                                                }
                                                $count = 1;
                                                $res = mysqli_query($conn, $sql1);
                                                if (mysqli_num_rows($res) > 0) {
                                                // output data of each row
                                                while($row1 = mysqli_fetch_assoc($res)) { ?>
                                                    <option value="<?php echo $row1['category_id'] ?>"><?php echo $row1['category_name'] ?></option>
                                                <?php
                                                    $count++;}
                                                } else {
                                                    echo 'No Service Categories found';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories">Enter number of people expected</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="npeople" type="number" placeholder="People expected" required/>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="location" type="text" placeholder="location" required/>
                                <label for="location">location of event</label>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="date" type="date" required/>
                                    <label for="date">Date of the wedding</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="budget" type="number" placeholder="Enter budget expected" required/>
                                    <label for="budget">Working Budget for the Wedding</label>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows = "5" name="description" type="text" placeholder="Enter Description" required></textarea>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grname">
                                <input class="btn btn-primary btn-block" name = "book_event" type="submit" value = "Book Service">
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