<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_POST['cancel'])){
        $cancel_appointment_id = mysqli_real_escape_string($conn, $_POST['cancel_appointment_id']);

        $sql = "UPDATE appointment SET status = 2 WHERE appointment_id = $cancel_appointment_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../account/appointment.php");
            die();
        }
    }else{
        header("location: ../account/appointment.php");
        die();
    }