<?php
    if(isset($_POST['create_user']))
    {
        $username       =   $_POST['username'];
        $password       =   $_POST['password'];
        $user_firstname =   $_POST['user_firstname'];
        $user_lastname  =   $_POST['user_lastname'];
        $user_email     =   $_POST['user_email'];
        $user_role      =   $_POST['user_role'];

        $hashFormat         = "$2y$10$";
        $salt               = "iusesomescrazystrings22";
        $hashF_and_salt     = $hashFormat . $salt;

        $password = crypt($password, $hashF_and_salt);

        $query  = "INSERT INTO users(username, password, user_firstname, user_lastname, user_email, user_role) ";
        $query .= "VALUES('{$username}', '{$password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);

        comfirmQuery($create_user_query);

        header("Location: users.php");
    }
?>
<form action="" method="post">
    <div class="form-group">
        <label for="username">UserName</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="Admin">Admin</option>
            <option value="Subcriber">Subcriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
    </div>
</form>