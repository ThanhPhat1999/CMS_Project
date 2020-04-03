<?php
    echo password_hash('hello', PASSWORD_BCRYPT, array('cost' => 10));
?>