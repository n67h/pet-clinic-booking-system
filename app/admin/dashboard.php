<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <div class="container">
        <div class="row mb-5 mt-5">
            <div class="col-md-3 mb-5">
                <!-- total users -->
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <a href="user.php" class="text-decoration-none text-dark">
                            <h1><i class="fa-solid fa-user-group"></i></h1>
                            <h5 class="card-title">Total Users</h5>
                            <?php
                                $sql_user = "SELECT COUNT(user_id) AS total_user FROM user WHERE user_role_id != 1 AND is_deleted != 1;";
                                $result_user = mysqli_query($conn, $sql_user);
                                if(mysqli_num_rows($result_user) > 0){
                                    $row_user = mysqli_fetch_assoc($result_user);
                                    $total_user = $row_user['total_user'];
                                    echo '<p class="card-text">'.$total_user.'</p>';
                                }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <!-- completed appointments -->
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <a href="appointment.php" class="text-decoration-none text-dark">
                            <h1><i class="fa-solid fa-book-bookmark"></i></h1>
                            <h5 class="card-title">Completed Appointments</h5>
                            <?php
                                $sql_appointment = "SELECT COUNT(appointment_id) AS total_appointment FROM appointment WHERE status = 1 AND is_deleted != 1;";
                                $result_appointment = mysqli_query($conn, $sql_appointment);
                                if(mysqli_num_rows($result_appointment) > 0){
                                    $row_appointment = mysqli_fetch_assoc($result_appointment);
                                    $total_appointment = $row_appointment['total_appointment'];
                                    echo '<p class="card-text">'.$total_appointment.'</p>';
                                }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <!-- all categories -->
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <a href="category.php" class="text-decoration-none text-dark">
                            <h1><i class="fa-solid fa-paw"></i></h1>
                            <h5 class="card-title">Pet Categories</h5>
                            <?php
                                $sql_category = "SELECT COUNT(category_id) AS total_category FROM category WHERE is_deleted != 1;";
                                $result_category = mysqli_query($conn, $sql_category);
                                if(mysqli_num_rows($result_category) > 0){
                                    $row_category = mysqli_fetch_assoc($result_category);
                                    $total_category = $row_category['total_category'];
                                    echo '<p class="card-text">'.$total_category.'</p>';
                                }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <!-- all services -->
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <a href="service.php" class="text-decoration-none text-dark">
                            <h1><i class="fa-solid fa-syringe"></i></h1>
                            <h5 class="card-title">All Services</h5>
                            <?php
                                $sql_service = "SELECT COUNT(service_id) AS total_service FROM service WHERE is_deleted != 1;";
                                $result_service = mysqli_query($conn, $sql_service);
                                if(mysqli_num_rows($result_service) > 0){
                                    $row_service = mysqli_fetch_assoc($result_service);
                                    $total_service = $row_service['total_service'];
                                    echo '<p class="card-text">'.$total_service.'</p>';
                                }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- TOTAL APPOINTMENTS PER MONTH -->
                <?php
                    $query1 = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS appointment FROM appointment GROUP BY MONTH(date), YEAR(date) ORDER BY month;";
                    $result1 = mysqli_query($conn, $query1);

                    foreach($result1 as $data1){
                        $month[] = $data1['month'];
                        $appointment[] = $data1['appointment'];
                    }
                ?>
                <div class="barchart1 ps-5 ms-5 me-5 pe-5" style="height: 560px; width: 600px;">
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <!-- MOST POPULAR PETS -->
                <?php
                    $query2 = "SELECT c.category, COUNT(*) as count
                    FROM appointment a
                    JOIN pet p ON a.pet_id = p.pet_id
                    JOIN category c ON p.category_id = c.category_id
                    GROUP BY c.category;";
                    $result2 = mysqli_query($conn, $query2);
        
                    foreach($result2 as $data2){
                        $category[] = $data2['category'];
                        $count[] = $data2['count'];
                    }1
                ?>
                <div class="barchart2 ms-5 ps-5" style="height: 300px; width: 400px;">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once 'scripts.php';
    ?>