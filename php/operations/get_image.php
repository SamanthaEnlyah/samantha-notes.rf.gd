<?php
    //include_once("connectToDb.php");

    function GetImageFromDB($id, $imgtype){
        $sql = "SELECT * FROM Image WHERE ImageID = ".$id;
        $conn=connectToDb();
        
        $result = $conn -> query($sql);

        if($result->num_rows>0){
            // $counter = 1;
            while($row = $result->fetch_assoc()){
                
                //  if($counter ==1) {
                    header("Content-Type: image/".$imgtype);
                    $image = $row['Image'];
                    $image_gd = imagecreatefromstring($image);
                    imagejpeg($image_gd);

                    $filepath = "../../note-images/image_".$id.".".$imgtype;
                    file_put_contents($filepath, $image);
                    return $image_gd;
                    
                // }
                // $counter++;
            }

        }
        $conn->close();
    }

    function GetImageFromDBToView($id, $imgtype){
                //echo "<script>alert('image');</script>";
        $sql = "SELECT * FROM Image WHERE ImageID = ".$id;
        $conn=connectToDb();
        
        $result = $conn -> query($sql);

        if($result->num_rows>0){
            // $counter = 1;
            while($row = $result->fetch_assoc()){
                    header("Content-Type: image/".$imgtype);
                    $image = $row['Image'];
                   // $image_gd = imagecreatefromstring($image);
                   // imagejpeg($image_gd);


                echo "<script>alert('saving blob to file named: image_".$id.".".$imgtype.");</script>";
                    $filepath = "../../note-images/image_".$id.".".$imgtype;
                    
                    file_put_contents($filepath, $image);


                    //stream_copy_to_stream($image_gd, $file);
                   // fclose($file);

                return $filepath;
                    
            }

        }
        $conn->close();
    }

?>