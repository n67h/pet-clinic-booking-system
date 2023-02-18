<?php
    session_start();
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../../resources/css/admin-login.css">
</head>
<body>
    <?php
        if(isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            if(empty($username) || empty($password)) {
                header('location: login.php?error=emptyfields');
                die();
            }


            // function to check if username already exists
            function usernameExists($conn, $email) {
                $sql = "SELECT * FROM user WHERE username = ?;";
                $stmt = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                }
        
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
        
                $resultData = mysqli_stmt_get_result($stmt);
        
                if($row = mysqli_fetch_assoc($resultData)) {
                    return $row;
                } else {
                    $result = false;
                    return $result;
                }
        
                mysqli_stmt_close($stmt);
            }
            // end of function

            $usernameExists = usernameExists($conn, $username);

            if($usernameExists === false) {
                header("location: login.php?error=invalidusername");
                die();
            }
            
            $passwordHashed = $usernameExists["password"];

            $checkPassword = password_verify($password, $passwordHashed);

            if($checkPassword === false) {
                header("location: login.php?error=invalidpassword");
                die();
            } elseif($checkPassword === true) {
                
                $query = "SELECT * FROM user WHERE user_id = '" .$usernameExists['user_id']. "' AND username = '" .$usernameExists['username']. "' AND is_verified = 1;";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                if($count === 1) {    
                    session_start();
                    $_SESSION['user_id'] = $usernameExists['user_id'];
                    $_SESSION['username'] = $usernameExists['username'];
                    $_SESSION['user_role_id'] = $usernameExists['user_role_id'];

                    $query = "UPDATE user SET last_login = NOW() WHERE user_id = '" .$usernameExists['user_id']. "' AND username = '" .$usernameExists['username']. "';";
                    $result = mysqli_query($conn, $query);

                    header("location: dashboard.php");
                    die();
                } else {
                    header("location: login.php?error=usernotverifiedyet");
                    die();
                }
            }
        }
    ?>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="box shadow bg-white p-4">
                    <h6 class="mb-4 text-center fs-1">Login Form</h6>
                    <form action="" method="post" class="mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control rounded-0" id="username" placeholder="Username" required!>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control rounded-0" id="password" placeholder="Password" required!>
                            <label for="password">Password</label>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="login" class="btn btn-dark btn-lg border-0 rounded-0">Log in</button>
                        </div>
                        <?php
                            $error_message = '';
                            if(isset($_GET['error'])){
                                if($_GET['error'] === 'emptyfields'){
                                    $error_message = 'All fields are required.';
                                }elseif($_GET['error'] === 'invalidusername'){
                                    $error_message = 'Invalid username.';
                                }elseif($_GET['error'] === 'invalidpassword'){
                                    $error_message = 'Invalid password.';
                                }elseif($_GET['error'] === 'usernotverifiedyet'){
                                    $error_message = 'User not verified yet.';
                                }elseif($_GET['error'] === 'accessdenied'){
                                    $error_message = 'Access denied.';
                                }
                            }
                        ?>
                        <h6 class="text-danger text-center"><?= $error_message; ?></h6>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- js section -->
    <!-- bootstrap js popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        // $('.sidebar ul li').on('click', function(){
        //     $('.sidebar ul li.active').removeClass('active');
        //     $(this).addClass('active');
        // });

        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });

        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });
    </script>
</body>
</html>