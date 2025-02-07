<?php
    include_once('connectToDb.php');

    function GetFirstCreatedVersionOfNote($noteid){
        $sql = "SELECT * FROM 
                Note 
                INNER JOIN Version ON NoteID = FK_NoteID  
                INNER JOIN Action ON ActionID = FK_ActionID
                WHERE ActionName='Create' AND NoteID=".$noteid;

        $conn = connectToDb();
        $result = $conn->query($sql);
        $version = new Version();
        if($result->num_rows==1){
            $version->setID($row["VersionID"]);
            $version->setDate($row["Date"]);
            $version->setFK_ActionID($row["FK_ActionID"]);
            $version->setFK_NoteID($row["FK_NoteID"]);
        }
        $conn->close();
        return $version;
    }

?>