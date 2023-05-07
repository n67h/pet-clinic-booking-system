<!-- start of delete pet modal -->
<div class="modal fade" id="delete_pet<?= $pet_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete category</h1>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
            </div>
            <!-- start of delete modal form -->
            <form action="includes/delete-category.inc.php" method="post">
                <!-- start of delete modal body -->                
                <div class="modal-body">
                    <!-- start of delete modal row -->
                    <div class="row">
                        <!-- start of delete modal col -->
                        <div class="col-md-12">
                            <!-- start of delete modal card -->
                            <div class="card card-primary">
                                <!-- start of delete modal card body -->
                                <div class="card-body">
                                    <!-- start of delete modal row -->
                                    <div class="row">
                                        <div class="col-md-12 col-12 mt-3">
                                            <div class="form-group">
                                                <input type="hidden" name="delete_category_id" id="delete_category_id" class="form-control mb-3">
                                                <h3>Are you sure you want to delete this category?</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of delete modal row -->
                                </div>
                                <!-- end of delete modal card body -->
                                <!-- start of delete modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">No</button>
                                    <button type="submit" name="delete" class="btn btn-danger btn-lg">Yes</button>
                                </div>
                                <!-- end of delete modal footer -->
                            </div>
                            <!-- end of delete modal card -->
                        </div>
                        <!-- end of delete modal col -->
                    </div>
                    <!-- end of delete modal row -->
                </div>
                <!-- end of delete modal body -->                
            </form>
            <!-- end of delete modal form -->
        </div>
    </div>
</div>
<!-- end of delete pet modal -->