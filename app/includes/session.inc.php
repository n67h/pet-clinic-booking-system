<?php
    session_start();
    require_once 'db.inc.php';
    if(isset($_SESSION['user_id'])){
        $user_id_session = $_SESSION['user_id'];
        $username_session = $_SESSION['username'];
        $email_session = $_SESSION['email'];
        $user_role_id_session = $_SESSION['user_role_id'];

        if(($user_role_id_session == 1)) {
            header("location: includes/logout.inc.php");
            die();
        }elseif($user_role_id_session === 3) {
        }
    } else {
        // header('location: login.php');
        // die();
    }