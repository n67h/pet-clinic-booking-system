<?php
    require_once 'db.inc.php';
    $output = '';
    $sql = "SELECT * FROM service WHERE category_id = '" .$_POST['categoryID']. "' AND is_deleted != 1;";
    $result = mysqli_query($conn, $sql);
    $output .= '<option value="default_service" disabled selected>-- Select service --</option>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<option value="' .$row['service_id']. '">' .$row['service']. '</option>';
    }
    echo $output;