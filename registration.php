<?php  include "includes/header.php"; ?>
    <!-- Navigation -->   
    <?php  include "includes/navigation.php"; ?>

    <?php
        if(isset($_GET['lang']) && !empty($_GET['lang']))
        {
            $_SESSION['lang'] = $_GET['lang'];

            if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang'])
            {
                echo "<script type='text/javascript'>location.reload();</script>";
            }
            else if (isset($_SESSION['lang']))
            {
                include "includes/languages/".$_SESSION['lang'].".php";
            }
            else {
                include "includes/languages/en.php";
            }
        }
    ?>

    <!-- Page Content -->
    <div class="container">
    <form action="" method='get' class="navbar-form navbar-right" id="language_form">
        <div class="form-group">
            <select name="lang" onchange='changeLanguage()' class="form-control">
                <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') { echo "selected" ;}?>>English</option>
                <option value="vn" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'vn') { echo "selected" ;}?>>Vietnamese</option>
            </select>
        </div>
    </form>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER;?></h1>

                <?php
                    if(isset($_POST['submit']))
                    {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $email    = $_POST['email'];
                        
                        if(!empty($username) && !empty($password) && !empty($email))
                        {
                            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                            // $query = "SELECT randSalt FROM users";
                            // $select_randsalt_query = mysqli_query($connection, $query);

                            // if(!$select_randsalt_query)
                            // {
                            //     die("Query Failed!" .mysqli_error($select_randsalt_query));
                            // }

                            // $row  = mysqli_fetch_array($select_randsalt_query);
                            // $salt = $row['randSalt'];
                            // $password = crypt($password, $salt);

                            $query  = "INSERT INTO users(username, password, user_email, user_role)";
                            $query .= "VALUES('{$username}', '{$password}', '{$email}', 'Subscriber')";

                            $register_user_query = mysqli_query($connection, $query);

                            if(!$register_user_query)
                            {
                                die("Query Failed!" .mysqli_error($connection));
                            }

                            echo "<p class='bg-success'>Your registration has been submitted</p>";
                        }
                        
                    }
                ?>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME;?>" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL;?>" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD;?>" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="<?php echo _SUBMIT;?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>

        <script>
    function changeLanguage()
    {
        document.getElementById('language_form').submit();
    }
</script>

<?php include "includes/footer.php";?>
