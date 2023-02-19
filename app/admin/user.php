<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_service = mysqli_real_escape_string($conn, $_POST['add_service']);
                $add_description = mysqli_real_escape_string($conn, $_POST['add_description']);
                
                
                if(empty($add_service) || empty($add_description)){
                    $error_message = "All fields are required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $sql = "INSERT INTO service (service, description) VALUES ('$add_service', '$add_description');";
    
                    if(mysqli_query($conn, $sql)){
                    }
                }
            }
        ?>
        <h3 class="text-dark mt-3 text-center">Users</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <!-- start of add user modal button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_user_modal">Add user</button>
            <!-- end of add user modal button -->

            <!-- start of add user modal -->
            <div class="modal fade" id="add_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add user</h1>
                            <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                        </div>
                        <!-- start of add modal form -->
                        <form action="" method="post">
                            <!-- start of add modal body -->                
                            <div class="modal-body">
                                <!-- start of add modal row -->
                                <div class="row">
                                    <!-- start of add modal col -->
                                    <div class="col-md-12">
                                        <!-- start of add modal card -->
                                        <div class="card card-primary">
                                            <!-- start of add modal card body -->
                                            <div class="card-body">
                                                <!-- start of add modal row -->
                                                <div class="row">
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_user_role" class="ps-2 pb-2">User role</label>
                                                            <select class="form-select" aria-label="Default select example" name="add_user_role" id="add_user_role" required>
                                                                <option selected value="2">Customer</option>
                                                                <option value="1">Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_username" class="ps-2 pb-2">Username</label>
                                                            <input type="text" class="form-control" name="add_username" id="add_username" value="" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_first_name" class="ps-2 pb-2">First name</label>
                                                            <input type="text" class="form-control" name="add_first_name" id="add_first_name" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_last_name" class="ps-2 pb-2">Last name</label>
                                                            <input type="text" class="form-control" name="add_last_name" id="add_last_name" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_email" class="ps-2 pb-2">Email</label>
                                                            <input type="text" class="form-control" name="add_email" id="add_email" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_phone_number" class="ps-2 pb-2">Phone numer</label>
                                                            <input type="text" class="form-control" name="add_phone_number" id="add_phone_number" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_password" class="ps-2 pb-2">Password</label>
                                                            <input type="password" class="form-control" name="add_password" id="add_password" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_repeat_password" class="ps-2 pb-2">Repeat password</label>
                                                            <input type="password" class="form-control" name="add_repeat_password" id="add_repeat_password" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end of add modal row -->
                                            </div>
                                            <!-- end of add modal card body -->
                                            <!-- start of add modal footer -->
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="add" class="btn btn-success">Save Changes</button>
                                            </div>
                                            <!-- end of add modal footer -->
                                        </div>
                                        <!-- end of add modal card -->
                                    </div>
                                    <!-- end of add modal col -->
                                </div>
                                <!-- end of add modal row -->
                            </div>
                            <!-- end of add modal body -->                
                        </form>
                        <!-- end of add modal form -->
                    </div>
                </div>
            </div>
            <!-- end of add service modal -->

            <!-- start of first row -->
            <div class="row">
                <!-- start of second container -->
                <div class="container">
                    <!-- start of second row -->
                    <div class="row">
                        <!-- start of div on center -->
                        <div class="col-md-12">
                            <!-- start of table -->
                            <table class="table table-bordered table-striped" id="datatable">
                                <!-- start of table header -->
                                <thead>
                                    <tr>
                                        <th class="table-light text-uppercase">user id</th>
                                        <th class="table-light text-uppercase">user role</th>
                                        <th class="table-light text-uppercase">username</th>
                                        <th class="table-light text-uppercase">status</th>
                                        <th class="table-light text-uppercase">last login</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT * FROM user WHERE is_deleted != 1 ORDER BY user_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $user_id = $row_select['user_id'];
                                            $user_role_id = $row_select['user_role_id'];
                                            $username = $row_select['username'];
                                            $is_verified = $row_select['is_verified'];
                                            $last_login = $row_select['last_login'];
                                            $date_added = $row_select['date_added'];
                                            $last_updated = $row_select['last_updated'];

                                            if($is_verified == 0){
                                                $is_verified = 'Not verified yet';
                                            }elseif($is_verified == 1){
                                                $is_verified = 'Verified';
                                            }
                                ?>
                                            <tr>
                                                <td class="text-center"><?= $user_id ?></td>
                                                <td class="text-center"><?= $user_role_id ?></td>
                                                <td class="text-center"><?= $username ?></td>
                                                <td class="text-center"><?= $is_verified ?></td>
                                                <td class="text-center"><?= $last_login ?></td>
                                                <td class="text-center"><?= $date_added ?></td>
                                                <td class="text-center"><?= $last_updated ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_user_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_user_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_user_modal"><i class="fa-solid fa-trash"></i></a>
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
        <!-- end of container fluid -->
    </div>
    <!-- end of first container -->
    

    <?php
        require_once 'footer.php';
    ?>