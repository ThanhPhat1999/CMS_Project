<!-- Bulk Options -->
<?php
    include("delete_modal.php");
    if(isset($_POST['checkBoxArray']))
    {
        foreach ($_POST['checkBoxArray'] as $commentValueId) {

            $bulkOptions = $_POST['bulkOptions'];
            
            switch ($bulkOptions) {
                case 'approved':
                    $query  = "UPDATE comments SET comment_status = '{$bulkOptions}' ";
                    $query .= "WHERE comment_id = {$commentValueId}";
                    $update_to_approve_query = mysqli_query($connection, $query);
                    break;
                
                case 'unapproved':
                    $query  = "UPDATE comments SET comment_status = '{$bulkOptions}' ";
                    $query .= "WHERE comment_id = {$commentValueId}";
                    $update_to_unapprove_query = mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query  = "DELETE FROM comments WHERE comment_id = {$commentValueId}";
                    $delete_to_comment_query = mysqli_query($connection, $query);
                    break;
            }
        }
    }
?>
<form action="" method="post">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <div id="bulkOptionContainer" class="col-xs-4 form-group">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select Options</option>
                    <option value="approved">Approved</option>
                    <option value="unapproved">Unapproved</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" value="Apply" name="submit" class="btn btn-success">
            </div>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAllBoxes"></th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In Response to</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
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
                            else {
                                $page_1 = ($page * $per_page) - $per_page;
                            }

                            $comment_query_count = "SELECT * FROM comments";
                            $find_count = mysqli_query($connection, $comment_query_count);
                            $count = mysqli_num_rows($find_count);

                            $count = ceil($count / $per_page);

                            // End Pagination

                            $query = "SELECT * FROM comments LIMIT $page_1, $per_page";
                            $select_all_posts_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                                $comment_id         =   $row['comment_id'];
                                $comment_post_id    =   $row['comment_post_id'];
                                $comment_author     =   $row['comment_author'];
                                $comment_content    =   $row['comment_content'];
                                $comment_email      =   $row['comment_email'];
                                $comment_status     =   $row['comment_status'];
                                $comment_date       =   $row['comment_date'];

                                echo "<tr>";
                                ?>

                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $comment_id?>">
                </td>

                <?php 
                                echo "<td>{$comment_author}</td>";
                                echo "<td>{$comment_content}</td>";
                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_status}</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                $comment_post_id_query = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($comment_post_id_query))
                                {
                                    $post_id    = $row['post_id'];
                                    $post_title = $row['post_title'];

                                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                }
                                
                                echo "<td>{$comment_date}</td>";
                                echo "<td><a href = 'comments.php?approve=$comment_id'>Approve</a></td>";
                                echo "<td><a href = 'comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                                echo "<td><a class = 'delete_link' rel = '$comment_id' href = 'javascript:void(0)'>Delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
                <?php
            if(isset($_GET['approve']))
            {
                $the_status_approve_id = $_GET['approve'];

                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_status_approve_id";

                $the_status_approve_query = mysqli_query($connection, $query);

                comfirmQuery($the_status_approve_query);

                header("Location: comments.php");
            }

            if(isset($_GET['unapprove']))
            {
                $the_status_unapprove_id = $_GET['unapprove'];

                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_status_unapprove_id";

                $the_status_unapprove_query = mysqli_query($connection, $query);

                comfirmQuery($the_status_unapprove_query);
                
                header("Location: comments.php");
            }

            if(isset($_GET['delete']))
            {
                $the_comment_id = $_GET['delete'];

                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

                $delete_comment_query = mysqli_query($connection, $query);

                comfirmQuery($delete_comment_query);

                header("Location: comments.php");
            }
        ?>
            </tbody>
        </table>
    </div>
</form>

<ul class="pager">
    <?php
        for ($i=1; $i <= $count; $i++) {
            echo "<li><a href='comments.php?page={$i}'>{$i}</a></li>";
        }
    ?>
</ul>

<!-- Confirm Delete Modal -->
<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            id = $(this).attr("rel");
            delete_url = "comments.php?delete="+ id +"";

            $(".modal_delete_link").attr('href', delete_url);

            $("#myModal").modal('show');
        })
    })
</script>