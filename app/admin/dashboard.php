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
        <?php
            $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
            echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
        ?>
        <!-- TOTAL ORDERS PER MONTH -->
        <?php
            $query1 = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS appointment FROM appointment GROUP BY MONTH(date), YEAR(date) ORDER BY month;";
            $result1 = mysqli_query($conn, $query1);

            foreach($result1 as $data1){
                $month[] = $data1['month'];
                $appointment[] = $data1['appointment'];
            }
        ?>
        <div class="barchart1 ps-5 ms-5" style="height: 300px; width: 400px;">
            <canvas id="myChart1"></canvas>
        </div>

        <!-- MOST SOLD CATEGORY -->
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
        <div class="barchart2 p-5" style="height: 36%; width: 44%;">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    <?php
        require_once 'scripts.php';
    ?>