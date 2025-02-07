<?php



    function exists($conn, $email){

        $sql = "SELECT Email from User WHERE Email = '".$email."'";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            return false;
        } else return true;

    }
?>