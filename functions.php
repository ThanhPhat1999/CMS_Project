<?php
    function comfirmQuery($result)
    {
        global $connection;

        if(!$result)
        {
            die("Query Failed" .mysqli_error($connection));
        }
    }
?>