<?php
    include_once("connectToDb.php");

    function GetActionID($pastTense){
        $sql = "SELECT ActionID FROM Action WHERE PastTense ='".$pastTense."'";
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result -> num_rows == 1){
            return $result->fetch_assoc()["ActionID"];
        }


    }

?>