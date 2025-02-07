<?php

    include_once("connectToDb.php");
    include("divide_image.php");
    include_once("get_user_data.php");


    function InsertImage(){

        //$noteid = $_POST['noteid'];

        $max_size = 3145728;
        //echo "INSERTING IMAGE";

        //create blob from image by adding slashes
        $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));

        // $image = addslashes(file_get_contents($_POST['imageurl']));

        //check if image is larger than max_size
        $size = $_FILES['file']['size'];
        if($size > $max_size) {
            DivideImageFromForm(stripslashes($image));
            return;
        }

        $userid = GetUserId();
        $extension = $_POST['extension'];
        try{
            $sql = "INSERT INTO Image (Image, FK_UserID, ImageType) VALUES ('".$image."', ".$userid.", '".$extension."')";
            $conn = connectToDb();
            $conn -> query($sql);
        } catch(Exception  $e){
            //echo "<script>alert('Image is too big. Image has to be maximum 3MB.');</script>";

            //podeli sliku  na 4 dela is sacuvaj sva cetri dela u bazi, pa onda kad se trazi note u kome je ta slika, spoji te delove u jednu.
            
            //DivideImage($image);
                // DivideImageByID($imageid);
        }

        $conn2 = connectToDb();
        $imageid = -2;
        $userid = GetUserId();
        $sql2 = "SELECT MAX(ImageID), FK_UserID FROM Image INNER JOIN User ON UserID = FK_UserID WHERE FK_UserID=".GetUserId();
        $result = $conn2 -> query($sql2);
        if($result->num_rows==1) {
            $imageid = $result->fetch_assoc()['MAX(ImageID)'];
            //echo "<script>alert('prosao proveru da li je poslednji user ubacio sliku: ' + ".$imageid.");</script>";
            echo $imageid;
                
        }


    }

  


    InsertImage();



    // echo " <script src='../../js/jquery.js'> alert('alert');
    
    // //$('#note_text>img:last-child').attr('id', '".$imageid."');
    // //alert('id: ' + $('#note_text>img:last-child').attr('id'));
    // </script>";

    // //ubaci u NOTE CONTENT U IMG TAG KOJI SADRZI SLIKU SA ID $imageid
    // echo "
    //     <script src='../../js/jquery.js'>
    //         //$('#note_text > img:last-child').attr('img_id', '".$imageid."');
    //         alert('alert');
    //         //alert('id: ' + $('#note_text > img:last-child').attr('img_id'));    
    //     </script>";
?>