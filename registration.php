<?php  include "includes/header.php"; ?>
    <!-- Navigation -->   
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>

                <?php
                    if(isset($_POST['submit']))
                    {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $email    = $_POST['email'];
                        
                        if(!empty($username) && !empty($password) && !empty($email))
                        {
                            $query = "SELECT randSalt FROM users";
                            $select_randsalt_query = mysqli_query($connection, $query);

                            if(!$select_randsalt_query)
                            {
                                die("Query Failed!" .mysqli_error($select_randsalt_query));
                            }

                            $row  = mysqli_fetch_array($select_randsalt_query);
                            $salt = $row['randSalt'];
                            $password = crypt($password, $salt);

                            $query  = "INSERT INTO users(username, password, user_email, user_role)";
                            $query .= "VALUES('{$username}', '{$password}', '{$email}', 'Subscriber')";

                            $register_user_query = mysqli_query($connection, $query);

                            if(!$register_user_query)
                            {
                                die("Query Failed!" .mysqli_error($connection));
                            }

                            echo "<p class='bg-success'>Đăng kí thành công</p>";
                        }
                        // else {
                        //     echo "<script>alert('Đề nghị nhập đầy đủ nha')</script>";
                        // }

                        
                    }
                ?>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
