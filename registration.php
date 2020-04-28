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
                        $username   =   escape($_POST['username']);
                        $password   =   escape($_POST['password']);
                        $email      =   escape($_POST['email']);

                        $error = [
                            'username'  =>  '',
                            'password'  =>  '',
                            'email'     =>  ''
                        ];

                        if(strlen($username) < 5)
                        {
                            $error['username'] = "Username needs to longer";
                        } 
                        if ($username == '')
                        {
                            $error['username'] = "Username cannot be empty";
                        }
                        if (username_exist($username))
                        {
                            $error['username'] = "This username already exists, pick another another. <a href='index.php'>Please Login</a>";
                        }
                        if ($email == '')
                        {
                            $error['email']    = "Email cannot be empty";
                        }
                        if (email_exist($email))
                        {
                            $error['email']    = "This email already exists, pick another another. <a href='index.php'>Please Login</a>";
                        }
                        if ($password == '')
                        {
                            $error['password'] = "Password cannot be empty";
                        }
                        
                        foreach ($error as $key => $value) {
                            if(empty($value))
                            {
                                unset($error[$key]);
                            }
                        }

                        if(empty($error))
                        {
                            register_user($username, $email, $password);
                        }
                    }
                ?>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME;?>" autocomplete="on" 
                            value="<?php echo isset($username) ? $username : ''?>">
                            <a href=""><?php echo isset($error['username']) ? $error['username'] : ''?></a>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL;?>" autocomplete="on" 
                            value="<?php echo isset($email) ? $email : ''?>">
                            <a href=""><?php echo isset($error['email']) ? $error['email'] : ''?></a>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD;?>">
                            <a href=""><?php echo isset($error['password']) ? $error['password'] : ''?></a>
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
