<?php
    include_once("../connectToDb.php");
    include_once("../operations/get_category_name_by_id.php");
    include_once("../model/Note.php");
    include_once("../operations/get_blob_by_image_id_to_view.php");

 
 if(isset($_GET['notenumber'])){
    $noteNumber = $_GET['notenumber'];
 }

    $sql = "SELECT * FROM Note INNER JOIN Version ON NoteID = FK_NoteID WHERE NoteNumber = ".$noteNumber;
    $conn = connectToDb();
    $result = $conn->query($sql);

        echo "<div style='margin: 0 auto; width: 60%;'>";
        echo "<table class='table'>
            <thead>
                <th>Number</th>
                <th>Version</th>
                <th>Title</th>
                <th>Content Peek</th>
                <th>Date</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
                
            </thead>
            <tbody>
        ";
        
        $notes = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                echo "<tr>";

                $NoteLatestVersion = new Note($row["NoteID"], $row["Title"], $row["Content"], $row["NoteNumber"], $row["FK_CategoryID"], $row["FK_UserID"], $row["VersionID"]);

                $NoteLatestVersion->setID($row["NoteID"]);

                $NoteLatestVersion->setNoteNumber($row["NoteNumber"]);
                echo "<td>".$NoteLatestVersion->getNoteNumber()."</td>";

                $NoteLatestVersion->setVersionID($row["VersionID"]);
                echo "<td>".$NoteLatestVersion->getVersionID()."</td>";

                $NoteLatestVersion->setTitle($row["Title"]);
                echo "<td>".$NoteLatestVersion->getTitle()."</td>";


                $NoteLatestVersion->setContent($row["Content"]);

                $length = (strlen($NoteLatestVersion->getContent()));
                // echo "LENGTH: " . $length;

                $sufix = (strlen($NoteLatestVersion->getContent()) >= 350)?"...":"";
                $notecontentpeek = substr($NoteLatestVersion->getContent(), 0, 350) . $sufix;

                      //  $notecontentpeek = str_replace('/', '\/', $notecontentpeek);

                $sqlImagesInNote = "SELECT * FROM Image INNER JOIN Note ON NoteID = FK_NoteID WHERE NoteID=".$NoteLatestVersion->getID();
                $result1 = $conn->query($sqlImagesInNote);
               
                $noteContentPeekWithImages = null;
                if($result1->num_rows>0){
                    while($row1 = $result1->fetch_assoc()){
                        $imageid = $row1['ImageID'];
                        $imagetype = $row1['ImageType'];
                       // echo "<script> alert('".$imageid."'); </script>"; 
                        //imagejpeg($row1['Image']);
                        //array_push($images, $imageid);

                        //$filepath = 
                        GetBlobByImageIDForPeek($imageid, $imagetype);
                        //echo "<script> alert('".$blobImage."'); </script>"; 

                        //if($blobImage != null) echo "<script> alert('ima slike'); </script>";
                        


                        //$notecontentpeek = str_replace("/", "\/", $notecontentpeek);
                       // $noteContentPeekWithImages = preg_replace('[<img imageid="'.$imageid.'" src="blob.*"/>]', '<img class="note-image" imageid="'.$imageid.'" src="../../note-images/image_"'.$imageid.'".jpeg"/>', $notecontentpeek);  //../operations/get_blob_by_image_id.php?imageid='.$imageid.'"
                       // echo "<br>images: ".$noteContentPeekWithImages;
                        //$noteContentPeekWithImages = '<img imageid="'.$imageid.'" src="image_'.$imageid.'.jpg" />';
                    }
                }

                //echo "without images: ".$notecontentpeek;
                //echo "with images: ".$noteContentPeekWithImages;
                $content = ($noteContentPeekWithImages==null)?$notecontentpeek:$noteContentPeekWithImages;

                echo "<td name='content_peek' noteid='".$row["NoteID"]."'>".$content."</td>";


                $NoteLatestVersion->setCreationDate($row["Date"]);
                echo "<td>".$NoteLatestVersion->getCreationDate()."</td>";
                
                
                $NoteLatestVersion->setFK_CategoryID($row["FK_CategoryID"]);
                
                echo "<td>".GetCategoryNameByID($NoteLatestVersion->getFK_CategoryID())."</td>";
                
                echo "<td><a href='' name='edit'   noteid='".$row["NoteID"]."' notenumber='".$NoteLatestVersion->getNoteNumber()."'>Edit</a></td>";
                echo "<td><a href='' name='delete' noteid='".$row["NoteID"]."' notenumber='".$NoteLatestVersion->getNoteNumber()."' title='".$row['Title']."' >Delete</a></td>";

                echo "</tr>";
            

            }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    

?>