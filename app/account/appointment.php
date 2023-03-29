<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <?php
        require_once '../header.php';
        require_once 'sidebar.php';
    ?>
            <!-- start of main content -->
            <div class="col-md-9 bg-white">
                <h5 class="text-dark pt-3 ps-2">My Appointments</h5>
                <p class="text-dark ps-2">Manage your appointments.</p>
                <div class="text-dark">
                    <hr class="mx-2">
                </div>
                <!-- start of div for appointment -->
                <h6 class="ms-3">Appointment details</h6>
                <hr class="mx-2">
                <div class="row ms-5 me-5">
                    <!-- start of inner div for appointment -->
                    <div class="col-md-9">

                        <?php
                            $sql = "SELECT category.category_id, category.category, appointment.appointment_id, appointment.pet_name, appointment.category_id, appointment.birthdate, appointment.gender, appointment.service_id, appointment.date, appointment.timeslot, appointment.status, appointment.date_added, appointment.last_updated, service.service_id, service.service FROM category INNER JOIN appointment USING (category_id) INNER JOIN service USING (service_id) WHERE appointment.is_deleted != 1 AND appointment.user_id = $user_id_session ORDER BY appointment.status ASC";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $appointment_id = $row['appointment_id'];
                                    $category = $row['category'];
                                    $pet_name = $row['pet_name'];
                                    $birthdate = $row['birthdate'];
                                    $gender = $row['gender'];
                                    $service = $row['service'];
                                    $date = $row['date'];
                                    $timeslot = $row['timeslot'];
                                    $status = $row['status'];
                                    $date_added = $row['date_added'];
                                    $last_updated = $row['last_updated'];

                                    if($status == 0){
                                        $status = 'Waiting';
                                    }elseif($status == 1){
                                        $status = 'Completed';
                                    }elseif($status == 2){
                                        $status = 'Canceled';
                                    }
                            ?>
                                    <div class="row">
                                        <h6 class="ms-1">Pet details</h6>
                                        <hr class="mx-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Category</label>
                                                <input type="text" name="category" class="form-control" id="category<?= $appointment_id; ?>" placeholder="" value="<?= $category; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pet_name<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Pet name</label>
                                                <input type="text" name="pet_name" class="form-control" id="pet_name<?= $appointment_id; ?>" placeholder="" value="<?= $pet_name; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="birthdate<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Birthdate</label>
                                                <input type="text" name="birthdate" class="form-control" id="birthdate<?= $appointment_id; ?>" placeholder="" value="<?= $birthdate; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="gender<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Gender</label>
                                                <input type="text" name="gender" class="form-control" id="gender<?= $appointment_id; ?>" placeholder="" value="<?= $gender; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <h6 class="ms-1">Service details</h6>
                                        <hr class="mx-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="service<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Service</label>
                                                <input type="text" name="service" class="form-control" id="service<?= $appointment_id; ?>" placeholder="" value="<?= $service; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="date<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Date</label>
                                                <input type="text" name="date" class="form-control" id="date<?= $appointment_id; ?>" placeholder="" value="<?= $date; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="timeslot<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Timeslot</label>
                                                <input type="text" name="timeslot" class="form-control" id="timeslot<?= $appointment_id; ?>" placeholder="" value="<?= $timeslot; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status<?= $appointment_id; ?>" class="form-label fs-6 ps-2">Status</label>
                                                <input type="text" name="status" class="form-control" id="status<?= $appointment_id; ?>" placeholder="" value="<?= $status; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-md btn-danger float-end" data-bs-toggle="modal" data-bs-target="#cancel_appointment_modal<?= $appointment_id; ?>">Cancel appointment</button>
                                    <br><br>
                                    <hr class="mx-2">

                                    <!-- Cancel modal -->
                                    <div class="modal fade" id="cancel_appointment_modal<?= $appointment_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="../includes/cancel-appointment.inc.php" method="post">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $date; ?> - <?= $timeslot; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="cancel_appointment_id" id="cancel_appointment_id<?= $appointment_id; ?>" class="form-control mb-3" value="<?= $appointment_id; ?>">
                                                        Are you sure you want to cancel this appointment?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                        <button type="submit" name="cancel" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                    // echo '<p class="fs-4">' .$category. '</p>';
                                    // echo '<p class="fs-4">' .$pet_name. '</p>';
                                    // echo '<p class="fs-4">' .$birthdate. '</p>';
                                    // echo '<p class="fs-4">' .$service. '</p>';
                                    // echo '<p class="fs-4">' .$date. '</p>';
                                    // echo '<p class="fs-4">' .$timeslot. '</p>';
                                    // echo '<p class="fs-4">' .$status. '</p>';
                                    // echo '<hr class="mx-2">';

                                }
                            }
                        ?>
                    </div>
                    <!-- end of inner div for appointment -->
                </div>
                <!-- end of div for appointment -->
            </div>
            <!-- end of main content -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of sidebar main container -->
    <br><br><br><br>
    <?php
        require_once '../footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>