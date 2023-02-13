<?php
    require_once 'includes/session.inc.php';
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
    <title>Reset Password</title>
    <?php
        require_once 'header.php';
    ?>
    <br><br><br><br>
    <br><br><br><br>
    <?php
        if(!isset($_SESSION['user_id'])){
            $email_error = ' *';
            $email_success = '';

            if(isset($_GET['error'])) {
                if($_GET['error'] == 'emptyemail') {
                    $email_error = ' *This field is required.';
                }elseif($_GET['error'] == 'invalidemail') {
                    $email_error = ' *Invalid email.';
                }elseif($_GET['error'] == 'emailnotregisteredyet') {
                    $email_error = ' *Email not registered yet.';
                }elseif($_GET['error'] == 'passworderror') {
                    $email_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i> Check your email.';
                }
            }

            if(isset($_GET['reset'])) {
                if($_GET['reset'] == 'success') {
                    $email_error = '';
                    $email_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i> Check your email.';
                }
            }
    ?>
            <!-- start of main container -->
            <div class="container">
                <!-- start of card -->
                <div class="card">
                    <!-- start of card header -->
                    <div class="card-header text-center pt-3 pb-3">
                        <h2 class="pt-3 pb-3">Reset Password</h2>
                    </div>
                    <!-- end of card header -->
                    <!-- start of card body -->
                    <div class="card-body">
                        
                            <!-- start of first row -->
                            <div class="row mb-1">
                                <div class="container">
                                    <div class="row">
                                        <h2 class="text-center p-3">Enter the email that you used on registration.</h2>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <form action="includes/reset-request.inc.php" method="post">
                                                <label for="email" class="form-label fs-5 ps-2">Email<span class="text-danger fs-5"><?= $email_error; ?></span><span class="text-success fs-5"><?= $email_success; ?></span></label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="johndoe123@gmail.com" value="">
                                                <button type="submit" name="next" class="btn btn-primary btn-lg mb-4 mt-4" style="width: 100%;">Next</button>
                                            </form>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of first row -->
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
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>