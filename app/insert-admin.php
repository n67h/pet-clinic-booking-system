<?php
    require_once 'includes/db.inc.php';

    $username = 'admin';
    $password = 'admin';
    $user_role_id = 1;
    $verification_key = 'N/A';
    $is_verified = 1;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, password, user_role_id, verification_key, is_verified) VALUES ('$username', '$hashed_password', $user_role_id, '$verification_key', $is_verified);";

    if(mysqli_query($conn, $sql)){
        echo 'success';
    }else {
        echo 'failed';
    }