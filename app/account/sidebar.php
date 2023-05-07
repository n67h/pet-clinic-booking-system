<!-- start of main container -->
<div class="container mt-4">
        <!-- start of row -->    
        <div class="row">
            <!-- start sidebar -->
            <div class="col-md-3">
                <!-- start of sidebar nav -->
                <nav class="nav flex-column">
                    <!-- start of sidebar inner div -->
                    <div class="mb-3">
                        <!-- start of sidebar profile image and name div -->
                        <div class="d-flex mt-3 ps-2 pb-1">
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
                                        if($image == 'profile-pictures/default.png'){
                                            echo '<img class="text-dark rounded-circle" src="../' .$image. '" alt="" style="width: 20%; height: 30%;">';
                                        }else{
                                            echo '<img class="text-dark rounded-circle" src="' .$image. '" alt="" style="width: 20%; height: 30%;">';
                                        }
                                        echo '<li class="px-3 py-2 d-block text-dark"><a href="profile.php" class="text-decoration-none text-dark">' .$firstname. ' ' .$lastname. '</a></li>';
                                    }
                                }
                            ?>
                        </div>
                        <!-- end of sidebar profile image and name div -->
                    </div>
                    <!-- end of sidebar inner div -->
                    <div class="text-dark">
                        <hr class="mx-2">
                    </div>
                    <!-- start of ul for account -->
                    <ul class="list-unstyled px-2">
                        <li class=""><a href="profile.php" class="text-decoration-none ps-0 px-3 py-2 d-block text-dark"><i class="fa-solid fa-user pe-1"></i> My Account</a></li>
                        <!-- start of inner ul for account -->
                        <ul class="list-unstyled px-2">
                            <?php
                                $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                                if($url !== 'localhost/pet-clinic-booking-system/app/account/profile.php'){
                                    echo '<li class=""><a href="profile.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark"> Profile</a></li>';
                                }else{
                                    echo '<li class=""><a href="profile.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark bg-info rounded"> Profile</a></li>';
                                }
                                if($url !== 'localhost/pet-clinic-booking-system/app/account/pet.php'){
                                    echo '<li class=""><a href="pet.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark"> My Pets</a></li>';
                                }else{
                                    echo '<li class=""><a href="pet.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark bg-info rounded"> My Pets</a></li>';
                                }

                                if($url !== 'localhost/pet-clinic-booking-system/app/account/appointment.php'){
                                    echo '<li class=""><a href="appointment.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark"> Appointments</a></li>';
                                }else{
                                    echo '<li class=""><a href="appointment.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark bg-info rounded"> Appointments</a></li>';
                                }

                                if($url !== 'localhost/pet-clinic-booking-system/app/account/password.php'){
                                    echo '<li class=""><a href="password.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark"> Change Password</a></li>';
                                }else{
                                    echo '<li class=""><a href="password.php" class="text-decoration-none ps-3 px-3 py-2 d-block text-dark bg-info rounded"> Change Password</a></li>';
                                }
                            ?>
                        </ul>
                        <!-- end of inner ul for account -->
                    </ul>
                    <!-- end of ul for account -->
                    <div class="text-dark">
                        <hr class="mx-2">
                    </div>
                </nav>
                <!-- end of sidebar nav -->
            </div>  
            <!-- end of sidebar -->