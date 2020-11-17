<?php include "includes/admin_header.php"; ?>
<?php include "includes/admin_navigation.php"; ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">

<?php // CREATE CATEGOREIS QUERY
insert_categories();
?>
                        <form action="" method="post">
                        
                        <div class="form-group">
                            <label for="cat-title">Add Category</label>
                            <input type="text" class="form-control" name="cat_name">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                        </form>
                        </div>
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php // VIEW ALL CATEGORIES
view_all_categories();
?>

<?php // DELETE CATEGORY
delete_category();
?>
                          
                            </tbody>
                            </table>
<?php
    if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        include "includes/update_categories.php";
    }
?>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
