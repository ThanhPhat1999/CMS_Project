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
                        My Profile
                        <small><?php echo $_SESSION['username']?></small>
                    </h1>
                    <?php
                        // Lấy dữ liệu lên dựa theo username sử dụng SESSION
                        if(isset($_SESSION['username']))
                        {
                            $username = $_SESSION['username'];

                            $query = "SELECT * FROM users WHERE username = '{$username}'";

                            $select_user_profile_query = mysqli_query($connection, $query);

                            comfirmQuery($select_user_profile_query);

                            while($row = mysqli_fetch_assoc($select_user_profile_query))
                            {
                                $user_id        =   $row['user_id'];
                                $username       =   $row['username'];
                                $password       =   $row['password'];
                                $user_firstname =   $row['user_firstname'];
                                $user_lastname  =   $row['user_lastname'];
                                $user_email     =   $row['user_email'];
                                $user_role      =   $row['user_role'];
                            }
                        }

                        if(isset($_POST['update_profile']))
                        {
                            $username           =   escape($_POST['username']);
                            $password           =   escape($_POST['password']);
                            $user_firstname     =   escape($_POST['user_firstname']);
                            $user_lastname      =   escape($_POST['user_lastname']);
                            $user_email         =   escape($_POST['user_email']);
                            $user_role          =   escape($_POST['user_role']);


                            $hashFormat     = "$2y$10$";
                            $salt           = "iusesomescrazystrings22";
                            $hashF_and_salt = $hashFormat . $salt;

                            $password = crypt($password, $hashF_and_salt);

                            $query  = "UPDATE users SET ";
                            $query .= "username = '{$username}', ";
                            $query .= "password = '{$password}', ";
                            $query .= "user_firstname = '{$user_firstname}', ";
                            $query .= "user_lastname = '{$user_lastname}', ";
                            $query .= "user_email = '{$user_email}', ";
                            $query .= "user_role = '{$user_role}' ";
                            $query .= "WHERE username = '{$username}'";

                            $update_user_profile_query = mysqli_query($connection ,$query);
                            
                            comfirmQuery($update_user_profile_query);

                            header("Location: profile.php");
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" name="username" value="<?php if(isset($username)) { echo $username;}?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                value="<?php if(isset($password)) { echo $password;}?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="post_category_id">Role</label>
                            <select name="user_role" id="" class="form-control">
                                <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
                                <?php
                if($user_role == 'Admin')
                {
                    echo "<option value='Subscriber'>Subscriber</option>";
                }
                else {
                    echo "<option value='Admin'>Admin</option>";
                } 
            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" name="user_firstname"
                                value="<?php if(isset($user_firstname)) { echo $user_firstname;}?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Last Name</label>
                            <input type="text" name="user_lastname"
                                value="<?php if(isset($user_lastname)) { echo $user_lastname;}?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" name="user_email"
                                value="<?php if(isset($user_email)) { echo $user_email;}?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update_profile" value="Update Profile" class="btn btn-warning">
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