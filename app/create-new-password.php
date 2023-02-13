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
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            if(empty($selector) || empty($validator)) {
                echo 'Could not validate your request.';
            }else {
                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                    $password_error = ' *';
                    $password_repeat_error = ' *';
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
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6 mb-5">
                                                    <form action="includes/reset-password.inc.php" method="post">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label fs-5 ps-2">Password<span class="text-danger fs-5"></span><span class="text-success fs-5"></span></label>
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="" value="">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="repeat_password" class="form-label fs-5 ps-2">Repeat Password<span class="text-danger fs-5"></span><span class="text-success fs-5"></span></label>
                                                            <input type="password" name="repeat_password" class="form-control" id="repeat_password" placeholder="" value="">
                                                        </div>
                                                        <button type="submit" name="reset-password" class="btn btn-primary btn-lg mb-4 mt-4" style="width: 100%;">Reset Password</button>
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
                }
            }
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