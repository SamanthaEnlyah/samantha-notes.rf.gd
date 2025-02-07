<?php
    include_once("connectToDb.php");

function Find_notes_by_action($actionID){
    $sql = "SELECT * FROM Note 
            INNER JOIN Category ON CategoryID = FK_CategoryID 
            INNER JOIN Version ON NoteID = FK_NoteID
            INNER JOIN Text ON VersionID = FK_Text_VersionID
            INNER JOIN Image ON VersionID = FK_Image_VersionID
            INNER JOIN Action ON ActionID = FK_ActionID
            WHERE ActionID = ".$actionID;
    $notes = array();

    $conn = connectToDb();
    $result = $conn->query($sql);
    if($result->num_rows>0) {
        while($row = $result->fetch_assoc()){
            $note = new Note();
            $note->setID($row['NoteID']);
            $note->setTitle($row['Title']);
            $note->setFK_CategoryID($row['FK_CategoryID']);


            $firstVersion = new Version();
            $versions = new Versions();
            $firstVersion=$versions->getFirstCreatedVersionFromDB();

            $note->setCreationDate($firstVersion->getDate());
            $text = new Text();
            $text->setText($row['Text']);
            $note->addContentItemToContentArray($text);

            
            
            //$note->set($row['']);
            
            //$note->set($row['']);

            array_push($notes, $note);
        }
        $conn->close();
        return $notes;
    }
}

?>
