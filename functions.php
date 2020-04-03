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
?>