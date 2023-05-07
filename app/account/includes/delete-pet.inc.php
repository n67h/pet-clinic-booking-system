<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_GET['id'])){
        $edit_pet_id = $_GET['id'];

        $sql = "UPDATE pet SET is_deleted = 1 WHERE pet_id = $edit_pet_id;";
        if(mysqli_query($conn, $sql)){
            header('location: ../pet.php');
            die();
        }
                        
        echo 'for the love of god, please work ' . $edit_pet_id;
    }