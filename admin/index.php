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
                            <?php
                                if(isset($_POST['submit']))
                                {
                                    $cat_title = $_POST['cat_title'];

                                    if($cat_title == "" || empty($cat_title))
                                    {
                                        echo "This field should not be empty";
                                    }
                                    else {
                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUES('$cat_title')";

                                        $insert_cat_query = mysqli_query($connection, $query);

                                        if(!$insert_cat_query){
                                            die('Query Failed' .mysqli_error());
                                        }
                                    }
                                }
                            ?>
                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Categories</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add" class="btn btn-primary">
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table_bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <?php
                            $query = "SELECT * FROM categories ";
                            $select_all_cat_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_cat_query))
                            {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $cat_id?></td>
                                        <td><?php echo $cat_title?></td>
                                    </tr>
                                </tbody>

                                <?php }?>
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