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
                                        <select name="sname" id="services" class = "form-control" onchange="displayCategories(this)">
                                            <option value="">Please Select</option>
                                            <?php 
                                                $conn = new mysqli('localhost', 'root', '', 'wedding');
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = 'SELECT event_name, event_id from events';
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
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <!-- This outputs the categories of the selected event -->
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="Service categories" id = "catlabel" class = "d-none">Select Category</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select name="cname" id="cname" class = "form-control d-none">
                                                <option value="">Please Select</option>
                                            <?php 
                                                $conn = new mysqli('localhost', 'root', '', 'wedding');
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql1 = 'SELECT category_id, category_cost, category_id, category_name, max_number_of_people FROM event_categories';
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
                                                    <option id = "cid" value="<?php echo $row1['category_id'] ?>"><?php echo $row1['category_name']. ' '. $row1['max_number_of_people'] ?></option>
                                                <?php
                                                    $count++;}
                                                } else {
                                                    echo 'No Service Categories found';
                                                }
                                            } else {
                                                echo 'No Services found';
                                            }
                                            ?>
                                        </select>
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
                                    <label for="budget">Total Cost</label>
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
<script>
    function displayCategories(answer){
        console.log(answer.value);
        if(answer.value != ""){
            document.getElementById('catlabel').classList.remove('d-none');
            document.getElementById('cname').classList.remove('d-none');
            return answer,value;
        }else{
            document.getElementById('catlabel').classList.add('d-none');
            document.getElementById('cname').classList.add('d-none');
        }

    }
</script>

<!-- <script>
    function valid(){
        var date = document.forms[0][3].value;
        if(date == ""){
            alert('Date cannot be empty');
            return false;
        }else if(date < Date().getTime()){
            alert('DAte cannot be past date');
        }else if(date == Date().getTime()){
            alert('You cannot book event on today\'s date');
        }else {
            return true;
        }
        
    }
</script> -->

<?php
    include 'includes/scripts.php';
    include 'includes/footer.php';
?>