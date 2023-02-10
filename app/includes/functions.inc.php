<?php
    function firstnameEmpty($first_name) {
        $result;

        if(empty($first_name)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function firstnameInvalid($first_name) {
        $result;
        $first_name_length = strlen($first_name);

        if((!preg_match("/^[a-zA-Z ,.'-]+$/i", $first_name)) || ($first_name_length < 2)) {
            $result = true;  
        } else {
            $result = false;
        }
        return $result;
    }

    function lastnameEmpty($last_name) {
        $result;

        if(empty($last_name)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function lastnameInvalid($last_name) {
        $result;
        $last_name_length = strlen($last_name);

        if((!preg_match("/^[a-zA-Z ,.'-]+$/i", $last_name)) || ($last_name_length < 2)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function usernameEmpty($username) {
        $result;

        if(empty($username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function usernameInvalid($username) {
        $result;
        $username_length = strlen($username);

        if($username_length < 6) {
            $result = true;
        } elseif($username_length > 18) {
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }


    function isRealDate($date) { 
        if(false === strtotime($date)) { 
            return false;
        } 
        list($day, $month, $year) = explode('-', $date); 
        return checkdate($day, $month, $year);
    }


    function birthdateEmpty($birthdate) {
        $result;

        if(empty($birthdate)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function birthdateInvalid($birthdate) {
        $result;

        if(isRealDate($birthdate)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function genderEmpty($gender) {
        $result;

        if($gender == 'none') {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function addressEmpty($address) {
        $result;

        if(empty($address)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function addressInvalid($address) {
        $result;
        $addressLength = strlen($address);

        if ($addressLength < 10) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function emailEmpty($email) {
        $result;

        if(empty($email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function emailInvalid($email) {
        $result;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function phoneEmpty($phone_number) {
        $result;

        if(empty($phone_number)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function phoneInvalid($phone_number) {
        $result;

        if (!preg_match("/((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/", $phone_number)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordEmpty($password) {
        $result;

        if(empty($password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordInvalid($password) {
        $result;
        $password_length = strlen($password);

        if($password_length < 8) {
            $result = true;
        } elseif($password_length > 16) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordRepeatEmpty($repeat_password) {
        $result;

        if(empty($repeat_password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordRepeatInvalid($repeat_password) {
        $result;
        $repeat_password_length = strlen($repeat_password);

        if($repeat_password_length < 8) {
            $result = true;
        } elseif($repeat_password_length > 16) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordMatch($password, $repeat_password) {
        $result;

        if($password !== $repeat_password) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

	function usernameExists($conn, $username) {
        $sql = "SELECT * FROM user WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.php?error");
            die();
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
	
    function emailExists($conn, $email) {
        $sql = "SELECT * FROM user_info WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../register.php?error");
            die();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $username, $password, $vkey, $email, $first_name, $last_name) {

        $sql_user = "INSERT INTO user (username, password, verification_key) VALUES (?, ?, ?);";

        $stmt_user = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt_user, $sql_user)) {
            header("location: ../register.php?error");
            die();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt_user, "sss", $username, $hashedPassword, $vkey);

        mysqli_stmt_execute($stmt_user);

        mysqli_stmt_close($stmt_user);


        $sql_user_info = "INSERT INTO user_info (user_id, email, first_name, last_name) VALUES (?, ?, ?, ?);";

        $stmt_user_info = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt_user_info, $sql_user_info)) {
            header("location: ../register.php?error");
            die();
        }

        $user_id = mysqli_insert_id($conn);

        mysqli_stmt_bind_param($stmt_user_info, "isss", $user_id, $email, $first_name, $last_name);

        mysqli_stmt_execute($stmt_user_info);

        mysqli_stmt_close($stmt_user_info);

        //header("location: login.php?accountsuccessfullycreated");
        //die();
    }

    function emptyInputLogin($email, $password) {
        $result;

        if(empty($email) || empty($password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $email, $password) {
        $emailExists = emailExists($conn, $email);

        if($emailExists === false) {
            header("location: login.php?error=invalidemail");
            die();
        }
         
        $passwordHashed = $emailExists["password"];

        $checkPassword = password_verify($password, $passwordHashed);

        if($checkPassword === false) {
            header("location: login.php?error=invalidpassword");
            die();
        } elseif($checkPassword === true) {
            
            $query = "SELECT * FROM users WHERE user_id = '" .$emailExists['user_id']. "' AND email = '" .$emailExists['email']. "' AND is_verified = 1;";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            if($count === 1) {    
                session_start();
                $_SESSION['id'] = $emailExists['user_id'];
                $_SESSION['email'] = $emailExists['email'];
                $_SESSION['user_role_id'] = $emailExists['user_role_id'];

                $query = "UPDATE users SET last_login = NOW() WHERE user_id = '" .$emailExists['user_id']. "' AND email = '" .$emailExists['email']. "';";
                $result = mysqli_query($conn, $query);

                header("location: index.php");
                die();
            } else {
                header("location: login.php?error=emailnotverifiedyet");
                die();
            }
            
        }
    }