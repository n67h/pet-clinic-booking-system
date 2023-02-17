<?php
    require_once 'includes/session.inc.php';
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once 'includes/db.inc.php';
    require_once 'includes/functions.inc.php';
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php
        require_once 'header.php';
    ?>
    <br><br>
    <?php
        if(!isset($_SESSION['user_id'])){
            $first_name_error = ' *';
            $last_name_error = ' *';
            $username_error = ' *';
            $email_error = ' *';
            $password_error = ' *';
            $repeat_password_error = ' *';
            $terms_error = ' *';
    
            $first_name_value = '';
            $last_name_value = '';
            $username_value = '';
            $email_value = '';
            $password_value = '';
            $repeat_password_value = '';
            $terms_value = '';
    
            $first_name_success = '';
            $last_name_success = '';
            $username_success = '';
            $email_success = '';
            $password_success = '';
            $repeat_password_success = '';
            $terms_success = '';
    
            if(isset($_POST['register'])){
                $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $repeat_password = mysqli_real_escape_string($conn, $_POST['repeat_password']);
    
                // validate first name
                if(firstnameEmpty($first_name) !== false) {
                    $first_name_error = ' *This field is required.';
                } else {
                    if(firstnameInvalid($first_name) !== false) {
                        $first_name_error = ' *Invalid first name.';
                    } else {
                        $first_name_error = '';
                        $first_name_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $first_name_value = $first_name;
                    }
                }
    
                //validate last name
                if(lastnameEmpty($last_name) !== false) {
                    $last_name_error = ' *This field is required.';
                } else {
                    if(lastnameInvalid($last_name) !== false) {
                        $last_name_error = ' *Invalid last name.';
                    } else {
                        $last_name_error = '';
                        $last_name_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $last_name_value = $last_name;
                    }
                }

                // validate username
                if(usernameEmpty($username) !== false) {
                    $username_error = ' *This field is required.';
                } else {
                    if(usernameInvalid($username) !== false) {
                        $username_error = ' *Username must be 6 to 18 characters only.';
                    } elseif(usernameExists($conn, $username) !== false) {
						$username_error = ' *Username is already taken.';
					} else {
                        $username_error = '';
                        $username_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $username_value = $username;
                    }
                }

                //validate email
                if(emailEmpty($email) !== false) {
                    $email_error = ' *This field is required.';
                } else {
                    if(emailInvalid($email) !== false) {
                        $email_error = ' *Invalid email.';
                    } elseif(emailExists($conn, $email) !== false) {
                        $email_error = ' *Email is already taken.';
                    } else {
                        $email_error = '';
                        $email_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $email_value = $email;
                    }
                }

                //validate password
                if(passwordEmpty($password) !== false) {
                    $password_error = ' *This field is required';
                } else {
                    if(passwordInvalid($password)  !== false) {
                        $password_error = ' *Password must be  8 to 16 characters only.';
                    } else {
                        $password_error = '';
                        $password_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $password_value = $password;
                    }
                }

                //validate repeat password
                if(passwordRepeatEmpty($repeat_password) !== false) {
                    $repeat_password_error = ' *This field is required.';
                } else {
                    if(passwordRepeatInvalid($repeat_password) !== false) {
                        $repeat_password_error = ' *Password must be 8 to 16 characters only.';
                    } elseif(passwordMatch($password, $repeat_password) !== false) {
                        $repeat_password_error = ' *Password does not match.';
                    } else {
                        $repeat_password_error = '';
                        $repeat_password_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                        $repeat_password_value = $repeat_password;
                    }
                }

                //generate random verification key
                $vkey = md5(time());

                //validate checkbox
                if(!isset($_POST['terms'])) {
                    $terms_error = ' *This field is required';
                } else {
                    $terms_error = '';
                    $terms_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                }

                // if all the inputs are valid, then create the account for user and send email to verify their account
                if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password) && !empty($repeat_password) && firstnameInvalid($first_name) === false && lastnameInvalid($last_name) === false && emailInvalid($email) === false && emailExists($conn, $email) === false && passwordInvalid($password) === false && passwordRepeatInvalid($repeat_password) === false && passwordMatch($password, $repeat_password) === false && $vkey != "" && $terms_error === "") {
                    createUser($conn, $username, $password, $vkey, $email, $first_name, $last_name);

                    //Load Composer's autoloader
                    require 'vendor/autoload.php';

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'testproject6767@gmail.com';                     //SMTP username
                        $mail->Password   = 'jexwzyjkymvxwxze';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('testproject6767@gmail.com', 'Veterinary Clinic');
                        $mail->addAddress($email, $first_name);     //Add a recipient
                        
                        //Content
                        $mail_content = '
                        <div class="container">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Hi there, ' .$first_name. '</h3>
                                </div>
                                <div class="card-body fs-4">
                                    <h5 class="card-title">Thanks for creating your account!</h5>
                                    <p class="card-text">You\'re one step closer on activating your account. To start using your account, you need to confirm your email address first by clicking the button below:</p>
                                    <a href="http://localhost/pet-clinic-booking-system/app/verify.php?verificationkey=' .$vkey. '" class="btn btn-primary btn-lg mb-3">Click here to verify your account.</a>
                                    <br>
                                    <p>If you have any questions or concerns, kindly respond to this email.</p>
                                    <p>Your growth partner,</p>
                                    <p>Quimper Parables</p>
                                </div>
                            </div>
                        </div>';

                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Welcome to Veterinary! Verify the email address of your account here.';
                        $mail->Body    = $mail_content;
                        $mail->AltBody = strip_tags($mail_content);

                        $mail->send();
                        // echo 'Message has been sent';
                        header('location: register-success.php');
                        die();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
    ?>
            <!-- start of main container -->
            <div class="container">
                <!-- start of card -->
                <div class="card">
                    <!-- start of card header -->
                    <div class="card-header text-center pt-3 pb-3">
                        <h2 class="pt-3 pb-3">Registration form</h2>
                    </div>
                    <!-- end of card header -->
                    <!-- start of card body -->
                    <div class="card-body">
                        <!-- <h5 class="card-title">Special title treatment</h5> -->
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        <!-- start of registration form -->
                        <form action="" method="post">
                            <!-- start of first row -->
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label fs-5 ps-2">First Name<span class="text-danger fs-5"><?= $first_name_error; ?></span><span class="text-success fs-5"><?= $first_name_success; ?></span></label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John" value="<?= $first_name_value; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label fs-5 ps-2">Last Name<span class="text-danger fs-5"><?= $last_name_error; ?></span><span class="text-success fs-5"><?= $last_name_success; ?></span></label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe" value="<?= $last_name_value; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- end of first row -->
                            <!-- start of second row -->
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label fs-5 ps-2">Username<span class="text-danger fs-5"><?= $username_error; ?></span><span class="text-success fs-5"><?= $username_success; ?></span></label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="johndoe123" value="<?= $username_value; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="email" class="form-label fs-5 ps-2">Email<span class="text-danger fs-5"><?= $email_error; ?></span><span class="text-success fs-5"><?= $email_success; ?></span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="email" class="form-control" id="email" placeholder="johndoe123@gmail.com" aria-label="johndoe123@gmail.com" aria-describedby="basic-addon2" value="<?= $email_value; ?>">
                                        <span class="input-group-text" id="basic-addon2">@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end of second row -->
                            <!-- start of third row -->
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label fs-5 ps-2">Password<span class="text-danger fs-5"><?= $password_error; ?></span><span class="text-success fs-5"><?= $password_success; ?></span></label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="" value="<?= $password_value; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="repeat_password" class="form-label fs-5 ps-2">Repeat Password<span class="text-danger fs-5"><?= $repeat_password_error; ?></span><span class="text-success fs-5"><?= $repeat_password_success; ?></span></label>
                                        <input type="password" name="repeat_password" class="form-control" id="repeat_password" placeholder="" value="<?= $repeat_password_value; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- end of third row -->
                            <!-- start of fourth row -->
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="form-check fs-5">
                                        <input name="terms" class="form-check-input" type="checkbox" value="" id="terms" <?php if(isset($_POST['terms'])) { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="terms">I agree to the <a href="#">Terms and Conditions</a> as set out by the user agreement.<span class="text-danger fs-5"><?= $terms_error; ?></span><span class="text-success fs-5"><?= $terms_success; ?></span></label>
                                    </div>
                                </div>
                            </div>
                            <!-- end of fourth row -->
                            <!-- start of fifth row -->
                            <div class="row mb-1">
                                <div class="col-sm-12">
                                    <div class="mb-3 mt-3 text-center">
                                        <button type="submit" name="register" class="btn btn-primary btn-lg mb-4" style="width: 100%;">Register</button>
                                        <a href="login.php" class="">Already have an account?</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end of fifth row -->
                        </form>
                        <!-- end of registration form -->
                    </div>
                    <!-- end of card body -->
                </div>
                <!-- end of card -->
            </div>
            <!-- end of main container -->
    <?php
        }else{
            header('location: index.php');
            die();
        }
    ?>
    
    <br><br><br><br>
    <?php
        require_once 'footer.php';
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>