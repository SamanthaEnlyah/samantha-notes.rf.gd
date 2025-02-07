<?php

    include_once("connectToDb.php");
    include_once("getActionIDByPastTense.php");
    include_once("get_user_data.php");

    //$noteContent je tipa Content - to je sve o jednoj belešci
    function InsertNote(){
        $conn = connectToDb();


        //echo "<script>alert('insert note first line');</script>";
        $actionId = GetActionID("created");

        $title = urldecode($_POST['title']);
        $content = urldecode($_POST['content']);
        $categoryid = urldecode($_POST['categoryid']);
        $userid = GetUserId();
        $noteid = -1;
        $imageidsJSON = $_POST['imageids'];      

        echo "<script> console.log('iz php-a: '+".$imageidsJSON.");</script>";
         


        $imageidsSTRING = json_decode($imageidsJSON);
        
        $imageidsINT = array();

        // Check if json_decode was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decode error: " . json_last_error_msg();
            return; // Stop further execution
        }

        // Ensure $imageidsSTRING is an array before iterating
        if (is_array($imageidsSTRING)) {
            foreach ($imageidsSTRING as $idstring) {
                // Convert the string to an integer
                array_push($imageidsINT, intval($idstring)); // This will convert '538' to 538
            }
        } else {
            echo "Decoded JSON is not an array.";
            return; // Stop further execution
        }


       // echo "<script> console.log('iz php-a: ');</script>";

        //echo "userid = " .$userid;

        $notenumber = GetLastNoteNumber() + 1;

        $content_to_save = str_replace("<div>", "<br>", $content);
        $content_to_save_2 = str_replace("</div>", "", $content_to_save);
        $content_to_save_3 = str_replace("'", "&apos;", $content_to_save_2);
        $content_to_save_4 = str_replace("’", "&apos;", $content_to_save_3);
        

        //$content_to_save_5 = str_replace("<", "&lt;", $content_to_save_4);
        //$content_to_save_6 = str_replace(">", "&gt;", $content_to_save_5);

        $regex = "<(?!/?(?:br|p|h[1-6]|div|span|a|strong|em|ul|ol|li|table|tr|td|th|form|input|button|select|textarea)\b)";
        $regex2 = "(?<!<(?:br|p|h[1-6]|div|span|a|strong|em|ul|ol|li|table|tr|td|th|form|input|button|select|textarea)\s*[^>]*?)>";
        
        $content_to_save_5 = str_replace("&lt;br&gt;", "<br>", $content_to_save_4);
        $content_to_save_6 = str_replace($regex, "&lt;", $content_to_save_5);
        $content_to_save_7 = str_replace($regex2, "&gt;", $content_to_save_6);

//$content_to_save_6 = str_replace("<", "lt", $content_to_save_5);
        //echo $content_to_save_8;
        //htmlentities($content_to_save_3, ENT_HTML5, 'UTF-8', true); 
        //mysqli_real_escape_string($conn, $content_to_save_4);  


        //$content_to_save_2 = str_replace('/', '\/', $content_to_save_2);
        //if(preg_match('[<img imageid=".*" src="blob.*">]', $content_to_save_2)){
        //    echo "contains images";
        //} else  { echo "doesn't contain images"; }

        //$content_to_save_3 = preg_replace("[blob:.*/>]", "\"/>", $content_to_save_2);
    
        //echo "<script>alert('before saving');</script>";

        // $content_to_save_2 = str_replace('/', '\/', $content_to_save_2);
        // $content_to_save_3 = preg_replace('[<img imageid="'.$imageid.'" src="blob.*/>]', '<img class="note-image" imageid="'.$imageid.'" src="image_'.$imageid.'.jpg"/>', $content_to_save_2); 


        /*START BLOCK Prepared statement
        //$stmt = $conn->prepare("INSERT INTO Note (Title, Content, FK_CategoryID, FK_UserID, NoteNumber) VALUES (?, ?, ?, ?, ?);");
        // $stmt->bind_param("ssiii", $title, $content_to_save_5, $categoryid, $userid, $notenumber); // "s" indicates the type is string

        // // Execute the statement
        // if ($stmt->execute()) {
        //     echo "Record inserted successfully.";
        // } else {
        //     echo "Error: " . $stmt->error; // Output error if insertion fails
        // } END BLOCK Prepared statement*/
        




        $sql = "INSERT INTO Note (Title, Content, FK_CategoryID, FK_UserID, NoteNumber) VALUES ('".$title."', '".$content_to_save_7."',".$categoryid.",".$userid.",".$notenumber.")";
       
       
        $conn->query($sql);

        // if ($conn->query($sql) === TRUE) {
        //     echo "New record created successfully.";
        // } else {
        //     echo "Error: " . $conn->error; // Output error if insertion fails
        // }


        //VRATI POSLEDNJI UBACENI NoteID
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



        //echo "<script>$('#noteid').text('".$noteid."');</script>";
         //echo "note id = ".$noteid;
        $sql = "INSERT INTO Version (Date, FK_ActionID, FK_NoteID, FK_UserID) VALUES (now(), ".$actionId.", ".$noteid.", ".$userid.")";
        $conn->query($sql);

        $versionid = -1;

        $sql_get_last_version = "SELECT MAX(VersionID), FK_UserID FROM Version";
        $result = $conn->query($sql_get_last_version);
        if($result->num_rows == 1){
            $row = $result -> fetch_assoc();
            $fk_user_id = $row["FK_UserID"];
            if($userid == $fk_user_id) {
                $versionid = $row["MAX(VersionID)"];
            }
        }
        if($versionid == -1){
             $versionid = FindMaxVersionIDGoingBackwards($userid);
        } 

        //Update in image: FK_NoteID
        foreach($imageidsINT as $imageid){
            $sql_update_image_noteid = "UPDATE Image SET FK_NoteID = ".$noteid." WHERE ImageID = ".$imageid;
            $conn->query($sql_update_image_noteid);

        }

        //$sqlNV = "INSERT INTO Note_Versions (NoteID, VersionID, NoteVersionNumber) VALUES (".$noteid.", ".$versionid.",".$noteversionNumber.")";
        //$conn->query($sqlNV);

        $conn->close();

        
        //echo "<script>alert('".$noteid."');</script>";
        echo $noteid;
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

    function GetLastNoteNumber(){
        $sql = "SELECT MAX(NoteNumber) FROM Note";
        $conn = connectToDb();
        $result = $conn -> query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $num = $row['MAX(NoteNumber)'];
            $conn->close();
            return $num;
        } else return 0;
    }

        //echo "<script>alert('insert note first line');</script>";
    InsertNote();

?>