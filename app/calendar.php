<?php
    require_once 'includes/session.inc.php';
    ob_start();
    function build_calendar($month, $year, $conn, $user_id_session) {
        // $stmt = $mysqli->prepare("select * from appointment where MONTH(date) = ? AND YEAR(date) = ?");
        // $stmt->bind_param('ss', $month, $year);
        // $bookings = array();
        // if($stmt->execute()){
        //     $result = $stmt->get_result();
        //     if($result->num_rows>0){
        //         while($row = $result->fetch_assoc()){
        //             $bookings[] = $row['date'];
        //         }
                
        //         $stmt->close();
        //     }
        // }
        // Create array containing abbreviations of days of week.
        $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        // How many days does this month contain?
        $numberDays = date('t',$firstDayOfMonth);

        // Retrieve some information about the first day of the
        // month in question.
        $dateComponents = getdate($firstDayOfMonth);

        // What is the name of the month in question?
        $monthName = $dateComponents['month'];

        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $dateComponents['wday'];

        // Create the table tag opener and day headers
        
        $datetoday = date('Y-m-d');
        
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year</h2>";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
        
        $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
        
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
        
        $calendar .= "<tr>";

        // Create the calendar headers
        foreach($daysOfWeek as $day) {
            $calendar .= "<th  class='header'>$day</th>";
        } 

        // Create the rest of the calendar

        // Initiate the day counter, starting with the 1st.

        $currentDay = 1;

        $calendar .= "</tr><tr>";

        // The variable $dayOfWeek is used to
        // ensure that the calendar
        // display consists of exactly 7 columns.
        if ($dayOfWeek > 0) { 
            for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 
            }
        }
        
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        while ($currentDay <= $numberDays) {
            // Seventh column (Saturday) reached. Start a new row.
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }
            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";

            list($year, $month, $day) = explode('-', $date);
            $timestamp = strtotime("$year-$month-$day");


            if($dayname == 'saturday' && $date < date('Y-m-d') || $dayname == 'sunday' && $date < date('Y-m-d')){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-secondary btn-xs'>Unavailable</button>";
            }elseif($dayname == 'saturday' && $timestamp > strtotime('+3 months') || $dayname == 'sunday' && $timestamp > strtotime('+3 months')){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-secondary btn-xs'>Unavailable</button>";
            }elseif($dayname == 'saturday' || $dayname == 'sunday'){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-secondary btn-xs'>Close</button>";
            }elseif($date < date('Y-m-d')){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-secondary btn-xs'>Unavailable</button>";
            }elseif($timestamp > strtotime('+3 months')){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-secondary btn-xs'>Unavailable</button>";
            }else{
                // $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'>Book</a>";

                // Button trigger modal
                $calendar.="<td class='$today'><h4>$currentDay</h4> <button type='button' class='btn btn-success btn-xs' data-bs-toggle='modal' data-bs-target='#date-".$date."'>Book</button>";
            ?>
                <!-- start of booking modal -->
                <div class="modal fade" id="date-<?= $date; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <!-- start of booking modal dialog -->
                    <div class="modal-dialog modal-lg">
                        <!-- start of booking modal content -->
                        <div class="modal-content">
                            <!-- start of booking modal header -->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Book an appointment. <?= $date; ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- end of booking modal header -->
                            <!-- start of booking modal form -->
                            <form action="" method="post">
                                <!-- start of booking modal body -->
                                <div class="modal-body">
                                        <?php
                                            $sql_session = "SELECT * FROM user_info WHERE user_id = $user_id_session;";
                                            $result_session = mysqli_query($conn, $sql_session);
                                            if(mysqli_num_rows($result_session) > 0){
                                                while($row_session = mysqli_fetch_assoc($result_session)){
                                                    $email = $row_session['email'];
                                                    $phone_number = $row_session['phone_number'];
                                                    $first_name = $row_session['first_name'];
                                                    $last_name = $row_session['last_name'];
                                                }
                                            }
                                        ?>
                                        <!-- start of booking modal inner row -->
                                        <div class="row">
                                            <h4 class="ps-4">Customer details</h4>
                                            <hr class="ms-3" style="width: 96%;">
                                            
                                            <div class="col-md-6 col-6">
                                                <div class="form-group">
                                                    <label for="full_name-<?= $date; ?>" class="ps-2 pb-2">Owner's name</label>
                                                    <input type="text" class="form-control" name="full_name" id="full_name-<?= $date; ?>" value="<?= $first_name .' '. $last_name; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                            </div>
                                            
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="email-<?= $date; ?>" class="ps-2 pb-2">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email-<?= $date; ?>" value="<?= $email; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3 mb-5">
                                                <div class="form-group">
                                                    <label for="phone_number-<?= $date; ?>" class="ps-2 pb-2">Contact number</label>
                                                    <input type="text" class="form-control" name="phone_number" id="phone_number-<?= $date; ?>" value="<?= $phone_number; ?>" readonly>
                                                </div>
                                            </div>

                                            <h4 class="ps-4">Pet details</h4>
                                            <hr class="ms-3" style="width: 96%;">

                                            
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="pet_name-<?= $date; ?>" class="ps-2 pb-2">Name of pet</label>
                                                    <input type="text" class="form-control" name="pet_name" id="pet_name-<?= $date; ?>" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="category-<?= $date; ?>" class="ps-2 pb-2">Species</label>
                                                    <select class="form-select" aria-label="Default select example" name="category" id="category-<?= $date; ?>" required>
                                                        <option selected disabled>-- Select species --</option>
                                                        <?php
                                                            $sql_category = "SELECT * FROM category WHERE is_deleted != 1;";
                                                            $result_category = mysqli_query($conn, $sql_category);
                                                            if(mysqli_num_rows($result_category) > 0) {
                                                                while($row_category = mysqli_fetch_assoc($result_category)){
                                                                    $category_id = $row_category['category_id'];
                                                                    $category = $row_category['category'];
                                                                    echo '<option value="' .$category_id. '">' .$category. '</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="birthdate-<?= $date; ?>" class="ps-2 pb-2">Birthdate</label>
                                                    <input type="date" class="form-control" name="birthdate" id="birthdate-<?= $date; ?>" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3 mb-5">
                                                <div class="form-group">
                                                    <label for="gender-<?= $date; ?>" class="ps-2 pb-2">Gender</label>
                                                    <select class="form-select" aria-label="Default select example" name="gender" id="gender-<?= $date; ?>" required>
                                                        <option selected disabled>-- Select gender --</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <h4 class="ps-4">Appointment details</h4>
                                            <hr class="ms-3" style="width: 96%;">

                                            <div class="col-md-12 col-6">
                                                <div class="form-group">
                                                    <label for="service-<?= $date; ?>" class="ps-2 pb-2">Services</label>
                                                    <select class="form-select" aria-label="Default select example" name="service" id="service-<?= $date; ?>" required>
                                                        <option value="default_service" selected disabled>-- Select service --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="date-<?= $date; ?>" class="ps-2 pb-2">Appointment date</label>
                                                    <input type="date" class="form-control" name="date" id="date-<?= $date; ?>" value="<?= $date; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="timeslot-<?= $date; ?>" class="ps-2 pb-2">Timeslot</label>
                                                    <select class="form-select" aria-label="Default select example" name="timeslot" id="timeslot-<?= $date; ?>" required>
                                                        <option value="default_time" selected disabled>-- Select timeslot --</option>
                                                        


                                                            <!-- <option value="8:00AM - 9:00AM">8:00AM - 9:00AM</option>
                                                            <option value="9:00AM - 10:00AM">9:00AM - 10:00AM</option>
                                                            <option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                                                            <option value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>
                                                            <option value="1:00PM - 2:00PM">1:00PM - 2:00PM</option>
                                                            <option value="2:00PM - 3:00PM">2:00PM - 3:00PM</option>
                                                            <option value="3:00PM - 4:00PM">3:00PM - 4:00PM</option>
                                                            <option value="4:00PM - 5:00PM">4:00PM - 5:00PM</option> -->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of booking modal inner row -->
                                </div>
                                <!-- end of booking modal body -->
                                
                                
                                <!-- start of booking modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="book" class="btn btn-primary">Book</button>
                                </div>
                                <!-- end of booking modal footer -->
                            </form>
                            <!-- end of booking modal form -->
                        </div>
                        <!-- end of booking modal content -->
                    </div>
                    <!-- end of booking modal dialog -->
                </div>
                <!-- end of modal booking -->
                <script type="text/javascript">
                    $(document).ready(function(){

                        const categorySelection = document.querySelector(<?= json_encode("#category-$date") ?>);
                        const serviceSelection = document.querySelector(<?= json_encode("#service-$date") ?>);
                        const timeslotSelection = document.querySelector(<?= json_encode("#timeslot-$date") ?>);

                        serviceSelection.disabled = true; //remove all options bar first
                        timeslotSelection.disabled = true; //remove all options bar first

                        //category
                        $(<?= json_encode("#category-$date") ?>).change(function(){
                            var category_id = $(this).val();
                            $.ajax({
                                url: "includes/load-service.inc.php",
                                method: "POST",
                                data: {
                                    categoryID: category_id
                                },
                                success:function(data){
                                    $(<?= json_encode("#service-$date") ?>).html(data);
                                    serviceSelection.disabled = false; //remove all options bar first
                                }
                            });
                        });

                        //category changed
                        categorySelection.onchange = (e) => {
                            serviceSelection.disabled = false;
                            timeslotSelection.disabled = true;
                            
                            //clear all options for service and timeslot
                            $(<?= json_encode("#service-$date") ?>);
                            $(<?= json_encode("#timeslot-$date") ?>).val('default_time');
                            timeslotSelection.disabled = true; //remove all options bar first
                        };

                        //service
                        $(<?= json_encode("#service-$date") ?>).change(function(){
                            var service_id = $(this).val();
                            $.ajax({
                                url: "includes/load-time.inc.php?date=<?= $date; ?>",
                                method: "POST",
                                data: {
                                    serviceID: service_id
                                },
                                success:function(data){
                                    $(<?= json_encode("#timeslot-$date") ?>).html(data);
                                    timeslotSelection.disabled = false;
                                }
                            });
                        });

                        //service changed
                        serviceSelection.onchange = (e) => {
                            timeslotSelection.disabled = false;

                            //clear all options for timeslot
                            $(<?= json_encode("#timeslot-$date") ?>).val('default_time');
                        };
                    });
                </script>
            <?php  
            }
            $calendar .="</td>";
            // Increment counters

            $currentDay++;
            $dayOfWeek++;
        }
        if(isset($_POST['book'])){
            // $user_id_session
            $pet_name = mysqli_real_escape_string($conn, $_POST['pet_name']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $service = mysqli_real_escape_string($conn, $_POST['service']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            $timeslot = mysqli_real_escape_string($conn, $_POST['timeslot']);
            
            
            if(empty($pet_name) || empty($category) || empty($birthdate) || empty($gender) || empty($service) || empty($date) || empty($timeslot)){
                $error_message = "All fields are required!";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }else{
                $sql = "INSERT INTO appointment (user_id, pet_name, category_id, birthdate, gender, service_id, date, timeslot) VALUES ($user_id_session, '$pet_name', '$category', '$birthdate', '$gender', '$service', '$date', '$timeslot');";

                if(mysqli_query($conn, $sql)){
                    header('location: calendar.php?bookingsuccess');
                }
            }
        }

        // Complete the row of the last week in month, if necessary
        if ($dayOfWeek != 7) { 
        
            $remainingDays = 7 - $dayOfWeek;
                for($l=0;$l<$remainingDays;$l++){
                    $calendar .= "<td class='empty'></td>"; 
            }
        }
        $calendar .= "</tr>";
        $calendar .= "</table>";

        echo $calendar;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <?php
        require_once 'header.php';
    ?>
    
    <style>
        @media only screen and (max-width: 760px),
            (min-device-width: 802px) and (max-device-width: 1020px) {
                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                
                .empty {
                    display: none;
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                th {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr {
                    border: 1px solid #ccc;
                }

                td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }

                /* Label the data */
                td:nth-of-type(1):before {
                    content: "Sunday";
                }
                td:nth-of-type(2):before {
                    content: "Monday";
                }
                td:nth-of-type(3):before {
                    content: "Tuesday";
                }
                td:nth-of-type(4):before {
                    content: "Wednesday";
                }
                td:nth-of-type(5):before {
                    content: "Thursday";
                }
                td:nth-of-type(6):before {
                    content: "Friday";
                }
                td:nth-of-type(7):before {
                    content: "Saturday";
                }
            }
            /* Smartphones (portrait and landscape) ----------- */
            @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
                body {
                    padding: 0;
                    margin: 0;
                }
            }
            /* iPads (portrait and landscape) ----------- */
            @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
                body {
                    width: 495px;
                }
            }
            @media (min-width:641px) {
                table {
                    table-layout: fixed;
                }
                td {
                    width: 33%;
                }
            }
            .row{
                margin-top: 20px;
            }
            .today{
                background:yellow;
            }
    </style>

    <?php
        if(isset($_SESSION['user_id'])){
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $dateComponents = getdate();
                    if(isset($_GET['month']) && isset($_GET['year'])){
                        $month = $_GET['month']; 			     
                        $year = $_GET['year'];
                    }else{
                        $month = $dateComponents['mon']; 			     
                        $year = $dateComponents['year'];
                    }
                    echo build_calendar($month, $year, $conn, $user_id_session);
                ?>
            </div>
        </div>
    </div>
    <?php
        }else{
            header('location: index.php');
            die();
        }
        require_once 'footer.php';
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>
