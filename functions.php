<?php
    function comfirmQuery($result)
    {
        global $connection;

        if(!$result)
        {
            die("Query Failed" .mysqli_error($connection));
        }
    }

    function escape($string)
    {
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }

    function username_exist($username)
    {
        global $connection;

        $query  = "SELECT username FROM users WHERE username = '{$username}'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0){
            return true;
        }
        else {
            return false;
        }
    }

    function email_exist($email)
    {
        global $connection;

        $query  = "SELECT user_email FROM users WHERE user_email = '{$email}'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }

    function register_user($username, $email, $password)
    {
        global $connection;

        if(username_exist($username))
        {

        }
        else if(!empty($username) && !empty($password) && !empty($email))
        {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

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

    function login_user($username, $password)
    {
        global $connection;

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