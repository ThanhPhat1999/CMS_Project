<?php include "db.php";?>
<?php include "../functions.php";?>
<?php session_start();?>
<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connection, $query);

        comfirmQuery($select_user_query);

        while($row = mysqli_fetch_assoc($select_user_query))
        {
            $db_user_id         =   $row['user_id'];
            $db_username        =   $row['username'];
            $db_password        =   $row['password'];
            $db_user_firstname  =   $row['user_firstname'];
            $db_user_lastname   =   $row['user_lastname'];
            $db_user_role       =   $row['user_role'];
        }

        // $password = crypt($password, $db_password);

        if($username === $db_username && password_verify($password, $db_password))
        {
            $_SESSION['username']       =   $db_username;
            $_SESSION['password']       =   $db_password;
            $_SESSION['user_firstname'] =   $db_user_firstname;
            $_SESSION['user_lastname']  =   $db_user_lastname;
            $_SESSION['user_role']      =   $db_user_role;
            
            header("Location: ../Admin");
        }
        else {
            header("Location: ../index.php");
        }
    }
?>