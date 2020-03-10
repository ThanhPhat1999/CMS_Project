<form action="" method="post">

    <!-- Edit -->
    <?php
                                    if(isset($_GET['edit']))
                                    {
                                        $cate_id = $_GET['edit'];

                                        $query = "SELECT * FROM categories WHERE cat_id = $cate_id ";

                                        $select_cate_edit_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_cate_edit_query))
                                        {
                                            $cat_id     = $row['cat_id'];
                                            $cat_title  = $row['cat_title'];
                                        ?>
    <div class="form-group">
        <label for="cat_title">Edit Categories</label>
        <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" name="cat_title"
            class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="update" value="Edit" class="btn btn-warning">
    </div>
    <?php }}?>
    <?php
                                if(isset($_POST['update']))
                                {
                                    $the_cate_title = $_POST['cat_title'];
                                    $query  = "UPDATE categories SET cat_title = '{$the_cate_title}' ";
                                    $query .= "WHERE cat_id = {$cate_id}";

                                    $update_query = mysqli_query($connection, $query);
                                    if(!$update_query)
                                    {
                                        die('Query Failed' .mysqli_error());
                                    }
                                    header("Location: categories.php");
                                }
                            ?>
</form>