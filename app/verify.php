<?php
    require_once 'includes/session.inc.php';
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once 'includes/db.inc.php';
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <?php
        require_once 'header.php';
    ?>
    <br><br><br><br>
    <br><br><br><br>
    <?php
        if(!isset($_SESSION['user_id'])){
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
                            <!-- start of first row -->
                            <div class="row mb-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md">
                                            <?php
                                                if(isset($_GET['verificationkey'])){
                                                    $vkey = mysqli_real_escape_string($conn, $_GET['verificationkey']);

                                                    $sql = "SELECT user_info.user_id, user_info.email, user_info.first_name, user.verification_key, user.is_verified FROM user_info INNER JOIN user USING (user_id) WHERE is_verified = 0 AND verification_key = '$vkey' LIMIT 1;";

                                                    $result = mysqli_query($conn, $sql);
                                                    $count = mysqli_num_rows($result);

                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $email = $row['email'];
                                                        $first_name = $row['first_name'];
                                                    }

                                                    if($count > 0) {
                                                        $sql = "UPDATE user SET is_verified = 1 WHERE verification_key = '$vkey';";

                                                        if(mysqli_query($conn, $sql)) {
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
                                                                            <h5 class="card-title">Thanks for creating your account!</h5>
                                                                            <p class="card-text">We have successfully verified the email address associated with your Veterinary Clinic account. Again, thank you for registering with us. We could not be more excited to be part of your journey.</p>
                                                                            <br>
                                                                            <p>As always, please let us know if you have any questions or concerns.</p>
                                                                            <p>Your growth partner,</p>
                                                                            <p>Quimper Parables</p>
                                                                        </div>
                                                                    </div>
                                                                </div>';

                                                                $mail->isHTML(true);                                  //Set email format to HTML
                                                                $mail->Subject = 'Your email address has been successfully verified.';
                                                                $mail->Body    = $mail_content;
                                                                $mail->AltBody = strip_tags($mail_content);

                                                                $mail->send();
                                                                $success_message = '<h1 class="text-center text-success p-5"> Your email address has been successfully verified. You will be automatically redirected to login page in <span id="counter">10</span> second(s).</h1>
                                                                <script type="text/javascript">
                                                                    function countdown() {
                                                                        var i = document.getElementById("counter");
                                                                        if (parseInt(i.innerHTML)<=0) {
                                                                            location.href = "login.php";
                                                                        }
                                                                        i.innerHTML = parseInt(i.innerHTML)-1;
                                                                    }
                                                                    setInterval(function(){ countdown(); },1000);
                                                                </script>';
                                                                echo $success_message;
                                                                // header("refresh:10;url=login.php");
                                                                // die();
                                                            } catch (Exception $e) {
                                                                echo '<h1 class="text-center text-danger p-5">Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h1>';
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                            <!-- <h1 class="text-center text-success p-5">You are one step closer away on creating your account! Please check the email that we sent to you.</h1> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of first row -->
                        </form>
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
    <br><br><br><br>
    <?php
        require_once 'footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>