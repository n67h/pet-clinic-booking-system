<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_GET['id'])){
        $edit_pet_id = $_GET['id'];

        $file_destination = '';
        if(isset($_POST['edit'])){
            $edit_category = mysqli_real_escape_string($conn, $_POST['edit_category']);
            $edit_pet_name = mysqli_real_escape_string($conn, $_POST['edit_pet_name']);
            $edit_birthdate = mysqli_real_escape_string($conn, $_POST['edit_birthdate']);
            $edit_gender = mysqli_real_escape_string($conn, $_POST['edit_gender']);


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

            if(empty($edit_category) || empty($edit_pet_name) || empty($edit_birthdate) || empty($edit_gender)){
                $error_message = "All fields are required!";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }else{
                if($_FILES["pet_image"]["error"] == 4) {
                    //means there is no file uploaded
                    $error_message = "Pet image is required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    if(in_array($file_actual_ext, $allowed)) {
                        if($file_error === 0) {
                            if($file_size < 5000000) {
                                $file_name_new = $edit_pet_id. "." .$file_actual_ext;
                                $file_destination = '../../pet-images/' .$file_name_new;
                                move_uploaded_file($file_tmp_name, $file_destination);
                                $sql = "UPDATE pet SET category_id = $edit_category, pet_name = '$edit_pet_name', birthdate = '$edit_birthdate', gender = '$edit_gender', pet_image = '$file_name_new' WHERE pet_id = $edit_pet_id;";
                                if(mysqli_query($conn, $sql)){
                                    header('location: ../pet.php');
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
        }else{
            // header('location: ../pet.php');
            // die();
            echo 'for the love of god, please work ' . $edit_pet_id;
        }
    }