<?php
    require_once 'db.inc.php';
    $output = '';
    $sql = "SELECT category.category_id, category.category, pet.* FROM category INNER JOIN pet USING (category_id) WHERE pet.is_deleted != 1 AND pet.pet_id = '" .$_POST['petID']. "' LIMIT 1;";
    // $sql = "SELECT category.category_id, category.category, pet.* FROM category INNER JOIN pet USING (category_id) WHERE pet.is_deleted != 1 AND pet.pet_id = 1 LIMIT 1;";
    // $sql = "SELECT * FROM service WHERE category_id = '" .$_POST['categoryID']. "' AND is_deleted != 1;";
    $result = mysqli_query($conn, $sql);
    // $output .= '<option value="default_service" disabled selected>-- Select species --</option>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<option value="' .$row['category_id']. '" selected>' .$row['category']. '</option>';
    }
    echo $output;