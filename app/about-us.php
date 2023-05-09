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

    

    <br><br>
    <?php
        require_once 'footer.php';
        ob_end_flush();
    ?>
</body>
<!-- end of body tag -->
</html>