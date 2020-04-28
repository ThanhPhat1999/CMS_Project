<?php
    if(isset($_POST['create_post']))
    {
        $post_title         =   escape($_POST['post_title']);
        $post_category_id   =   escape($_POST['post_category']);
        $post_user          =   escape($_POST['post_user']);
        $post_status        =   escape($_POST['post_status']);

        $post_image         =   escape($_FILES['image']['name']);
        $post_image_temp    =   escape($_FILES['image']['tmp_name']);

        $post_tags          =   escape($_POST['post_tags']);
        $post_content       =   escape($_POST['post_content']);
        $post_date          =   escape(date('d-m-y'));
        $post_comment_count =   0;
        $post_views_count   =   0;

        move_uploaded_file($post_image_temp, "../images/$post_image"); //di chuyển hình ảnh từ biến tạm sang biến $post_image

        $query  = "INSERT INTO posts(post_category_id, post_user, post_title, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_views_count) ";
        $query .= "VALUES({$post_category_id}, '{$post_user}', '{$post_title}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}', {$post_views_count})";

        $create_post_query = mysqli_query($connection, $query);

        comfirmQuery($create_post_query);

        echo "<p class='bg-success'>Add Success: <a href='posts.php'>View Posts</a></p>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category Title</label>
        <select name="post_category" id="" class="form-control">
            <option value="">Select Options</option>
            <?php
                $query = "SELECT * FROM categories";
                $select_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories_query))
                {
                    $cat_id     =   $row['cat_id'];
                    $cat_title  =   $row['cat_title'];

                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_user">Post Author</label>
        <select name="post_user" id="" class="form-control">
            <?php
                $query = "SELECT * FROM users";
                $select_users_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_users_query))
                {
                    $user_id    =    $row['user_id'];
                    $username   =    $row['username'];

                    echo "<option value='{$username}'>{$username}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" rows="40" cols="30"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
    </div>
</form>