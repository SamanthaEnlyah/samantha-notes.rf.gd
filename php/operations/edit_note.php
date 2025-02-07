<?php
    include_once("connectToDb.php");
    include_once("getActionIDByPastTense.php");
    include_once("get_user_data.php");

    function EditNote(){
        //save new version
        $actionid = GetActionID("edited");
        $userid = GetUserId();
        
        $title = $_POST['title'];
        $noteNumber = $_POST['notenumber'];
        $content = $_POST['content'];
        $categoryid = $_POST['categoryid'];
        //echo "categoryid = ".$categoryid;
        $userid = GetUserId();
        $noteid = -1;

        echo "<script> 
        alert('edit_note title: ".$title."');
        console.log('edit notenumber: ".$noteNumber."');
        console.log('edit note content: ".$content."');
        console.log('edit note category id: ".$categoryid."');
        console.log('edit note user id: ".$userid."');
        </script>";



        $content_to_save = str_replace("<div>", "<br>", $content);
        $content_to_save_2 = str_replace("</div>", "", $content_to_save);
        $content_to_save_3 = str_replace("'", "&apos;", $content_to_save_2);
        // $content_to_save_4 = str_replace("<", "&lt;", $content_to_save_3);
        // $content_to_save_5 = str_replace(">", "&gt;", $content_to_save_4);

        $content_to_save_4 = str_replace("’", "&apos;", $content_to_save_3);
        

        //$content_to_save_5 = str_replace("<", "&lt;", $content_to_save_4);
        //$content_to_save_6 = str_replace(">", "&gt;", $content_to_save_5);

        $regex = "<(?!/?(?:br|p|h[1-6]|div|span|a|strong|em|ul|ol|li|table|tr|td|th|form|input|button|select|textarea)\b)";
        $regex2 = "(?<!<(?:br|p|h[1-6]|div|span|a|strong|em|ul|ol|li|table|tr|td|th|form|input|button|select|textarea)\s*[^>]*?)>";
        
        $content_to_save_5 = str_replace("&lt;br&gt;", "<br>", $content_to_save_4);
        $content_to_save_6 = str_replace($regex, "&lt;", $content_to_save_5);
        $content_to_save_7 = str_replace($regex2, "&gt;", $content_to_save_6);

       // echo "<test>".$content_to_save_3."</test>";


        
        //if($title == "undefined" || $noteNumber ==  "undefined" || $userid == "undefined" || $content_to_save_7 == "undefined"  ||  $categoryid == "undefined") echo "something is  really undefined";

        $columns = ["title"=>$title, "noteNumber"=>$noteNumber, "userID"=>$userid, "contentToSave7"=>$content_to_save_7, "categoryID"=>$categoryid];
        foreach($columns as $key=>$value){
            if($value == "undefined") {
                echo $key ." is undefined";
            }
        }
        

        $sql = "INSERT INTO Note (Title, Content, FK_CategoryID, FK_UserID, NoteNumber) VALUES ('".$title."','".$content_to_save_7."',".$categoryid.",".$userid.",".$noteNumber.")";
        //$sql = "INSERT INTO Note (Title, Content, FK_CategoryID, FK_UserID) VALUES ('title', 'content', 5, 1, 13)";
        $conn = connectToDb();
        $conn->query($sql);
         
        $sql_get_last_note = "SELECT MAX(NoteID), FK_UserID FROM Note";
        $result = $conn->query($sql_get_last_note);
        if($result->num_rows == 1){
            $row = $result -> fetch_assoc();
            $fk_user_id = $row["FK_UserID"];
            if($userid == $fk_user_id) {
                $noteid = $row["MAX(NoteID)"];
            }
        }

         if($noteid == -1){
             $noteid = FindMaxNoteIDGoingBackwards($userid);
         }   


        $sql = "INSERT INTO Version (Date, FK_ActionID, FK_NoteID, FK_UserID) VALUES (now(),".$actionid.",".$noteid.",".$userid.")";
        $conn = connectTODb();
        $conn->query($sql);
    }


    function FindMaxNoteIDGoingBackwards($userid){
            $conn = connectToDb();
            $sql_noteid_desc = "SELECT NoteID, FK_UserID FROM Note ORDER BY NoteID DESC";
            $result = $conn -> query($sql_noteid_desc);
            while($row = $result->fetch_assoc()){    
                if($row["FK_UserID"] == $userid){
                    $note_id = $row["NoteID"];
                    return $note_id;
                }
            }
    }

    function FindMaxVersionIDGoingBackwards($userid){
            $conn = connectToDb();
            $sql_versionid_desc = "SELECT VersionID, FK_UserID FROM Version ORDER BY VersionID DESC";
            $result = $conn -> query($sql_versionid_desc);
            while($row = $result->fetch_assoc()){    
                if($row["FK_UserID"] == $userid){
                    $version_id = $row["VersionID"];
                    return $version_id;
                }
            }
    }

    
    
    EditNote();

?>