<?php
    session_start();
    require_once '../includes/db.inc.php';
    if(isset($_SESSION['user_id'])){
        $user_id_session = $_SESSION['user_id'];
        $username_session = $_SESSION['username'];
        $role_session = $_SESSION['user_role_id'];

        if(($role_session !== 1)) {
            header('location: login.php?error=accessdenied');
            die();
        }elseif($role_session === 2) {
        }
    }else{
        header('location: login.php');
        die();
    }