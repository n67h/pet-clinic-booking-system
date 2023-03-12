<?php
    require_once 'db.inc.php';
    if(isset($_GET['date'])){
        $date = $_GET['date'];

    }
    $output = '';
    // date = '" .$_POST['currentDate']. "'
    $sql_appointment = "SELECT * FROM appointment WHERE date = '$date' AND is_deleted != 1;";
    $result_appointment = mysqli_query($conn, $sql_appointment);
    if(mysqli_num_rows($result_appointment) > 0){
        while($row_appointment = mysqli_fetch_assoc($result_appointment)){
            $timeslot_appointment = $row_appointment['timeslot'];
            
        }
        $sql = "SELECT * FROM timeslot WHERE service_id = '" .$_POST['serviceID']. "' AND timeslot != '$timeslot_appointment' AND is_deleted != 1;";
        $result = mysqli_query($conn, $sql);
        $output .= '<option value="default_time" disabled selected>-- Select timeslot --</option>';
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $timeslot_id = $row['timeslot_id'];
                $timeslot = $row['timeslot'];
    
                // $sql_appointment = "SELECT * FROM appointment WHERE timeslot = '$timeslot' AND is_deleted != 1;";
                // $result_appointment = mysqli_query($conn, $sql_appointment);
                // if(mysqli_num_rows($result_appointment) > 0){
                //     while($row_appointment = mysqli_fetch_assoc($result_appointment)){
    
                //         $timeslot_appointment = $row_appointment['timeslot'];
                //         if($timeslot_appointment == $timeslot){
                //             // $output .= '<option value="' .$timeslot_appointment. '" disabled>' .$timeslot_appointment. '</option>';
                            
                //         }
                //     }
                // }
                
                $output .= '<option value="' .$timeslot. '">' .$timeslot. '</option>';
            }
        }
    }
    
    
    echo $output;


    
    // $duration = $timeslot_duration;
    // $cleanup = 0;
    // $start = "08:00";
    // $end = "17:00";

    // function timeslots($duration, $cleanup, $start, $end){
    //     $start = new DateTime($start);
    //     $end = new DateTime($end);
    //     $interval = new DateInteral("PT".$duration."M");
    //     $cleanupInterval = new DateInteral("PT".$cleanup."M");
    //     $slots = array();

    //     for($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)){
    //         $endPeriod = clone $intStart;
    //         $endPeriod->add($interval);
    //         if($endPeriod > $end){
    //             break;
    //         }

    //         $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
    //     }
    //     return $slots;
    // }

    // $timeslots = timeslots($duration, $cleanup, $start, $end);
    // foreach($timeslots as $ts){
    //     $output .= '<option value="' .$ts. '">' .$ts. '</option>';
    // }