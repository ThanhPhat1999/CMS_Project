<!-- Bulk Options -->
<?php
    if(isset($_POST['checkBoxArray']))
    {
        foreach($_POST['checkBoxArray'] as $postValueId)
        {
            $bulkOptions = $_POST['bulkOptions'];

            switch($bulkOptions)
            {
                case 'publish':
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postValueId} ";
                    $update_to_publish_status = mysqli_query($connection, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postValueId}";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                    $update_to_delete_status = mysqli_query($connection, $query);
                    break;
            }
        }
    }
?>
<form action="" method="post">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <div id="bulkOptionContainer" class="form-group col-xs-4">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select Options</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-8">
                <input type="submit" name="submit" value="Apply" class="btn btn-success">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <!-- <th>Id</th> -->
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            // Start Pagination
                            $per_page = 6;

                            if(isset($_GET['page']))
                            {
                                $page = $_GET['page'];
                            }
                            else {
                                $page = " ";
                            }

                            if($page == " " || $page == 1)
                            {
                                $page_1 = 0;
                            }
                            else 
                            {
                                $page_1 = ($page * $per_page) - $per_page;
                            }

                            $post_query_count = "SELECT * FROM posts";
                            $find_count = mysqli_query($connection, $post_query_count);
                            $count = mysqli_num_rows($find_count);

                            $count = ceil($count / $per_page);

                            // End Pagination


                            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                            $select_all_posts_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                                $post_id            =   $row['post_id'];
                                $post_author        =   $row['post_author'];
                                $post_title         =   $row['post_title'];
                                $post_category_id   =   $row['post_category_id'];
                                $post_status        =   $row['post_status'];
                                $post_image         =   $row['post_image'];
                                $post_tags          =   $row['post_tags'];
                                $post_comment_count =   $row['post_comment_count'];
                                $post_date          =   $row['post_date'];

                                echo "<tr>";

                                ?>
                                
                                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>

                                <?php
                                // echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                            

                            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                            $select_category_title = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_category_title))
                            {
                                $cat_id     = $row['cat_id'];
                                $cat_title  = $row['cat_title'];
                                
                                echo "<td>{$cat_title}</td>";
                            }
                                echo "<td>{$post_status}</td>";
                                echo "<td><img src='../images/{$post_image}' width='100'/></td>";
                                echo "<td>{$post_tags}</td>";
                                echo "<td>{$post_comment_count}</td>";
                                echo "<td>{$post_date}</td>";
                                echo "<td><a href = '../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a href = 'posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete ?');\" href = 'posts.php?delete={$post_id}'>Delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
                <!-- Delete post -->
                <?php
            if(isset($_GET['delete']))
            {
                $the_post_id = $_GET['delete'];

                $query = "DELETE FROM posts WHERE post_id = {$post_id}";

                $delete_post_query = mysqli_query($connection, $query);

                comfirmQuery($delete_post_query);

                header("Location: posts.php");
            }
        ?>
            </tbody>
        </table>
    </div>

    <!-- Start Pagination -->
    <ul class="pager">
        <?php
            for ($i=1; $i <= $count ; $i++) { 
                if($i == $page)
                {
                    echo "<li><a class='active_link' href='posts.php?page={$i}'>{$i}</a></li>";
                }
                else {
                    echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>";
                }
                
            }
        
        
        
        ?>
        
    </ul>
</form>