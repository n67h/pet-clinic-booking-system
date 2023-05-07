<!-- start of edit pet modal -->
<div class="modal fade" id="edit_pet<?= $pet_id ?>">
    <!-- start of edit modal dialog -->
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- start of edit modal content -->
        <div class="modal-content">
            <!-- start of modal header -->
            <div class="modal-header bg-dark border-0">
                <h4 class="modal-title text-white">Edit pet</h4>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <!-- end of modal header -->
            <!-- start of edit modal form -->
            <form action="includes/edit-pet.inc.php?id=<?= $pet_id ?>" method="post" enctype="multipart/form-data">
                <!-- start of edit modal body -->                
                <div class="modal-body">
                    <!-- start of edit modal row -->
                    <div class="row">
                        <!-- start of edit modal col -->
                        <div class="col-md-12">
                            <!-- start of edit modal card -->
                            <div class="card card-primary">
                                <!-- start of edit modal card body -->
                                <div class="card-body">
                                    <!-- start of edit modal row -->
                                    <div class="row">
                                        <div class="col-md-4 col-6 mt-2 mb-2">
                                            <div class="form-group">
                                                <label for="edit_category<?= $pet_id ?>" class="ps-2 pb-2 fs-4">Species</label>
                                                <select class="form-select" aria-label="Default select example" name="edit_category" id="edit_category<?= $pet_id ?>" required>
                                                    <option selected disabled>-- Select species --</option>
                                                        <?php
                                                            $sql_category = "SELECT * FROM category WHERE is_deleted != 1;";
                                                            $result_category = mysqli_query($conn, $sql_category);
                                                            if(mysqli_num_rows($result_category) > 0) {
                                                                while($row_category = mysqli_fetch_assoc($result_category)){
                                                                    $category_id = $row_category['category_id'];
                                                                    $category = $row_category['category'];
                                                                    echo '<option value="' .$category_id. '">' .$category. '</option>';
                                                                }
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 mt-2 mb-2">
                                            <div class="form-group">
                                                <label for="edit_pet_name<?= $pet_id ?>" class="ps-2 pb-2 fs-4">Name</label>
                                                <input type="text" class="form-control" name="edit_pet_name" id="edit_pet_name<?= $pet_id ?>" value="<?= $pet_name ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 mt-2 mb-2">
                                            <div class="form-group">
                                                <label for="edit_birthdate<?= $pet_id ?>" class="ps-2 pb-2 fs-4">Birthdate</label>
                                                <input type="date" class="form-control" name="edit_birthdate" id="edit_birthdate<?= $pet_id ?>" value="<?= $birthdate ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-6 mt-2 mb-2">
                                            <div class="form-group">
                                                <label for="edit_gender<?= $pet_id ?>" class="ps-2 pb-2 fs-4">Species</label>
                                                <select class="form-select" aria-label="Default select example" name="edit_gender" id="edit_gender<?= $pet_id ?>" required>
                                                        <?php 
                                                            if($gender == 'Male'){
                                                                echo '<option value="Male" selected>Male</option>';
                                                                echo '<option value="Female">Female</option>;';
                                                            }elseif($gender == 'Female'){
                                                                echo '<option value="Female" selected>Female</option>;';
                                                                echo '<option value="Male">Male</option>';
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 mt-2 mb-2">
                                            <div class="mb-3">
                                                <label for="pet_image<?= $pet_id ?>" class="form-label fs-4">Pet Image</label>
                                                <input class="form-control" type="file" id="pet_image<?= $pet_id ?>" name="pet_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of edit modal row -->
                                </div>
                                <!-- end of edit modal card body -->
                                <!-- start of edit modal footer -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit" class="btn btn-success">Save Changes</button>
                                </div>
                                <!-- end of edit modal footer -->
                            </div>
                            <!-- end of edit modal card -->
                        </div>
                        <!-- end of edit modal col -->
                    </div>
                    <!-- end of edit modal row -->
                </div>
                <!-- end of edit modal body -->                
            </form>
            <!-- end of edit modal form -->
        </div>
        <!-- end of edit modal content -->
    </div>
    <!-- end of edit modal dialog -->
</div>
<!-- end of edit pet modal -->