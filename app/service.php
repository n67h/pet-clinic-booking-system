<?php
    require_once 'includes/session.inc.php';
    require_once 'includes/db.inc.php';
    require_once 'includes/functions.inc.php';
    ob_start();

    if(isset($_GET['category_id'])){
        $cat_id = $_GET['category_id'];
    }else{
        header('location: index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php
        require_once 'header.php';
    ?>
    <br><br>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <?php
                            $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                            $sql = "SELECT * FROM category WHERE is_deleted != 1;";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $category_id = $row['category_id'];
                                    $category = $row['category'];


                                    if($url !== 'localhost/pet-clinic-booking-system/app/service.php?category_id=' .$category_id){
                                        echo '<li class="nav-item">
                                        <a class="nav-link bg-light text-dark" href="service.php?category_id=' .$category_id. '">' .$category. '</a>
                                    </li>';
                                    }else{
                                        echo '<li class="nav-item">
                                        <a class="nav-link active bg-light text-dark border" href="service.php?category_id=' .$category_id. '">' .$category. '</a>';
                                    }
                                }
                            }else{

                            }
                        ?>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- start of cards -->
                    <div class="container-md me-auto mb-auto pe-auto pb-5 pt-5" id="services">
                        <!-- start of cards inner container -->
                        <div class="container text-center">
                            <!-- start of cards div row -->
                            <div class="row">
                                <?php
                                    // echo $cat_id;
                                    $sql = "SELECT * FROM service WHERE category_id = $cat_id AND is_deleted != 1 ORDER BY service_id DESC;";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $service = $row['service'];
                                            $description = $row['description'];
                                ?>
                                            <!-- display all cards -->
                                            <div class="col-sm-4 mb-4">
                                                <div class="card services">
                                                    <div class="card-body border">
                                                        <h1 class="card-title"><i class="fa-solid fa-syringe"></i></h1>
                                                        <p class="card-text fw-bold"><?= $service; ?></p>
                                                        <p class="card-text fs-6"><?= $description; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }else{
                                        echo '<h1 class="card-title p-5">There\'s no available service.</h1>';
                                    }
                                ?>
                            </div>
                            <!-- end of cards div row -->
                        </div>  
                        <!-- end of cards inner container -->
                    </div> 
                    <!-- end of cards -->
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>

    <br><br>
    <?php
        require_once 'footer.php';
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>