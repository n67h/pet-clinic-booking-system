<?php
    session_start();
    ob_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once 'includes/db.inc.php';
    require_once 'includes/functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
        require_once 'header.php';
    ?>
    <br><br><br><br>
    <?php
        if(!isset($_SESSION['user_id'])){
            
            $username_error = ' *';
            $password_error = ' *';
    
            $username_value = '';
            $password_value = '';
    
            $username_success = '';
            $password_success = '';
    
            if(isset($_POST['login'])) {
                
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                
                // validate username or email
                if(empty($username)){
                    $username_error = ' *This field is required.';
                }else{
                    $query_username = "SELECT user.*, user_info.user_id, user_info.email FROM user INNER JOIN user_info USING (user_id) WHERE username = '$username';";
                    $result_username = mysqli_query($conn, $query_username);
                    $count_username = mysqli_num_rows($result_username);
    
                    $query_email = "SELECT user.*, user_info.user_id, user_info.email FROM user INNER JOIN user_info USING (user_id) WHERE email = '$username';";
                    $result_email = mysqli_query($conn, $query_email);
                    $count_email = mysqli_num_rows($result_email);
    
    
                    if($count_username === 1 || $count_email === 1) {
                        while($row_username = mysqli_fetch_assoc($result_username)){
                            $username_value = $row_username['username'];
                            $username_error = '';
                            $username_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
    
                            $hashed_password = $row_username['password'];
                            $verify_password = password_verify($password, $hashed_password);
    
                            if($verify_password === false){
                                $password_error = ' *Invalid password.';
                            }else{
                                $is_verified = $row_username['is_verified'];
                                if($is_verified == 0){
                                    $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify_username" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button>';
                                    $username_success = '';
                                }else{
                                    session_start();
                                    $_SESSION['user_id'] = $row_username['user_id'];
                                    $_SESSION['username'] = $row_username['username'];
                                    $_SESSION['email'] = $row_username['email'];
                                    $_SESSION['user_role_id'] = $row_username['user_role_id'];
    
                                    $query = "UPDATE user SET last_login = NOW() WHERE user_id = '" .$row_username['user_id']. "' AND username = '" .$row_username['username']. "';";
                                    $result = mysqli_query($conn, $query);
    
                                    header("location: index.php");
                                    die();
                                }
                            }
                        }
    
                        while($row_email = mysqli_fetch_assoc($result_email)){
                            $username_value = $row_email['email'];
                            $username_error = '';
                            $username_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
    
                            $hashed_password = $row_email['password'];
                            $verify_password = password_verify($password, $hashed_password);
    
                            if($verify_password === false){
                                $password_error = ' *Invalid password.';
                            }else{
                                $is_verified = $row_email['is_verified'];
                                if($is_verified == 0){
                                    $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify_email" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button>';
                                    $username_success = '';
                                }else{
                                    session_start();
                                    $_SESSION['user_id'] = $row_email['user_id'];
                                    $_SESSION['username'] = $row_email['username'];
                                    $_SESSION['email'] = $row_email['email'];
                                    $_SESSION['user_role_id'] = $row_email['user_role_id'];
    
                                    $query = "UPDATE user SET last_login = NOW() WHERE user_id = '" .$row_email['user_id']. "' AND username = '" .$row_email['username']. "';";
                                    $result = mysqli_query($conn, $query);
    
                                    header("location: index.php");
                                    die();
                                }
                            }
                        }
                    }else{
                        $username_error = ' *Invalid username or email';
                    }
                }
    
                if(empty($password)){
                    $password_error = ' *This field is required';
                }
            }
    
            if(isset($_POST['verify_username'])){
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
    
                $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button>';
                $username_value = $username;
    
                $sql = "SELECT user.*, user_info.user_id, user_info.email, user_info.first_name FROM user INNER JOIN user_info USING (user_id) WHERE username = '$username';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $vkey = $row['verification_key'];
                        $email = $row['email'];
                        $first_name = $row['first_name'];
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
                            $mail->setFrom('testproject6767@gmail.com', 'Andre Paul');
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
                                        <a href="http://localhost/online-shop/verify.php?verificationkey=' .$vkey. '" class="btn btn-primary btn-lg mb-3">Click here to verify your account.</a>
                                        <br>
                                        <p>If you have any questions or concerns, kindly respond to this email.</p>
                                        <p>Your growth partner,</p>
                                        <p>Let\'s fucking go!</p>
                                    </div>
                                </div>
                            </div>';
    
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Welcome to Online Shop! Verify the email address of your account here.';
                            $mail->Body    = $mail_content;
                            $mail->AltBody = strip_tags($mail_content);
    
                            $mail->send();
                            $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button><p class="fs-5 text-success bg-white">Email sent, check the email that we sent to ' .$email. '</p>';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                }
            }
    
            if(isset($_POST['verify_email'])){
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
    
                $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button>';
                $username_value = $username;
    
                $sql = "SELECT user.*, user_info.user_id, user_info.email, user_info.first_name FROM user INNER JOIN user_info USING (user_id) WHERE email = '$username';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $vkey = $row['verification_key'];
                        $email = $row['email'];
                        $first_name = $row['first_name'];
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
                            $mail->setFrom('testproject6767@gmail.com', 'Andre Paul');
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
                                        <a href="http://localhost/online-shop/verify.php?verificationkey=' .$vkey. '" class="btn btn-primary btn-lg mb-3">Click here to verify your account.</a>
                                        <br>
                                        <p>If you have any questions or concerns, kindly respond to this email.</p>
                                        <p>Your growth partner,</p>
                                        <p>Let\'s fucking go!</p>
                                    </div>
                                </div>
                            </div>';
    
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Welcome to Online Shop! Verify the email address of your account here.';
                            $mail->Body    = $mail_content;
                            $mail->AltBody = strip_tags($mail_content);
    
                            $mail->send();
                            $username_error = ' *Your account has not yet been verified.<button type="submit" name="verify" class="border border-0 nav-link text-primary bg-white fs-5">Resend email verification</button><p class="fs-5 text-success bg-white">Email sent, check the email that we sent to ' .$email. '</p>';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
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
                    <h2 class="pt-3 pb-3">Login</h2>
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
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label fs-5 ps-2">Username or email<span class="text-danger fs-5"><?= $username_error; ?></span><span class="text-success fs-5"><?= $username_success; ?></span></label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username or email" value="<?= $username_value; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>
                        <!-- end of first row -->
                        <!-- start of second row -->
                        <div class="row mb-1">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label fs-5 ps-2">Password<span class="text-danger fs-5"><?= $password_error; ?></span><span class="text-success fs-5"><?= $password_success; ?></span></label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= $password_value; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>
                        <!-- end of second row -->
                        <!-- start of third row -->
                        <div class="row mb-1">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 text-center">
                                    <a href="#" class="mt-1">Forgot password?</a>
                                    <button type="submit" name="login" class="btn btn-info btn-lg mb-4 mt-4" style="width: 100%;">Log in</button>
                                    <a href="register.php" class="">New to Veterinary Clinic?</a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>
                        <!-- end of third row -->
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