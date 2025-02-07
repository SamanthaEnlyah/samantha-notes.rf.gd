<?php

    function connectToDb(){
        $dbname = "";
        $dbhost = "";
        $username = "";
        $password = "";
        return mysqli_connect($dbhost, $username, $password, $dbname);
    }

?>