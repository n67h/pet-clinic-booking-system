<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }else{
        $sql = "SELECT user_info.user_id, user_info.email, user_info.first_name, user_info.last_name, user_info.image, user_info.phone_number, user.username FROM user_info INNER JOIN user USING (user_id) WHERE user_id = $user_id_session;";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $image_value = $row['image'];
                $username_value = $row['username'];
                $first_name_value = $row['first_name'];
                $last_name_value = $row['last_name'];
                $email_value = $row['email'];
                $phone_number_value = $row['phone_number'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php
        require_once '../header.php';
        require_once 'sidebar.php';
        $success_message = '';

        $image_error = '';
        $first_name_error = '';
        $last_name_error = '';
        $phone_number_error = '';

        $image_success = '';
        $first_name_success = '';
        $last_name_success = '';
        $phone_number_success = '';

        $file_destination = '';
        if(isset($_POST['profile'])){
            $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

            //validate profile picture
            $file = $_FILES['image'];
            $file_name = $_FILES['image']['name'];
            $file_tmp_name = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];
            $file_error = $_FILES['image']['error'];
            $file_type = $_FILES['image']['type'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png',);

            if($_FILES["image"]["error"] == 4) {
                //means there is no file uploaded
                $image_error = '';
                $file_destination = $image_value;
            }else{
                if(in_array($file_actual_ext, $allowed)) {
                    if($file_error === 0) {
                        if($file_size < 5000000) {
                            $file_name_new = $user_id_session. "." .$file_actual_ext;
                            $file_destination = '../profile-pictures/' .$file_name_new;
                            move_uploaded_file($file_tmp_name, $file_destination);
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

            //validate first name
            $first_name_length = strlen($first_name);
            if((!preg_match("/^[a-zA-Z ,.'-]+$/i", $first_name)) || ($first_name_length < 2)) {
                $first_name_error = ' *Invalid first name.'; 
            } else {
                $first_name_error = '';
                $first_name_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $first_name_value = $first_name;
            }

            //validate last name
            $last_name_length = strlen($last_name);
            if((!preg_match("/^[a-zA-Z ,.'-]+$/i", $last_name)) || ($last_name_length < 2)) {
                $last_name_error = ' *Invalid last name.'; 
            } else {
                $last_name_error = '';
                $last_name_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $last_name_value = $last_name;
            }

            //validate phone number
            if(empty($phone_number)){
                $phone_number_error = '';
            }else{
                if(!preg_match("/((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/", $phone_number)) {
                    $phone_number_error = ' *Invalid phone number.';
                }else{
                    $phone_number_error = '';
                    $phone_number_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                    $phone_number_value = $phone_number;
                }
            }
            
            //if all condition is met, update the profile
            if($first_name_error == '' && $last_name_error == '' && $phone_number_error == '' && $file_destination !== ''){
                $sql_update = "UPDATE user_info SET phone_number = '$phone_number', first_name = '$first_name', last_name = '$last_name', image = '$file_destination' WHERE user_id = $user_id_session;";
                $result_update = mysqli_query($conn, $sql_update);
                if($result_update){
                    $success_message = ' Profile successfully updated.';
                }
            }
        }
    ?>
            <!-- start of main content -->
            <div class="col-md-9 bg-white">
                <h5 class="text-dark pt-3 ps-2">My Profile</h5>
                <p class="text-dark ps-2">Manage and protect your account.</p>
                <div class="text-dark">
                    <hr class="mx-2">
                </div>
                <!-- start of div for profile -->
                <div class="row ms-5 me-5">
                    <!-- start of profile form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- start of inner div for profile -->
                        <div class="col-md-9">
                        <h5 class="text-success fs-5 ps-2"><?= $success_message; ?></h5>

                            <div class="mb-1">
                                <?php
                                    if($image_value == 'profile-pictures/default.png'){
                                        echo '<img class="text-dark rounded-circle" src="../' .$image_value. '" alt="" style="width: 30%; height: 40%;">';
                                    }else{
                                        echo '<img class="text-dark rounded-circle" src="' .$image_value. '" alt="" style="width: 30%; height: 40%;">';
                                    }
                                ?>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label fs-5 ps-2">Select image<span class="text-danger fs-5"><?= $image_error; ?></span><span class="text-success fs-5"><?= $image_success; ?></span></label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label fs-5 ps-2">Username<span class="text-danger fs-5"></span><span class="text-success fs-5"></span></label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="" value="<?= $username_value; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fs-5 ps-2">Email<span class="text-danger fs-5"></span><span class="text-success fs-5"></span></label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="" value="<?= $email_value; ?>" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label fs-5 ps-2">First Name<span class="text-danger fs-5"><?= $first_name_error; ?></span><span class="text-success fs-5"><?= $first_name_success; ?></span></label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="" value="<?= $first_name_value; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label fs-5 ps-2">Last Name<span class="text-danger fs-5"><?= $last_name_error; ?></span><span class="text-success fs-5"><?= $last_name_success; ?></span></label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="" value="<?= $last_name_value; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label fs-5 ps-2">Phone Number<span class="text-danger fs-5"><?= $phone_number_error; ?></span><span class="text-success fs-5"><?= $phone_number_success; ?></span></label>
                                <input type="number" name="phone_number" class="form-control" id="phone_number" placeholder="" value="<?= $phone_number_value; ?>">
                            </div>
                            
                            <div class="mb-5 mt-4 text-center">
                                <button type="submit" name="profile" class="btn btn-info btn-lg mb-3" style="width: 100%;">Save changes</button>
                            </div>
                        </div>
                        <!-- end of inner div for profile -->
                    </form>
                    <!-- end of profile form -->
                </div>
                <!-- end of div for profile -->
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