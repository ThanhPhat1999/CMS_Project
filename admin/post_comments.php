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
                        Welcome to Posts
                        <small><?php if(isset($_SESSION['username'])) {echo $_SESSION['username'];}?></small>
                    </h1>
                    <!-- Bulk Options -->
                    <?php
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

                            $query = "SELECT * FROM comments WHERE comment_post_id =" .mysqli_real_escape_string($connection, $_GET['id']). " ";
                            $select_all_comments_query = mysqli_query($connection, $query);

                            comfirmQuery($select_all_comments_query);
                            

                            while($row = mysqli_fetch_assoc($select_all_comments_query)){
                                $comment_id         =   $row['comment_id'];
                                $comment_post_id    =   $row['comment_post_id'];
                                $comment_author     =   $row['comment_author'];
                                $comment_content    =   $row['comment_content'];
                                $comment_email      =   $row['comment_email'];
                                $comment_status     =   $row['comment_status'];
                                $comment_date       =   $row['comment_date'];
                                
                                echo "<tr>";
                                ?>

                                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]"
                                            value="<?php echo $comment_id?>">
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
                                echo "<td><a href = 'post_comments.php?approve=$comment_id&id=" . $_GET['id'] . "'>Approve</a></td>";
                                echo "<td><a href = 'post_comments.php?unapprove=$comment_id&id=" . $_GET['id'] . "'>Unapprove</a></td>";
                                echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete ?');\" href = 'post_comments.php?delete=$comment_id&id=" . $_GET['id'] . "'>Delete</a></td>";
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

                header("Location: post_comments.php?id=". $_GET['id'] ."");
            }

            if(isset($_GET['unapprove']))
            {
                $the_status_unapprove_id = $_GET['unapprove'];

                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_status_unapprove_id";

                $the_status_unapprove_query = mysqli_query($connection, $query);

                comfirmQuery($the_status_unapprove_query);
                
                header("Location: post_comments.php?id=". $_GET['id'] ."");
            }

            if(isset($_GET['delete']))
            {
                $the_comment_id = $_GET['delete'];

                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

                $delete_comment_query = mysqli_query($connection, $query);

                comfirmQuery($delete_comment_query);

                header("Location: post_comments.php?id=" . $_GET['id'] . "");
            }
        ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- /#wrapper -->
    <?php include "includes/footer.php"?>