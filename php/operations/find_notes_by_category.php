<?php
    session_start();

    include_once("connectToDb.php");
    include_once("../model/Note.php");
    include_once("get_latest_note_version.php");
    include_once("get_user_data.php");
    
    function Find_notes_by_category($categoryID){
        $conn = connectToDb();
          

               echo "<table class='table form-size' style='margin: 0 auto;'>
                    <thead> 
                        <th>Title</th>   
                        <th></th>   
                    </thead>   
                    ";
               
                $notenumbers = GetAllNoteNumbersForCategory($categoryID);

                if(!is_array($notenumbers)) {
                    return false;
                } else 
                    if(sizeof($notenumbers) == 0){
                        return false;
                    }

                foreach($notenumbers as $notenumber){


                    echo "<tr>";

                    $noteLatestVersion = GetLatestVersion($notenumber);
                    
                    $title =($noteLatestVersion->getTitle() == "")?"Untitled":$noteLatestVersion->getTitle();


                    echo "<td>".$notenumber.":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' name='note' id='note_number_".$notenumber."'>".$title."</a></td>";
                    echo "<td></td>";

                    echo "</tr>";
                }
                echo "</table>";
            $conn->close();
            return true;
    }


    function GetAllNoteNumbersForCategory($categoryID){
        $userid = GetUserId();
        $sql = "SELECT DISTINCT NoteNumber FROM Note WHERE FK_UserID=".$userid." AND FK_CategoryID=".$categoryID;
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


?>
