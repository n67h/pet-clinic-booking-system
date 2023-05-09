<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <?php
        require_once '../header.php';
        require_once 'sidebar.php';
        $success_message = ''; 

        $password_error = ' *';
        $new_password_error = ' *';
        $confirm_password_error = ' *';

        $password_success = '';
        $new_password_success = '';
        $confirm_password_success = '';

        $password_value = '';
        $new_password_value = '';
        $confirm_password_value = '';

        if(isset($_POST['change_password'])){
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            $sql = "SELECT * FROM user WHERE user_id = $user_id_session;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $hashed_password = $row['password'];
                }
                $check_password = password_verify($password, $hashed_password);
                $check_new_password = password_verify($new_password, $hashed_password);
                $check_confirm_password = password_verify($confirm_password, $hashed_password);
            }
            //validate password
            if(empty($password)){
                $password_error = ' *This field is required';
            }else{
                if($check_password === false) {
                    $password_error = ' *Invalid password';
                }else{
                    $password_error = '';
                    $password_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                    $password_value = $password;
                }
            }
            //validate new password
            if(empty($new_password)){
                $new_password_error = ' *This field is required';
            }else{
                $new_password_length = strlen($new_password);
                if(($new_password_length < 8 ) || ($new_password_length > 16)){
                    $new_password_error = ' *New password must be 8 to 16 characters only.';
                }elseif($new_password == $check_new_password){
                    $new_password_error = ' *New password must be different from the previous one.';
                }else{
                    $new_password_error = '';
                    $new_password_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                    $new_password_value = $new_password;
                }
            }
            //validate confirm password
            if(empty($confirm_password)){
                $confirm_password_error = ' *This field is required';
            }else{
                $confirm_password_length = strlen($confirm_password);
                if(($confirm_password_length < 8 ) || ($confirm_password_length > 16)){
                    $confirm_password_error = ' *New password must be 8 to 16 characters only.';
                }elseif($confirm_password == $check_confirm_password){
                    $confirm_password_error = ' *New password must be different from the previous one.';
                }elseif($new_password !== $confirm_password){
                    $confirm_password_error = ' *Password does not match.';  
                }else{
                    $confirm_password_error = '';
                    $confirm_password_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                    $confirm_password_value = $new_password;
                }
            }

            if(!empty($password) && !empty($new_password) && !empty($confirm_password) && $password_error == '' && $new_password_error == '' && $confirm_password_error == ''){

                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql_change_password = "UPDATE user SET password = '$new_hashed_password' WHERE user_id = $user_id_session;";
                $result_change_password = mysqli_query($conn, $sql_change_password);
                if($result_change_password){
                    $success_message = ' Password successfully changed.'; 
    
                    $password_error = '';
                    $new_password_error = '';
                    $confirm_password_error = '';
    
                    $password_success = '';
                    $new_password_success = '';
                    $confirm_password_success = '';
    
                    $password_value = '';
                    $new_password_value = '';
                    $confirm_password_value = '';      

                    $sql = "SELECT user_info.user_id, user_info.email, user_info.first_name, user.last_updated FROM user_info INNER JOIN user USING (user_id) WHERE user_id = $user_id_session;";

                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_assoc($result)){
                            $email = $row['email'];
                            $first_name = $row['first_name'];
                            $last_updated = $row['last_updated'];
                        }
                    }


                    //Load Composer's autoloader
                    require '../vendor/autoload.php';

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = '';                     //SMTP username
                        $mail->Password   = '';                               //SMTP password
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
                                    <h5 class="card-title">Thanks for changing your password!</h5>
                                    <p class="card-text">Hello, ' .$first_name. '. Your password has been successfully changed on ' .$last_updated.'. If you didn\'t commit this change, please contact our support as soon as possible.</p>
                                    
                                    <p>Our email support: testproject6767@gmail.com</p>
                                    <p>Your growth partner,</p>
                                    <p>Quimper Parables</p>
                                </div>
                            </div>
                        </div>';

                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Password successfully changed.';
                        $mail->Body    = $mail_content;
                        $mail->AltBody = strip_tags($mail_content);

                        $mail->send();
                        // echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    ?>
            <!-- start of main content -->
            <div class="col-md-9 bg-white">
                <h5 class="text-dark pt-3 ps-2">Change Password</h5>
                <p class="text-dark ps-2">For your account's security, do not share your password with anyone else.</p>
                <div class="text-dark">
                    <hr class="mx-2">
                </div>
                <!-- start of div for change password -->
                <div class="row ms-5 me-5">
                    <!-- start of change password form -->
                    <form action="" method="post">
                        <!-- start of inner div for change password -->
                        <div class="col-md-9">
                            <h5 class="text-success fs-5 ps-2"><?= $success_message; ?></h5>
                            <div class="mb-3">
                                <label for="password" class="form-label fs-5 ps-2">Password<span class="text-danger fs-5"><?= $password_error; ?></span><span class="text-success fs-5"><?= $password_success; ?></span></label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="" value="<?= $password_value; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label fs-5 ps-2">New Password<span class="text-danger fs-5"><?= $new_password_error; ?></span><span class="text-success fs-5"><?= $new_password_success; ?></span></label>
                                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="" value="<?= $new_password_value; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label fs-5 ps-2">Confirm Password<span class="text-danger fs-5"><?= $confirm_password_error; ?></span><span class="text-success fs-5"><?= $confirm_password_success; ?></span></label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="" value="<?= $confirm_password_value; ?>">
                            </div>
                            <div class="mb-5 mt-3 text-center">
                                <button type="submit" name="change_password" class="btn btn-info btn-lg mb-3" style="width: 100%;">Confirm</button>
                                <a href="../reset-password.php" class="">Forgot your password?</a>
                            </div>
                        </div>
                        <!-- end of inner div for change password -->
                    </form>
                    <!-- end of change password form -->
                </div>
                <!-- end of div for change password -->
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