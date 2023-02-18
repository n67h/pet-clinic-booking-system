</div>
    </div>
    <!-- end of main container -->

    <!-- js section -->
    <!-- bootstrap js popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- jquery datatable js cdn -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        // $('.sidebar ul li').on('click', function(){
        //     $('.sidebar ul li.active').removeClass('active');
        //     $(this).addClass('active');
        // });

        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });

        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });
    </script>
    <script type="text/javascript">
       $(document).ready( function () {
            $('#datatable').DataTable({
                "responsive": false, 
                "lengthChange": true, 
                "autoWidth": false,
                "searching": true,
                "paging": true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "iDisplayLength": 10,
                "ordering": true,
            });
        } );
    </script>

    <!-- start of script for view modal user-role -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.view', function(event) {

                $('#view_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_user_role_id').val(data[0])
                $('#view_role').val(data[1]);
                $('#view_user_role').val(data[2]);
                $('#view_user').val(data[3]);
                $('#view_category').val(data[4]);
                $('#view_product').val(data[5]);
                $('#view_order').val(data[6]);
                $('#view_shipping_fee').val(data[7]);
                $('#view_message').val(data[8]);
                $('#view_feedback').val(data[9]);
                $('#view_chatbot').val(data[10]);
                $('#view_log').val(data[11]);
                $('#view_settings').val(data[12]);
                
            });
        });
    </script>
    <!-- end of script for view modal user-role -->

    <!-- start of script for edit modal user-role -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.edit', function(event) {

                $('#edit_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_user_role_id').val(data[0])
                $('#edit_role').val(data[1]);
                $('#edit_user_role').val(data[2]);
                $('#edit_user').val(data[3]);
                $('#edit_category').val(data[4]);
                $('#edit_product').val(data[5]);
                $('#edit_order').val(data[6]);
                $('#edit_shipping_fee').val(data[7]);
                $('#edit_message').val(data[8]);
                $('#edit_feedback').val(data[9]);
                $('#edit_chatbot').val(data[10]);
                $('#edit_log').val(data[11]);
                $('#edit_settings').val(data[12]);
                
            });
        });
    </script>
    <!-- end of script for edit modal user-role -->

    <!-- start of script for delete modal user-role -->
    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete', function(event) {

                $('#delete_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_user_role_id').val(data[0]);

            });
        });
    </script>
    <!-- end of script for delete modal user-role -->
</body>
</html>