    <!-- google font / lobster -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- latest bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <?php
        // get the current url
        $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        // parse url
        $parts = parse_url($url);
        // get the 'account' folder path in url
        $path_parts= explode('/', $parts['path']);
        $path = $path_parts[2];
        // check if the url is currently in account folder
        if($path !== 'account'){
            echo '<link rel="stylesheet" href="../resources/css/style.css">';
        }else{
            echo '<link rel="stylesheet" href="../../resources/css/style.css">';
        }
    ?>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<!-- start of body tag -->
<body>
    <!-- start of navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <!-- start of navbar main container -->
        <div class="container-fluid">    
            <!-- start of navbar text logo -->
            <a class="navbar-brand text-white" href="index.php"><span class="logo1">Veterinary</span> <span class="logo2">Clinic</span></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-dark"></span>
            </button>
            <!-- end of navbar text logo -->
            <!-- start of div for middle part of navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- start of div for nav links -->
                <div class="mx-auto">
                    <!-- start of ul for nav links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item d-flex justify-content-end">
                            <a class="nav-link active dropdown-item text-white link-info fs-5 text-center" aria-current="page" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-item text-white link-info fs-5 text-center" href="calendar.php">Book</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-item text-white link-info fs-5 text-center" href="index.php#services">Services</a>
                        </li>
                                        
                        <li class="nav-item">
                            <a class="nav-link dropdown-item text-white link-info fs-5 text-center" href="#">Contact Us</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link dropdown-item text-white" href="#">About</a>
                        </li> -->
                        <li class="nav-item dropdown">    
                            <?php
                                // check if user is logged in
                                if(!isset($_SESSION['user_id'])){
                            ?>
                                    <!-- if not logged in display these codes below -->
                                    <a class="nav-link dropdown-toggle text-white link-info fs-5 text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                            <li><a href="login.php" class="dropdown-item text-white link-info account">Login</a></li>
                                            <li><a href="register.php" class="dropdown-item text-white link-info account">Register</a></li> 
                                        </ul>
                            <?php
                                }else{
                                    // otherwise, fetch the fname and lname from db and display it instead
                                    $sql = "SELECT * FROM user_info WHERE user_id = $user_id_session;";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $first_name = $row['first_name'];
                                            $last_name = $row['last_name'];
                                        }
                                    }
                            ?>
                                    <!-- change the content under the account dropdown if user is logged in -->
                                            <?php
                                                if($path !== 'account'){
                                            ?>
                                                    <a class="nav-link dropdown-toggle text-white link-info fs-5 text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $first_name. ' ' .$last_name; ?></a>
                                                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                                            <li><a href="account/profile.php" class="dropdown-item text-white link-info account">My Account</a></li>
                                                            <li><a href="#" class="dropdown-item text-white link-info account">My Appointments</a></li>
                                                            <li><a href="includes/logout.inc.php" class="dropdown-item text-white link-info account">Log out</a></li>
                                            <?php
                                                }else{
                                            ?>
                                                    <a class="nav-link dropdown-toggle text-info link-info fs-5 text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $first_name. ' ' .$last_name; ?></a>
                                                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                                            <li><a href="profile.php" class="dropdown-item text-white link-info account">My Account</a></li>
                                                            <li><a href="../purchase.php" class="dropdown-item text-white link-info account">My Purchase</a></li>
                                                            <li><a href="../includes/logout.inc.php" class="dropdown-item text-white link-info account">Log out</a></li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                    <!-- end of ul for nav links -->
                </div>
                <!-- end of div for nav links -->
                <!-- start of search bar -->
                <form class="d-flex" role="search">
                    <input class="form-control me-0 rounded-0" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary rounded-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
                <!-- end of search bar -->
            </div>
            <!-- end of div for middle part of navbar -->
        </div>
        <!-- end of navbar main container -->
    </nav>
    <!-- end of navbar -->