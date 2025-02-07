<?php
    //include_once("connectToDb.php");
    

    function GetCategoryIdByName($name){
        $conn = connectToDb();
        $sql = "SELECT * FROM Category WHERE CategoryName = '".$name."'";
        $result= $conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $id = $row["CategoryID"];
            $conn->close();
            return $id;
        }
    }


?>