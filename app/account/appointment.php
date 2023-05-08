<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }
    if(!isset($_GET['status'])){
        header('location: ../index.php');
        die();
    }else{
        $status = $_GET['status'];
        if($status == 'waiting'){
            $status = 0;
        }elseif($status == 'completed'){
            $status = 1;
        }elseif($status == 'canceled'){
            $status = 2;
        }
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
        <p class="text-dark ps-2">Manage your appointments. <?= $status ?></p>
        <div class="text-dark">
            <hr class="mx-2">
        </div>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <?php
                        if($url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php?status=waiting'){
                            echo '<li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="true" href="appointment.php?status=waiting">Waiting</a>
                                </li>';
                        }else{
                            echo '<li class="nav-item">
                                    <a class="nav-link active fw-bold" aria-current="true" href="appointment.php?status=waiting">Waiting</a>
                                </li>';
                        }
                        if($url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php?status=completed'){
                            echo '<li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="true" href="appointment.php?status=completed">Completed</a>
                                </li>';
                        }else{
                            echo '<li class="nav-item">
                                    <a class="nav-link active fw-bold" aria-current="true" href="appointment.php?status=completed">Completed</a>
                                </li>';
                        }
                        if($url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php?status=canceled'){
                            echo '<li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="true" href="appointment.php?status=canceled">Canceled</a>
                                </li>';
                        }else{
                            echo '<li class="nav-item">
                                    <a class="nav-link active fw-bold" aria-current="true" href="appointment.php?status=canceled">Canceled</a>
                                </li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                    <!-- start of first row -->
                    <div class="row fs-6">
                        <!-- start of second container -->
                        <div class="container">
                            <!-- start of second row -->
                            <div class="row">
                                <!-- start of div on center -->
                                <div class="col-md-12">
                                    <!-- start of table -->
                                    <table class="table table-bordered table-striped" id="datatable-appointment">
                                        <!-- start of table header -->
                                        <thead>
                                            <tr>
                                                <th class="table-light text-uppercase d-none">category id</th>
                                                <th class="table-light text-uppercase d-none">category</th>
                                                <th class="table-light text-uppercase d-none">pet_id</th>
                                                <th class="table-light text-uppercase d-none">pet_name</th>
                                                <th class="table-light text-uppercase d-none">birthdate</th>
                                                <th class="table-light text-uppercase d-none">gender</th>
                                                <th class="table-light text-uppercase d-none">service_id</th>
                                                <th class="table-light text-uppercase">appointment_id</th>
                                                <th class="table-light text-uppercase">service</th>
                                                <th class="table-light text-uppercase">date</th>
                                                <th class="table-light text-uppercase">timeslot</th>
                                                <th class="table-light text-uppercase">date added</th>
                                                <th class="table-light text-uppercase">last updated</th>
                                                <th class="table-light text-uppercase">action</th>

                                            </tr>
                                        </thead>
                                        <!-- end of table header -->
                                        <!-- start of table body -->
                                        <tbody>
                                        <?php
                                            $sql_select = "SELECT category.category_id, category.category, pet.pet_id, pet.category_id, pet.pet_name, pet.birthdate, pet.gender, service.service_id, service.service, appointment.* FROM appointment INNER JOIN pet USING (pet_id) INNER JOIN category USING (category_id) INNER JOIN service USING (service_id) WHERE  appointment.user_id = $user_id_session AND status = $status AND appointment.is_deleted != 1 ORDER BY appointment.appointment_id DESC;";
                                            $result_select = mysqli_query($conn, $sql_select);
                                            if(mysqli_num_rows($result_select) > 0){
                                                while($row_select = mysqli_fetch_assoc($result_select)){
                                                    $category_id = $row_select['category_id'];
                                                    $category = $row_select['category'];
                                                    $pet_id = $row_select['pet_id'];
                                                    $pet_name = $row_select['pet_name'];
                                                    $birthdate = $row_select['birthdate'];
                                                    $gender = $row_select['gender'];
                                                    $service_id = $row_select['service_id'];
                                                    $appointment_id = $row_select['appointment_id'];
                                                    $service = $row_select['service'];
                                                    $date = $row_select['date'];
                                                    $timeslot = $row_select['timeslot'];
                                                    $date_added = $row_select['date_added'];
                                                    $last_updated = $row_select['last_updated'];
                                        ?>
                                                    <tr>
                                                        <td class="text-center d-none"><?= $category_id ?></td>
                                                        <td class="text-center d-none"><?= $category ?></td>
                                                        <td class="text-center d-none"><?= $pet_id ?></td>
                                                        <td class="text-center d-none"><?= $pet_name ?></td>
                                                        <td class="text-center d-none"><?= $birthdate ?></td>
                                                        <td class="text-center d-none"><?= $gender ?></td>
                                                        <td class="text-center d-none"><?= $service_id ?></td>
                                                        <td class="text-center"><?= $appointment_id ?></td>
                                                        <td class="text-center"><?= $service ?></td>
                                                        <td class="text-center"><?= $date ?></td>
                                                        <td class="text-center"><?= $timeslot ?></td>
                                                        <td class="text-center"><?= $date_added ?></td>
                                                        <td class="text-center"><?= $last_updated ?></td>
                                                        <td class="text-center">
                                                            <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_uappointment_modal"><i class="fa-solid fa-eye"></i></a> 
                                                            
                                                            <?php
                                                                if($url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php?status=completed' && $url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php?status=canceled'){
                                                                    echo '<a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_uappointment_modal"><i class="fa-solid fa-ban"></i></a>';
                                                                }else{
                                                                    echo '';
                                                                }
                                                            ?>
                                                            <!-- <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_uappointment_modal"><i class="fa-solid fa-trash"></i></a> -->
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                            <tr>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="10" class="text-center">No records found.</td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                        <!-- end of table body -->
                                    </table>
                                    <!-- end of table -->
                                </div>
                                <!-- end of div on center -->
                            </div>
                            <!-- end of second row -->
                        </div>
                        <!-- end of second container -->
                    </div>
                    <!-- end of first row -->
                </div>
                <!-- end of main content -->
            </div>
            <!-- end of row -->
            </div>
        </div>

        <!-- start of view modal -->
        <div class="modal fade" id="view_uappointment_modal">
            <!-- start of view modal dialog -->
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <!-- start of view modal content -->
                <div class="modal-content">
                    <!-- start of modal header -->
                    <div class="modal-header bg-dark border-0">
                        <h4 class="modal-title text-white">Appointment Details</h4>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                    <!-- end of modal header -->
                    <!-- start of view modal form -->
                    <form action="" method="post">
                        <!-- start of view modal body -->                
                        <div class="modal-body">
                            <input type="hidden" name="ua_appointment_id" id="ua_appointment_id">
                            <!-- start of view modal row -->
                            <div class="row">
                                <!-- start of view modal col -->
                                <div class="col-md-12">
                                    <!-- start of view modal card -->
                                    <div class="card card-primary">
                                        <!-- start of view modal card body -->
                                        <div class="card-body">
                                            <!-- start of view modal row -->
                                            <div class="row">
                                                <div class="col-md-3 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="ua_category" class="ps-2 pb-2 fs-5">Category</label>
                                                        <input type="text" class="form-control" name="ua_category" id="ua_category" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="ua_pet_name" class="ps-2 pb-2 fs-5">Pet name</label>
                                                        <input type="text" class="form-control" name="ua_pet_name" id="ua_pet_name" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="ua_birthdate" class="ps-2 pb-2 fs-5">Birthdate</label>
                                                        <input type="text" class="form-control" name="ua_birthdate" id="ua_birthdate" value="" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="ua_gender" class="ps-2 pb-2 fs-5">Gender</label>
                                                        <input type="text" class="form-control" name="ua_gender" id="ua_gender" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="ua_service" class="ps-2 pb-2 fs-5">Service</label>
                                                        <input type="text" class="form-control" name="ua_service" id="ua_service" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-6 mt-3 mb-5">
                                                    <div class="form-group">
                                                        <label for="ua_date" class="ps-2 pb-2 fs-5">Date</label>
                                                        <input type="text" class="form-control" name="ua_date" id="ua_date" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-6 mt-3 mb-5">
                                                    <div class="form-group">
                                                        <label for="ua_timeslot" class="ps-2 pb-2 fs-5">Timeslot</label>
                                                        <input type="text" class="form-control" name="ua_timeslot" id="ua_timeslot" value="" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of view modal row -->
                                        </div>
                                        <!-- end of view modal card body -->
                                        <!-- start of view modal footer -->
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <!-- end of view modal footer -->
                                    </div>
                                    <!-- end of view modal card -->
                                </div>
                                <!-- end of view modal col -->
                            </div>
                            <!-- end of view modal row -->
                        </div>
                        <!-- end of view modal body -->                
                    </form>
                    <!-- end of view modal form -->
                </div>
                <!-- end of view modal content -->
            </div>
            <!-- end of view modal dialog -->
        </div>
        <!-- end of view modal -->

        <!-- start of delete appointment modal -->
        <div class="modal fade" id="cancel_uappointment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel appointment</h1>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                    </div>
                    <!-- start of delete modal form -->
                    <form action="includes/delete-appointment.inc.php" method="post">
                        <!-- start of delete modal body -->                
                        <div class="modal-body">
                            <!-- start of delete modal row -->
                            <div class="row">
                                <!-- start of delete modal col -->
                                <div class="col-md-12">
                                    <!-- start of delete modal card -->
                                    <div class="card card-primary">
                                        <!-- start of delete modal card body -->
                                        <div class="card-body">
                                            <!-- start of delete modal row -->
                                            <div class="row">
                                                <div class="col-md-12 col-12 mt-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="delete_ua_appointment_id" id="delete_ua_appointment_id" class="form-control mb-3">
                                                        <h3>Are you sure you cancel this appointment?</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of delete modal row -->
                                        </div>
                                        <!-- end of delete modal card body -->
                                        <!-- start of delete modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">No</button>
                                            <button type="submit" name="cancel" class="btn btn-danger btn-lg">Yes</button>
                                        </div>
                                        <!-- end of delete modal footer -->
                                    </div>
                                    <!-- end of delete modal card -->
                                </div>
                                <!-- end of delete modal col -->
                            </div>
                            <!-- end of delete modal row -->
                        </div>
                        <!-- end of delete modal body -->                
                    </form>
                    <!-- end of delete modal form -->
                </div>
            </div>
        </div>
        <!-- end of delete appointment modal -->
    </div>
    <!-- end of sidebar main container -->
    <br><br><br><br>
    <?php
        require_once '../footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>