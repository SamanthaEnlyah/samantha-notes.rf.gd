<?php

    include_once("connectToDb.php");
//UNUSED
//     function GetAllNoteVersions($notenumber){

//         echo "<table>";
        
//         echo "<thead>";
//         echo "<tr>";
//         echo "<th>Title</th>";
//         echo "<th>Edit</th>";
//         echo "<th>Delete</th>";
//         echo "</tr>";
//         echo "</thead>";
//         echo "<tbody>";
//         $sql = "SELECT * FROM Note WHERE NoteNumber = ".$notenumber;
//         $conn = connectToDb();
//         $result = $conn->query($sql);

//         $count = 0;

//         if($result->num_rows > 0 ){
//             while($row = $result->fetch_assoc()){
//                 $noteid = $row["NoteID"];
//                 $title = $row["Title"];
//                 $content = $row["Content"];
//                 $note_number = $row["NoteNumber"];
//                 $categoryid = $row["FK_CategoryID"];
//                 $userid = $row["FK_UserID"];

//                 echo "<tr>";
//                 echo " <td categoryid='".$categoryid."'>".$title."</td>
                    
//                     <td noteid_edit='".$noteid."' note_number='".$note_number."'>Edit</td>
//                     <td noteid_delete='".$noteid."' note_number='".$note_number."'>Delete</td>";
                    
//                 echo "</tr>";
//             }
//         }
//         echo "</tbody>";
//         echo "</table>";
//     }

// GetAllNoteVersions();
?>