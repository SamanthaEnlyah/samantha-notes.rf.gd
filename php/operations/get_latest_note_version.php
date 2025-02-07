<?php
    include_once("connectToDb.php");
    include_once("getActionIDByPastTense.php");

    function GetLatestVersion($noteNumber){
        //echo "note number in get latest version: ".$noteNumber;
        $sql = "SELECT * FROM Note INNER JOIN Version ON NoteID = FK_NoteID WHERE NoteNumber = ".$noteNumber." ORDER BY Date DESC LIMIT 1";
        $conn = connectToDb();
        $result = $conn -> query($sql);
        if($result->num_rows == 1){
            
            $row = $result->fetch_assoc();
            
            $NoteLatestVersion = new Note();

            //if(GetActionFromID($row['FK_ActionID']) == "created") {
                $NoteLatestVersion->setID($row["NoteID"]);
                $NoteLatestVersion->setTitle($row["Title"]);
                $NoteLatestVersion->setContent( $row["Content"]);
                $NoteLatestVersion->setNoteNumber($row["NoteNumber"]);
                $NoteLatestVersion->setFK_CategoryID($row["FK_CategoryID"]);
                $NoteLatestVersion->setFK_UserID($row["FK_UserID"]);
                $NoteLatestVersion->setCreationDate($row["Date"]);
                $NoteLatestVersion->setVersionID($row["VersionID"]);
                //if($NoteLatestVersion == null) echo "note je null u GetLatestVersion funkciji";
                return $NoteLatestVersion;  
           // } 

            //if(GetActionFromID($row['FK_ActionID']) == "edited") {
//
           // }
        }

    }

    function GetActionFromID($id){
        $sql = "SELECT * FROM Action WHERE ActionID = ".$id;
        $conn = connectToDb();
        $result = $conn->query();
        if($result->num_rows == 1){
            return $result->fetch_assoc()['PastTense'];
        }
    }
       
    function GetLatestVersionEdited(){

    }

?>


