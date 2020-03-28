<!-- Bulk Options -->
<?php
    include("delete_modal.php");
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

                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                    $select_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($select_posts_query))
                    {
                        $post_title         =   $row['post_title'];
                        $post_categories    =   $row['post_category_id'];
                        $post_author        =   $row['post_author'];
                        $post_image         =   $row['post_image'];
                        $post_content       =   $row['post_content'];
                        $post_tags          =   $row['post_tags'];
                        $post_status        =   $row['post_status'];
                        $post_views_count   =   0;
                    }

                    $query  = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status, post_views_count) ";
                    $query .= "VALUES({$post_categories}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', {$post_views_count})";
                    $copy_query = mysqli_query($connection, $query);

                    if(!$copy_query)
                    {
                        die("Query Failed!" .mysqli_error($connection));
                    }

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
                    <option value="clone">Clone</option>
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
                    <th>Views</th>
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
                                $post_user          =   $row['post_user'];
                                $post_title         =   $row['post_title'];
                                $post_category_id   =   $row['post_category_id'];
                                $post_status        =   $row['post_status'];
                                $post_image         =   $row['post_image'];
                                $post_tags          =   $row['post_tags'];
                                $post_comment_count =   $row['post_comment_count'];
                                $post_date          =   $row['post_date'];
                                $post_views         =   $row['post_views_count'];

                                echo "<tr>";

                                ?>
                                
                                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>

                                <?php
                                
                                echo "<td>{$post_user}</td>";
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

                                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                                $send_comment_query = mysqli_query($connection, $query);
                                $count_comment = mysqli_num_rows($send_comment_query);
                                
                                echo "<td><a href='post_comments.php?id=$post_id'>{$count_comment}</a></td>";
                                echo "<td>{$post_date}</td>";
                                echo "<td><a href = '../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a href = 'posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                echo "<td><a rel='$post_id' class='delete_link' href = 'javascript:void(0)'>Delete</a></td>";
                                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
                                echo "</tr>";
                            }
                        ?>
                
                <?php
            // Delete Post
            if(isset($_GET['delete']))
            {
                $the_post_id = escape($_GET['delete']);

                $query  = "DELETE posts, comments FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id ";
                $query .= "WHERE post_id = {$the_post_id}";

                // $query  = "DELETE posts FROM posts LEFT JOIN comments ON posts.post_id = comments.comment_post_id ";
                // $query .= "WHERE comments.comment_post_id IS NULL";

                $delete_post_query = mysqli_query($connection, $query);

                comfirmQuery($delete_post_query);

                header("Location: posts.php");
            }

            // Reset Views
            if(isset($_GET['reset']))
            {
                $the_post_id = $_GET['reset'];

                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . "";

                $reset_views_query = mysqli_query($connection, $query);

                comfirmQuery($reset_views_query);

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

<!-- Confirm Delete Modal -->
<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            id = $(this).attr("rel");
            delete_url = "posts.php?delete="+ id +"";

            $(".modal_delete_link").attr('href', delete_url);

            $("#myModal").modal('show');
        })
    })
</script>
