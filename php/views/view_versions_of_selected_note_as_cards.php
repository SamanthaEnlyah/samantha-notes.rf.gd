<?php


     include_once("../connectToDb.php");
    include_once("../operations/get_category_name_by_id.php");
    include_once("../model/Note.php");

   
    $noteNumber= $_POST['notenumber'];
    echo "<script>console.log('note number: ' + '".$noteNumber."' );</script>";
    $sql = "SELECT * FROM Note INNER JOIN Version ON NoteID = FK_NoteID WHERE NoteNumber = ".$noteNumber;
    $conn = connectToDb();
    $result = $conn->query($sql);

        echo "<div style='margin: 0 auto;'>";

        echo "<div class='container'>";

        $notes = array();
        $firstrow = true;
        $columnscounter = -3;

       //$counter = 0;
        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){

                 if($firstrow) {
                        //echo "zapocet prvi red "
                    echo "<div class='row' >";
                    
                    $firstrow = false;
                }
                
                if($columnscounter % 4 == 1) {
                    //echo "zapocet ".$rowscounter." red "
                    echo "<div class='row' >";
                }
                    
                //echo "zapoceta ".$columnscounter." kolona"
                echo "<div class='col-lg-3'>";
                    
                $NoteLatestVersion = new Note();
                $NoteLatestVersion->setID($row["NoteID"]);

               

                echo "<div class='card' noteid='".$row["NoteID"]."'>";


                $NoteLatestVersion->setNoteNumber($row["NoteNumber"]);
                $NoteLatestVersion->setTitle($row["Title"]);
                $NoteLatestVersion->setCreationDate($row["Date"]);
                $NoteLatestVersion->setContent($row["Content"]);
                $NoteLatestVersion->setFK_CategoryID($row["FK_CategoryID"]);


                echo "<span class='card-header'>".$NoteLatestVersion->getCreationDate()."<span style='float: right;'>".$NoteLatestVersion->getNoteNumber()."</span></span>";
                echo "<span class='card-header'>Category: ".GetCategoryNameByID($NoteLatestVersion->getFK_CategoryID())."</span>";
                
                echo "<div class='card-body' id='open_note_from_cards' style='cursor: pointer;' noteid='".$row["NoteID"]."' categoryid='".$NoteLatestVersion->getFK_CategoryID()."'>";
                
                

                echo "<h4 class='card-title'>".$NoteLatestVersion->getTitle()."</h4>";

                $length = (strlen($NoteLatestVersion->getContent()));
               

                $sufix = (strlen($NoteLatestVersion->getContent()) >= 150)?"...":"";
                $notecontentpeek = substr($NoteLatestVersion->getContent(), 0, 150) . $sufix;
                
                //ovde stane kad otvorim "Intelligence let's face it intel"
                    echo "<script>console.log('content peek: ' + '".$notecontentpeek."');</script>";
                echo "<p class='card-text'>".$notecontentpeek."</p>";
               
            
               echo "</div>";


                echo "<div class='card-footer'>";
                echo "<span id='edit_from_card' noteid='".$row["NoteID"]."' notenumber='".$NoteLatestVersion->getNoteNumber()."' style='cursor: pointer; margin-right: 20px;'><img src='images/edit-26.png' /></span>";
                echo "<span style='float: right;' id='delete_from_card' noteid='".$row["NoteID"]."' notetitle='".$NoteLatestVersion->getTitle()."' notenumber='".$NoteLatestVersion->getNoteNumber()."' style='cursor: pointer;'><img src='images/delete-red-26.png' /></span>";
                echo "</div>";
                
                

                //close card
                echo "</div>";


                if($columnscounter % 4 == 0) {
                    echo "</div>";
                }
               
               //close column
                echo "</div>";

                $columnscounter++;


                echo "</br>";
               
            }
            echo "</div>";
        }

        //close cards container
        echo "</div>";

?>