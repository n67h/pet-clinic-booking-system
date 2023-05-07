<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet</title>
    <?php
        require_once '../header.php';
        require_once 'sidebar.php';
        $file_destination = '';
        if(isset($_POST['add'])){
            $add_category = mysqli_real_escape_string($conn, $_POST['add_category']);
            $add_pet_name = mysqli_real_escape_string($conn, $_POST['add_pet_name']);
            $add_birthdate = mysqli_real_escape_string($conn, $_POST['add_birthdate']);
            $add_gender = mysqli_real_escape_string($conn, $_POST['add_gender']);


            //validate profile picture
            $file = $_FILES['pet_image'];
            $file_name = $_FILES['pet_image']['name'];
            $file_tmp_name = $_FILES['pet_image']['tmp_name'];
            $file_size = $_FILES['pet_image']['size'];
            $file_error = $_FILES['pet_image']['error'];
            $file_type = $_FILES['pet_image']['type'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png',);

            if(empty($add_category) || empty($add_pet_name) || empty($add_birthdate) || empty($add_gender)){
                $error_message = "All fields are required!";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }else{
                $sql = "INSERT INTO pet (user_id, category_id, pet_name, birthdate, gender) VALUES ($user_id_session, $add_category, '$add_pet_name', '$add_birthdate', '$add_gender');";
                if(mysqli_query($conn, $sql)){
                    $pet_id = mysqli_insert_id($conn);
                    if($_FILES["pet_image"]["error"] == 4) {
                        //means there is no file uploaded
                        $image_error = '';
                    }else{
                        if(in_array($file_actual_ext, $allowed)) {
                            if($file_error === 0) {
                                if($file_size < 5000000) {
                                    $file_name_new = $pet_id. "." .$file_actual_ext;
                                    $file_destination = '../pet-images/' .$file_name_new;
                                    move_uploaded_file($file_tmp_name, $file_destination);
                                    $sql = "UPDATE pet SET pet_image = '$file_name_new' WHERE pet_id = $pet_id;";
                                    if(mysqli_query($conn, $sql)){
                                        header('location: pet.php?addedsuccessfully');
                                        die();
                                    }
                                }else {
                                    $image_error = ' *Your file is too big.';
                                }
                            }else {
                                $image_error = ' *There was an error uploading your file.';
                            }
                        }else{
                            $image_error = ' *You cannot upload file of this type.';
                        }
                    }
                }
            }
        }
    ?>   
            <!-- start of main content -->
            <div class="col-md-9 bg-white">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h5 class="text-dark pt-3 ps-2">My Pets</h5>
                        <p class="text-dark ps-2">Manage the informations of your pets here.</p>
                    </div>

                    <!-- start of add pet modal button -->
                    <div class="mt-3 me-3">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#add_pet_modal">Add Pet <i class="fa-solid fa-paw"></i></button>
                    </div>
                    <!-- end of add pet modal button -->
                                
                    <!-- start of add pet modal -->
                    <div class="modal fade" id="add_pet_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Pet</h1>
                                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                                </div>
                                <!-- start of add modal form -->
                                <form action="" method="post" enctype="multipart/form-data">
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
                                                            <div class="col-md-4 col-6 mt-2 mb-2">
                                                                <div class="form-group">
                                                                    <label for="add_category" class="ps-2 pb-2">Species</label>
                                                                    <select class="form-select" aria-label="Default select example" name="add_category" id="add_category" required>
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
                                                            <div class="col-md-4 col-6 mt-2 mb-2">
                                                                <div class="form-group">
                                                                    <label for="add_pet_name" class="ps-2 pb-2">Name</label>
                                                                    <input type="text" class="form-control" name="add_pet_name" id="add_pet_name" value="" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-6 mt-2 mb-2">
                                                                <div class="form-group">
                                                                    <label for="add_birthdate" class="ps-2 pb-2">Birthdate</label>
                                                                    <input type="date" class="form-control" name="add_birthdate" id="add_birthdate" value="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-6 mt-2 mb-2">
                                                                <div class="form-group">
                                                                    <label for="add_gender" class="ps-2 pb-2">Species</label>
                                                                    <select class="form-select" aria-label="Default select example" name="add_gender" id="add_gender" required>
                                                                            <option value="Male" selected>Male</option>;
                                                                            <option value="Female">Female</option>;
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6 mt-2 mb-2">
                                                                <div class="mb-3">
                                                                    <label for="pet_image" class="form-label">Pet Image</label>
                                                                    <input class="form-control" type="file" id="pet_image" name="pet_image" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end of add modal row -->
                                                    </div>
                                                    <!-- end of add modal card body -->
                                                    <!-- start of add modal footer -->
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-success btn-lg">Add</button>
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
                    <!-- end of add pet modal -->
                </div>
                <div class="text-dark">
                    <hr class="mx-2">
                </div>
                <!-- start of div for pet -->
                <div class="row ms-5 me-5">
                    <!-- start of pet form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- start of inner div for pet -->
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <?php
                                    $sql_select = "SELECT category.category_id, category.category, pet.* FROM category INNER JOIN pet USING (category_id) WHERE pet.is_deleted != 1 AND pet.user_id = $user_id_session ORDER BY pet.pet_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $category = $row_select['category'];
                                            $pet_id = $row_select['pet_id'];
                                            $pet_name = $row_select['pet_name'];
                                            $birthdate = $row_select['birthdate'];
                                            $gender = $row_select['gender'];
                                            $pet_image = $row_select['pet_image'];
                                ?>

                                            <div class="col-md-4">
                                                <img src="../pet-images/<?= $pet_image ?>" class="img-fluid rounded-start p-3" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title text-dark">Name:  <span class="fs-4 text-dark"><u><?= $pet_name ?></u></span></h5>
                                                    <h5 class="card-title text-dark">Category:  <span class="fs-4 text-dark"><u><?= $category ?></u></span></h5>
                                                    <h5 class="card-title text-dark">Gender:  <span class="fs-4 text-dark"><u><?= $gender ?></u></span></h5>
                                                    <h5 class="card-title text-dark">Birthdate:  <span class="fs-4 text-dark"><u><?= $birthdate ?></u></span></h5>
                                                    <div class="container mt-3 mb-0 ms-0 ps-0">
                                                        <a class="btn btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_pet<?= $pet_id ?>">Edit details <i class="fa-solid fa-file-pen"></i></a>  
                                                        <?php
                                                            include 'modals/edit-pet.php';
                                                        ?>

                                                        <a class="btn btn-danger edit" href="#" data-bs-toggle="modal" data-bs-target="#delete_pet<?= $pet_id ?>">Remove <i class="fa-solid fa-trash"></i></a>
                                                        <?php
                                                            include 'modals/delete-pet.php';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-dark">
                                                <hr class="mx-6">
                                            </div>
                                <?php
                                        }
                                    }else{
                                        echo '<h5 class="text-dark">You haven\'t added any pet yet.</h5>';
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- end of inner div for pet -->
                    </form>
                    <!-- end of pet form -->
                </div>
                <!-- end of div for pet -->
            </div>
            <!-- end of main content -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of sidebar main container -->
    <br><br><br><br>
    <?php
        require_once '../footer.php';
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>