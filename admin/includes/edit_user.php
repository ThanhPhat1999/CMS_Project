<?php
    if(isset($_GET['p_id']))
    {
        $the_user_id = escape($_GET['p_id']);

        $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
        $select_user_by_id = mysqli_query($connection, $query);

        comfirmQuery($select_user_by_id);
        
        while($row = mysqli_fetch_assoc($select_user_by_id))
        {
            $username           =   $row['username'];
            $password           =   $row['password'];
            $user_firstname     =   $row['user_firstname'];
            $user_lastname      =   $row['user_lastname'];
            $user_email         =   $row['user_email'];
            $user_role          =   $row['user_role'];
        }
    
    
    if(isset($_POST['update_user']))
    {
        $username       =   escape($_POST['username']);
        $password       =   escape($_POST['password']);
        $user_firstname =   escape($_POST['user_firstname']);
        $user_lastname  =   escape($_POST['user_lastname']);
        $user_email     =   escape($_POST['user_email']);
        $user_role      =   escape($_POST['user_role']);

            if(!empty($password))
            {
                $password_query = "SELECT password FROM users WHERE user_id = {$the_user_id}";
                $get_user_query = mysqli_query($connection, $password_query);

                $row = mysqli_fetch_array($get_user_query);
                $db_password =  $row['password'];

                if($db_password != $password)
                {
                    $hash_password       =   password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                }
                $query  = "UPDATE users SET ";
                $query .= "username = '{$username}', ";
                $query .= "password = '{$hash_password}', ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_role = '{$user_role}' ";
                $query .= "WHERE user_id = {$the_user_id}";

                $update_user_query = mysqli_query($connection ,$query);
                
                comfirmQuery($update_user_query);
                header("Location: users.php");
            }   
        }
    }
    else {
        header("Location: index.php");
    }
?>
<form action="" method="post">
    <div class="form-group">
        <label for="username">UserName</label>
        <input type="text" name="username" value="<?php if(isset($username)) { echo $username;}?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="<?php if(isset($password)) { echo $password;}?>" name="password" class="form-control">
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
        <input type="text" name="user_firstname" value="<?php if(isset($user_firstname)) { echo $user_firstname;}?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" value="<?php if(isset($user_lastname)) { echo $user_lastname;}?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" value="<?php if(isset($user_email)) { echo $user_email;}?>" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="update_user" value="Edit User" class="btn btn-warning">
    </div>
</form>