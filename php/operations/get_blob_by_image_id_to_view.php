<?php
include_once("get_image.php");
include_once("combine_image_parts.php");


function GetBlobByImageID(){

        //echo "<script>alert('get blob by image id');</script>";

       // echo "<script>alert('".$_GET['imageid']."');</script>";

         $imageid = $_GET['imageid'];
        //$imageid = 415;

        //echo "<script>alert('start');</script>";

        $sql = "SELECT * FROM Image WHERE ImageID = ".$imageid;
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result -> num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['Image'] != null) {
                //echo "<script>alert('image from db');</script>";
                return GetImageFromDBToView($imageid); 
            }else {
                //echo "<script>alert('combined image from db');</script>";
                return CombinePartsToView($imageid);

            }
        }
    }

        if(isset($_GET['imageid'])){
            GetBlobByImageID();
        } else {
           // echo "<script>alert('image id is not sent through get or post');</script>";
        }

   function GetBlobByImageIDForPeek($imageidpeek){

        echo "<script>alert('get blob by image id peek');</script>";


           //  echo "<script>alert('".$imageidpeek."');</script>";

         $imageid = $imageidpeek;


        $sql = "SELECT * FROM Image WHERE ImageID = ".$imageid;
        $conn = connectToDb();
        $result = $conn->query($sql);
        if($result -> num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['Image'] != null) {
                echo "<script>alert('blob exists, single image');</script>";
                //echo "<script>alert('image from db');</script>";
                return GetImageFromDBToView($imageid, $row['ImageType']); 
            }else {
                //echo "<script>alert('combined image from db');</script>";
                echo "<script>alert('blob exists, muiltiple images');</script>";
                return CombinePartsToView($imageid);

            }
        }
    }


?>