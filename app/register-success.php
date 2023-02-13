<?php
    require_once 'includes/session.inc.php';
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
                                            <h1 class="text-center text-success p-5">You are one step closer away on creating your account! Please check the email that we sent to you.</h1>
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