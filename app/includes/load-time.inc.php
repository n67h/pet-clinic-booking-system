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
        $sql = "SELECT * FROM timeslot AS ts 
        WHERE NOT EXISTS 
        ( SELECT * FROM appointment AS a 
        WHERE ts.timeslot = a.timeslot AND a.date = '$date')
        AND ts.service_id = '" .$_POST['serviceID']. "' AND is_deleted != 1;";
        
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
                

                // SELECT 
                // timeslot.*
                // FROM timeslot
                // LEFT JOIN appointment ON (
                // appointment.timeslot= timeslot.timeslot AND date = '2023-03-13'
                // ) 
                // WHERE timeslot.service_id = 1


                // SELECT            a.*
                // FROM              tbl_1 a
                // NATURAL LEFT JOIN tbl_2 b
                // WHERE             b.FirstName IS NULL

                // SELECT *
                // FROM Table1 AS a
                // WHERE NOT EXISTS (
                // SELECT *
                // FROM Table2 AS b 
                // WHERE a.FirstName=b.FirstName AND a.LastName=b.Last_Name
                // )

                // SELECT * FROM timeslot AS ts 
                // WHERE NOT EXISTS 
                // ( SELECT * FROM appointment AS a 
                // WHERE ts.timeslot = a.timeslot AND a.date = "2023-03-13" AND ts.service_id = 1 AND a.service_id = 1);




                // fuck yeah
                //SELECT * FROM timeslot AS ts 
                //WHERE NOT EXISTS 
                //( SELECT * FROM appointment AS a 
                //WHERE ts.timeslot = a.timeslot AND a.date = "2023-03-13" AND ts.service_id = 1)
                //AND ts.service_id = 1 AND is_deleted != 1;
                $output .= '<option value="' .$timeslot. '">' .$timeslot. '</option>';
            }
        }else{
            $output .= '<option value="default_time" disabled selected>-- Select timeslot --</option>';
            $output .= '<option value="8:00AM - 9:00AM">8:00AM - 9:00AM</option>';
            $output .= '<option value="9:00AM - 10:00AM">9:00AM - 10:00AM</option>';
            $output .= '<option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>';
            $output .= '<option value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>';
            $output .= '<option value="1:00PM - 2:00PM">1:00PM - 2:00PM</option>';
            $output .= '<option value="2:00PM - 3:00PM">2:00PM - 3:00PM</option>';
            $output .= '<option value="3:00PM - 4:00PM">3:00PM - 4:00PM</option>';
            $output .= '<option value="4:00PM - 5:00PM">4:00PM - 5:00PM</option>';
        }
    }else{
        $output .= '<option value="default_time" disabled selected>-- Select timeslot --</option>';
        $output .= '<option value="8:00AM - 9:00AM">8:00AM - 9:00AM</option>';
        $output .= '<option value="9:00AM - 10:00AM">9:00AM - 10:00AM</option>';
        $output .= '<option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>';
        $output .= '<option value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>';
        $output .= '<option value="1:00PM - 2:00PM">1:00PM - 2:00PM</option>';
        $output .= '<option value="2:00PM - 3:00PM">2:00PM - 3:00PM</option>';
        $output .= '<option value="3:00PM - 4:00PM">3:00PM - 4:00PM</option>';
        $output .= '<option value="4:00PM - 5:00PM">4:00PM - 5:00PM</option>';
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