<?php
    if(isset($_POST['create_post']))
    {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp, "../images/$post_image"); //di chuyển hình ảnh từ biến tạm sang biết $post_image

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        comfirmQuery($create_post_query);

        header("Location: posts.php");
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">UserName</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subcriber">Subcriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
    </div>
</form>