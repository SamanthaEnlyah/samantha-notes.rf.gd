<?php

 include_once("connectToDb.php");
 include_once("get_user_data.php");


 

    function InsertPieceInDb($piece, $x, $y){
            $conn2 = connectToDb();
        if($x == 0 && $y == 0) {
            $sql = "INSERT INTO Image (ImagePart_".$x."_".$y.", FK_UserID) VALUES ('".$piece."',".GetUserId().")";
            $conn = connectToDb();
            $conn->query($sql);
            $conn->close();

        } else {
            $imageid = -2;
                $userid = GetUserId();
                $sql2 = "SELECT MAX(ImageID), FK_UserID FROM Image INNER JOIN User ON UserID = FK_UserID WHERE FK_UserID=".GetUserId();
                $result = $conn2 -> query($sql2);
                if($result->num_rows==1) {
                    $imageid = $result->fetch_assoc()['MAX(ImageID)'];
                     //echo "<script>alert('prosao proveru da li je poslednji user ubacio sliku: ' + ".$imageid.");</script>";

                     
                    $sql4 = "UPDATE Image SET ImagePart_".$x."_".$y."='".$piece."' WHERE ImageID=".$imageid.";";
                    $conn2->query($sql4);
                }
                
                
        }
         $conn2->close();
    }


   
    

    

    function Prepare4Blobs($image){
              // header("Content-Type: image/jpeg");
                    $src = imagecreatefromstring($image);
                    
                    $width = imagesx($src);
                    $height = imagesy($src);
                    

                    // Calculate width and height of each piece
                    $pieceWidth = $width / 2;
                    $pieceHeight = $height / 2;

                    // Create image resources for the pieces
                    $pieces = [];
                    for ($x = 0; $x < 2; $x++) {
                        for ($y = 0; $y < 2; $y++) {
                            $pieces[$x][$y] = imagecreatetruecolor($pieceWidth, $pieceHeight);

                            imagecopy($pieces[$x][$y], $src, 0, 0, $x * $pieceWidth, $y * $pieceHeight, $pieceWidth, $pieceHeight);

                            // Start output buffering
                            ob_start();
                            // Output the image to the buffer
                            imagejpeg($pieces[$x][$y]);
                            // Get the contents of the buffer
                            $imagePieceData = ob_get_contents();
                            // End and clean the buffer
                            ob_end_clean();

                            // Optionally, escape the data for storage in a database
                            $escapedImageData = addslashes($imagePieceData);

                            InsertPieceInDb($escapedImageData, $x, $y);
                            // Copy the appropriate section of the original image
                            // imagecopy($pieces[$x][$y], $src, 0, 0, $x * $pieceWidth, $y * $pieceHeight, $pieceWidth, $pieceHeight);

                            // InsertPieceInDb(addslashes($pieces[$x][$y]), $x, $y);

                            // // Save the new image piece
                            // //imagejpeg($pieces[$x][$y], "output_piece_{$x}_{$y}.jpg");


                            // // Clean up
                             imagedestroy($pieces[$x][$y]);
                        }
                    }
                    
                    
                    // // Clean up the source image
                    // imagedestroy($src);
            
    }


    function DivideImageFromForm($image){
        $blob = Prepare4Blobs($image);

    }

?>