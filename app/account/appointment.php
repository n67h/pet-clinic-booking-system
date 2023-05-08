<?php
    require_once '../includes/session.inc.php';
    if(!isset($_SESSION['user_id'])){
        header('location: ../index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <?php
        require_once '../header.php';
        require_once 'sidebar.php';
    ?>
            <!-- start of main content -->
            <div class="col-md-9 bg-white">
                <h5 class="text-dark pt-3 ps-2">My Appointments</h5>
                <p class="text-dark ps-2">Manage your appointments.</p>
                <div class="text-dark">
                    <hr class="mx-2">
                </div>
                <!-- start of first row -->
            <div class="row m-5">
                <!-- start of second container -->
                <div class="container">
                    <!-- start of second row -->
                    <div class="row">
                        <!-- start of div on center -->
                        <div class="col-md-12">
                            <!-- start of table -->
                            <table class="table table-bordered table-striped" id="datatable-appointment">
                                <!-- start of table header -->
                                <thead>
                                    <tr>
                                        <th class="table-light text-uppercase">category id</th>
                                        <th class="table-light text-uppercase">category</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT * FROM category WHERE is_deleted != 1 ORDER BY category_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $category_id = $row_select['category_id'];
                                            $category = $row_select['category'];
                                            $category_date_added = $row_select['date_added'];
                                            $category_last_updated = $row_select['last_updated'];
                                ?>
                                            <tr>
                                                <td class="text-center"><?= $category_id ?></td>
                                                <td class="text-center"><?= $category ?></td>
                                                <td class="text-center"><?= $category_date_added ?></td>
                                                <td class="text-center"><?= $category_last_updated ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_category_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_category_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_category_modal"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="10" class="text-center">No records found.</td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                <!-- end of table body -->
                            </table>
                            <!-- end of table -->
                        </div>
                        <!-- end of div on center -->
                    </div>
                    <!-- end of second row -->
                </div>
                <!-- end of second container -->
            </div>
            <!-- end of first row -->
            </div>
            <!-- end of main content -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of sidebar main container -->
    <br><br><br><br>
    <?php
        require_once '../footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>