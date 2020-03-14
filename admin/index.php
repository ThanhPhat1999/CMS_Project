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
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Widgets -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $select_all_posts_query = mysqli_query($connection, $query);

                                            $posts_count = mysqli_num_rows($select_all_posts_query);
                                        
                                            echo "<div class='huge'>{$posts_count}</div>";
                                        
                                        ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM comments";
                                            $select_all_comments_query = mysqli_query($connection, $query);

                                            $comments_count = mysqli_num_rows($select_all_comments_query);
                                        
                                            echo "<div class='huge'>{$comments_count}</div>";
                                        
                                        ?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM users";
                                            $select_all_users_query = mysqli_query($connection, $query);

                                            $users_count = mysqli_num_rows($select_all_users_query);
                                        
                                            echo "<div class='huge'>{$users_count}</div>";
                                        
                                        ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $select_all_categories_query = mysqli_query($connection, $query);

                                            $categories_count = mysqli_num_rows($select_all_categories_query);
                                        
                                            echo "<div class='huge'>{$categories_count}</div>";
                                        
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Chart -->
                <?php
                    // POSTS
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_draft_posts_query = mysqli_query($connection, $query);
                    $draft_post_count = mysqli_num_rows($select_draft_posts_query);
                    comfirmQuery($select_draft_posts_query);

                    // COMMENTS
                    $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
                    $select_unapprove_comments_query = mysqli_query($connection, $query);
                    $unapprove_comment_count = mysqli_num_rows($select_unapprove_comments_query);
                    comfirmQuery($select_unapprove_comments_query);

                    // USER SUBSCRIBER
                    $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
                    $select_user_sub_query = mysqli_query($connection, $query);
                    $user_sub_count = mysqli_num_rows($select_user_sub_query);
                    comfirmQuery($select_user_sub_query);
                
                
                ?>
                <div class="row">
                    <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                                $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                                $element_count = [$posts_count, $draft_post_count, $comments_count, $unapprove_comment_count, $users_count, $user_sub_count, $categories_count];

                                for ($i=0; $i < 7; $i++) { 
                                    # code...
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>
                    <div class="chart_warp">
                        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <!-- /#wrapper -->
        <?php include "includes/footer.php"?>