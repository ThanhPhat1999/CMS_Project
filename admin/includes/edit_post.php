<?php
    if(isset($_GET['p_id']))
    {
        $the_post_id = escape($_GET['p_id']);
    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id            =   $row['post_id'];
        $post_author        =   $row['post_author'];
        $post_user          =   $row['post_user']; 
        $post_title         =   $row['post_title'];
        $post_category_id   =   $row['post_category_id'];
        $post_status        =   $row['post_status'];
        $post_image         =   $row['post_image'];
        $post_tags          =   $row['post_tags'];
        $post_comment_count =   $row['post_comment_count'];
        $post_date          =   $row['post_date'];
        $post_content       =   $row['post_content'];
    }

    if(isset($_POST['update_post']))
    {
        $post_title         =   escape($_POST['post_title']);
        $post_category_id   =   escape($_POST['post_category']);
        $post_user          =   escape($_POST['post_user']);
        $post_status        =   escape($_POST['post_status']);

        $post_image         =   escape($_FILES['image']['name']);
        $post_image_temp    =   escape($_FILES['image']['tmp_name']);

        $post_tags          =   escape($_POST['post_tags']);
        $post_content       =   escape($_POST['post_content']);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image))
        {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image))
            {
                $post_image = $row['post_image'];
            }
        }

        $query  = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_user = '{$post_user}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_date = now(), ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$the_post_id} ";   

        $update_post = mysqli_query($connection, $query);
        comfirmQuery($update_post);

        echo "<p class='bg-success'>Edit Success: <a href='../post.php?p_id=$the_post_id'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" value="<?php if(isset($post_title)){ echo $post_title; }?>" name="post_title"
            class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <select name="post_category" id="" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories))
                {
                    $cat_id     = $row['cat_id'];
                    $cat_title  = $row['cat_title'];

                    if($cat_id == $post_category_id)
                    {
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    }
                    else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }   
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_user">Post Author</label>
        <select name="post_user" id="">
            <?php
                $query = "SELECT * FROM users";
                $select_user_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_user_query))
                {
                    $user_id        =       $row['user_id'];
                    $username       =       $row['username'];

                    echo "<option value='{$username}'>{$username}</option>";
                }
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="" class="form-control">
            <option value="<?php if(isset($post_status)){ echo $post_status; }?>"><?php echo $post_status?></option>
            <?php
                if($post_status == 'publish')
                {
                    echo "<option value='draft'>draft</option>";
                }
                else {
                    echo "<option value='publish'>publish</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src="../images/<?php if(isset($post_image)){ echo $post_image; }?>" width="100">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php if(isset($post_tags)){ echo $post_tags; }?>" name="post_tags"
            class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" rows="10" cols="30">
            <?php if(isset($post_content)){ echo $post_content; }?>
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="update_post" value="Update Post" class="btn btn-warning">
    </div>
</form>