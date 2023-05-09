<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['cancel'])){
        $delete_ua_appointment_id = mysqli_real_escape_string($conn, $_POST['delete_ua_appointment_id']);

        $sql = "UPDATE appointment SET status = 2 WHERE appointment_id = $delete_ua_appointment_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../appointment.php?status=waiting");
            die();
        }

    }else{
        header("location: ../appointment.php?status=waiting");
        die();
    }