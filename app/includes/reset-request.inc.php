<?php
    require_once 'session.inc.php';
    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //check if user is not logged in
    if(!isset($_SESSION['user_id'])){
        //if next button is clicked, then execute the codes below
        if(isset($_POST['next'])) {
            //grab the email input from user
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            //grab the first name of the user
            $sql_fname = "SELECT first_name FROM user_info WHERE email = '$email';";
            $result_fname = mysqli_query($conn, $sql_fname);
            if(mysqli_num_rows($result_fname) > 0){
                while($row_fname = mysqli_fetch_assoc($result_fname)){
                    $first_name = $row_fname['first_name'];
                }
            }else{
                // header('location: ../reset-password.php?error=invalidemail');
                // die();
            }
            //validate email
            //if empty, throw error
            if(emailEmpty($email) !== false) {
                header('location: ../reset-password.php?error=emptyemail');
                die();
            } else {
                //if the input is not email, throw error
                if(emailInvalid($email) !== false) {
                    header('location: ../reset-password.php?error=invalidemail');
                    die();
                }elseif(mysqli_num_rows($result_fname) < 1){
                    header('location: ../reset-password.php?error=emailnotregisteredyet');
                    die();
                //if all conditions are met, then proceed
                }elseif(emailExists($conn, $email) !== false){
                    $selector = bin2hex(random_bytes(8));
                    $token = random_bytes(32);
            
                    $url = 'http://localhost/pet-clinic-booking-system/app/create-new-password.php?selector=' . $selector . '&validator=' . bin2hex($token);
            
                    $expires = date('U') + 1800;

                    $sql = "DELETE FROM password_reset WHERE password_reset_email = ?;";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'There was an error.';
                        die();
                    } else {
                        mysqli_stmt_bind_param($stmt, 's', $email);
                        mysqli_stmt_execute($stmt);
                    }

                    $sql = "INSERT INTO password_reset (password_reset_email, password_reset_selector, password_reset_token, password_reset_expires) VALUES (?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'There was an error.';
                        die();
                    } else {
                        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                        
                        mysqli_stmt_bind_param($stmt, 'ssss', $email, $selector, $hashedToken, $expires);
                        mysqli_stmt_execute($stmt);
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

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
                                    <p class="card-text">We received a password reset request. The link to reset your password is below.</p>
                                    <a href="' .$url. '" class="btn btn-primary btn-lg mb-3">Click here to reset your password.</a>
                                    <br>
                                    <p>If you did not requested to reset your password, kindly ignore the link that we sent and contact our support <strong>testproject6767@gmail.com</strong>.</p>
                                    <p>If you have any questions or concerns, kindly respond to this email.</p>
                                    <p>Your growth partner,</p>
                                    <p>Quimper Parables</p>
                                </div>
                            </div>
                        </div>';

                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Reset password request.';
                        $mail->Body    = $mail_content;
                        $mail->AltBody = strip_tags($mail_content);

                        $mail->send();
                        // echo 'Message has been sent';
                        header('location: ../reset-password.php?reset=success');
                        die();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        //if user did not clicked the next button, then redirect him/her back to index
        }else{
            header('location: ../index.php');
            die();
        }
    //if user is currently logged in, then redirect him/her back to index
    }else{
        header('location: ../index.php');
        die();
    }