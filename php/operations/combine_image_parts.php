<?php

    //include_once("connectToDb.php");

    function CombineParts($id){
        $sql = "SELECT * FROM Image WHERE ImageID=".$id;
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result ->num_rows==1){
            $row = $result->fetch_assoc();
            $blob00 = imagecreatefromstring($row['ImagePart_0_0']);
            $blob01 = imagecreatefromstring($row['ImagePart_0_1']);
            $blob10 = imagecreatefromstring($row['ImagePart_1_0']);
            $blob11 = imagecreatefromstring($row['ImagePart_1_1']);

            $combinedWidth = 2*imagesx($blob00);
            $combinedHeight = 2*imagesy($blob00);
            
            $combinedImage = imagecreatetruecolor($combinedWidth, $combinedHeight);
            $white = imagecolorallocate($combinedImage, 255, 255, 255);
            imagefill($combinedImage, 0, 0, $white);

            imagecopy($combinedImage, $blob00, 0, 0, 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob01, 0, imagesy($blob00), 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob10, imagesx($blob00), 0, 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob11, imagesx($blob00), imagesy($blob00), 0, 0, imagesx($blob00), imagesy($blob00));

            header('Content-Type: image/jpeg');
            imagejpeg($combinedImage);

            imagedestroy($blob00);
            imagedestroy($blob01);
            imagedestroy($blob10);
            imagedestroy($blob11);
            //imagedestroy($combinedImage);
            
            $filepath = "../../note-images/image_".$id.".jpeg";
            file_put_contents($filepath, $combinedImage);
            
            return $combinedImage;
        }


    }
    
    
    function CombinePartsToView($id){
        echo "<script>alert('image');</script>";
        $sql = "SELECT * FROM Image WHERE ImageID=".$id;
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result ->num_rows==1){
            $row = $result->fetch_assoc();
            $blob00 = imagecreatefromstring($row['ImagePart_0_0']);
            $blob01 = imagecreatefromstring($row['ImagePart_0_1']);
            $blob10 = imagecreatefromstring($row['ImagePart_1_0']);
            $blob11 = imagecreatefromstring($row['ImagePart_1_1']);

            $combinedWidth = 2*imagesx($blob00);
            $combinedHeight = 2*imagesy($blob00);
            
            $combinedImage = imagecreatetruecolor($combinedWidth, $combinedHeight);
            $white = imagecolorallocate($combinedImage, 255, 255, 255);
            imagefill($combinedImage, 0, 0, $white);

            imagecopy($combinedImage, $blob00, 0, 0, 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob01, 0, imagesy($blob00), 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob10, imagesx($blob00), 0, 0, 0, imagesx($blob00), imagesy($blob00));
            imagecopy($combinedImage, $blob11, imagesx($blob00), imagesy($blob00), 0, 0, imagesx($blob00), imagesy($blob00));

            header('Content-Type: image/jpeg');
           // imagejpeg($combinedImage);

            imagedestroy($blob00);
            imagedestroy($blob01);
            imagedestroy($blob10);
            imagedestroy($blob11);
    
                
                $filepath = "../../note-images/image_".$id.".jpeg";
                    file_put_contents($filepath, $combinedImage);

                //$file = fopen($filepath, 'wb');
                //stream_copy_to_stream($combinedImage, $file);

               ///file_put_contents($filepath, $combinedImage);


                //fclose($file);
                
                echo "FILE SAVED";

                return $filepath;
                
            //}

            //imagedestroy($combinedImage);
            
        }


    }

    //CombineParts(83);

?>