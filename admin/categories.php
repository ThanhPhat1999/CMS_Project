<?php include "includes/header.php"?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <div class="col-sm-6">
                        <!-- Add Categories -->
                        <?php
                            insert_categories();    
                        ?>
                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Categories</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add" class="btn btn-primary">
                            </div>
                        </form>
                        
                        <!-- Update Categories -->
                        <?php 
                            // if(isset($_GET['edit']))
                            // {
                            //     $cat_id = $_GET['edit'];
                            //     include "includes/update_categories.php";
                            // }
                            include "includes/update_categories.php";
                        ?>
                    </div>

                    <div class="col-sm-6">
                        <table class="table table-bordered table-hover">
                            <thead class="center">
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Read Information Categories
                                    read_categories();
                                    // Delete Categories
                                    delete_categories();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- /#wrapper -->
    <?php include "includes/footer.php"?>