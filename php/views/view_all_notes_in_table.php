<?php

    //echo "<p>viewing all notes</p>";
    //include_once("../connectToDb.php");
    session_start();
    include_once("../operations/get_latest_note_version.php");
    include_once("../model/Note.php");
    include_once("../operations/get_user_data.php");
    
    function GetAllNotes(){
        $conn = connectToDb();

        // $sql = "SELECT * FROM Note";
        // $result = $conn->query($sql);

        //if($result->num_rows>0){
           // while($row = $result->fetch_assoc()){




               echo "<table class='table form-size' style='margin: 0 auto;'>
                    <thead> 
                        <th>Title</th>   
                        <th></th>   
                    </thead>   
                    ";
               
               echo "<tbody>";
                $notenumbers = GetAllNoteNumbers();
                foreach($notenumbers as $notenumber){
                    echo "<tr>";

                    $noteLatestVersion = GetLatestVersion($notenumber);
                    
                    $title =($noteLatestVersion->getTitle() == "")?"Untitled":$noteLatestVersion->getTitle();
                 

                    echo "<td>".$notenumber.":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' name='note' id='note_number_".$notenumber."'>".$title."</a></td>";
                    echo "<td></td>";

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            $conn->close();
                // echo $row["Title"];
                // echo "</br>";
                // echo $row["Date"];
           // }
        //}
    }


    function GetAllNoteNumbers(){
        $userid = GetUserId();
        $sql = "SELECT DISTINCT NoteNumber FROM Note WHERE FK_UserID=".$userid;
        $conn = connectToDb();
        $result = $conn->query($sql);

        $noteNumbers = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $noteNumber = $row["NoteNumber"];
                array_push($noteNumbers, $noteNumber);
            }
        }
        $conn->close();
        return $noteNumbers;
    }

    // function GetVersionID($notenumber){
    //     $sql = "SELECT VersionID FROM Note n INNER JOIN Version v ON n.NoteID = v.FK_NoteID WHERE n.NoteNumber = ".$notenumber;
    //     $conn = connectToDb();
    //     $result = $conn->query($sql);

    //     $noteVersionIDs = array();
    //     if($result -> num_rows > 0){
    //         while($row = $result->fetch_assoc()){
    //             array_push($noteVersionIDs, $row["VersionID"]);
    //         }
    //     }


    //     $conn->close();
    // }
    
    GetAllNotes();

?>