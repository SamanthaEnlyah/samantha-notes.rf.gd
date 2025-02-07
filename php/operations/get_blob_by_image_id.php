<?php
    include_once("connectToDb.php");
    include("get_image.php");
    include("combine_image_parts.php");

    function GetBlob(){

        $id = $_GET['imageid'];
        
        $sql = "SELECT * FROM Image WHERE ImageID = ".$id;
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result -> num_rows == 1) {
            $row = $result->fetch_assoc();
            if($row['Image'] != null) {
                return GetImageFromDB($id, $row['ImageType']); 
            }else {
                return CombineParts($id, $row['ImageType']);
            }
        }
    }

        
    if(isset($_GET['imageid'])) {
        GetBlob();
    }

    
    

?>