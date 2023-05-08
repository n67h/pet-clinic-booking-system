<?php
    require_once 'includes/session.inc.php';
?>
    <!-- favicon -->
    <link rel="icon" href="../../resources/images/favicon.ico" type="image/x-icon">
    <!-- jquery datatable css cdn -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../../resources/css/style.css">
    <!-- cdn of chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- start of main container -->
    <div class="main-container d-flex">
        <!-- start of sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="header-box px-2 pt-3 pb-2 d-flex justify-content-between">
                <?php
                    if(isset($_SESSION['user_id'])){
                        $sql_role = "SELECT user.user_role_id, user_role.user_role_id, user_role.role FROM user_role INNER JOIN user USING (user_role_id) WHERE user_id = $user_id_session;";
                        $result_role = mysqli_query($conn, $sql_role);
                        if(mysqli_num_rows($result_role) > 0){
                            while($row_role = mysqli_fetch_assoc($result_role)){
                                $role = $row_role['role'];
                            }
                            echo '<h1 class="fs-4"><a href="dashboard.php" class="text-decoration-none"><span class="bg-white text-dark rounded shadow px-2 me-2 p-1">Veterenary</span><span class="text-white">Clinic</span></a></h1>';
                        }
                    }
                ?>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <div class="d-flex mt-1 ps-2 pb-1">
                    <?php
                        if(isset($_SESSION['user_id'])){
                            $sql = "SELECT user.user_id, user_info.user_id, user_info.first_name, user_info.last_name, user_info.image FROM user_info INNER JOIN user USING (user_id) WHERE user_id = $user_id_session;";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $firstname = $row['first_name'];
                                    $lastname = $row['last_name'];
                                    $image = $row['image'];
                                }
                                echo '<img class="text-white rounded-circle" src="../' .$image. '" alt="" style="width: 20%; height: 30%;">';
                                echo '<li class="px-3 py-2 d-block text-white">' .$firstname. ' ' .$lastname. '</li>';
                            }
                        }
                    ?>
                    
                </div>
                <div class="text-white">
                    <hr class="mx-2">
                </div>
                <?php
                    $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/dashboard.php'){
                        echo '<li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a></li>';
                    }else{
                        echo '<li class="active"><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a></li>';
                    }

                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/user.php'){
                        echo '<li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i> Users</a></li>';
                    }else{
                        echo '<li class="active"><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i> Users</a></li>';
                    }

                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/appointment.php'){
                        echo '<li class=""><a href="appointment.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-regular fa-calendar-days"></i></i> Appointments</a></li>';
                    }else{
                        echo '<li class="active"><a href="appointment.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-regular fa-calendar-days"></i></i> Appointments</a></li>';
                    }

                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/category.php'){
                        echo '<li class=""><a href="category.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-dog"></i> Categories</a></li>';
                    }else{
                        echo '<li class="active"><a href="category.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-dog"></i> Categories</a></li>';
                    }

                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/service.php'){
                        echo '<li class=""><a href="service.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-syringe"></i> Services</a></li>';
                    }else{
                        echo '<li class="active"><a href="service.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-syringe"></i> Services</a></li>';
                    }

                    echo '
                        <div class="text-white">
                            <hr class="mx-2">
                        </div>
                    ';
                ?>
            </ul>
            <ul class="list-unstyled px-2">
                <li class=""><a href="includes/logout.inc.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </div>
        <!-- end of sidebar -->

        <div class="content">
            <!-- start of navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <a class="navbar-brand fs-4" href="#">Online Shop</a>
                        <button class="btn px-1 py-0 open-btn"><i class="fa-solid fa-bars-staggered"></i></button>
                    </div>
                    
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        if(isset($_SESSION['user_id'])){
                                            $sql = "SELECT user.user_id, user_info.user_id, user_info.first_name, user_info.last_name FROM user_info INNER JOIN user USING (user_id) WHERE user_id = $user_id_session;";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $firstname = $row['first_name'];
                                                    $lastname = $row['last_name'];
                                                }
                                                echo $firstname. ' ' .$lastname;
                                            }
                                        }
                                    ?>
                                </a>
                                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item bg-dark text-white admin-dropdown" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item bg-dark text-white admin-dropdown" href="change-password.php">Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item bg-dark text-white admin-dropdown" href="includes/logout.inc.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- end of navbar -->