<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Enter UserName" class="form-control">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>


    <?php
                    $query = "SELECT * FROM categories ";
                    $select_categories_query = mysqli_query($connection, $query);       
                ?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4 class="text-center">Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled text-center">
                    <?php
                                while($row = mysqli_fetch_assoc($select_categories_query))
                                {
                                    $cat_id     = $row['cat_id'];
                                    $cat_title  = $row['cat_title'];
                                    
                                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                                }
                            ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"?>

</div>