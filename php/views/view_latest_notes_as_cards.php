<?php

        include_once("../operations/get_latest_note_version.php");
    include_once("../operations/get_user_data.php");
    include_once("../model/Note.php");

    function GetNotesAsCards(){
        $conn = connectToDb();
        $notenumbers = GetAllNoteNumbersActionCreated();

        echo "<div>";

            
        echo "<div class='container'>";

            //$numberofcolumns = $srceenwidth/$cardwidth;

            $columnscounter = -3;
            
            $numberOfNotes = sizeof($notenumbers);
            //$numberOfRows = $numberOfNotes/4 + 1;
            $rowscounter = 0;

      
            $firstrow = true;
            
            foreach($notenumbers as $notenumber){
                    if($firstrow) {
                        //echo "zapocet prvi red "
                        echo "<div class='row'>";
                        
                        $firstrow = false;
                    }
                    
                    if($columnscounter % 4 == 1) {
                        //echo "zapocet ".$rowscounter.". red "
                        echo "<div class='row'>";
                    }
                     
                    //echo "zapoceta ".$columnscounter.". kolona"
                    echo "<div class='col-lg-3'>";

                        $noteLatestVersion = GetLatestVersion($notenumber);

                        echo "<a name='open_note_versions_as_cards' notenumber='".$notenumber."'  style='text-decoration: none;'>";

                        echo "<div class='card text-white bg-success mb-3' >"; //style='max-width: 20rem; margin-bottom: 20px; padding:0px; margin-left: 10px;'

                            
                            $title =($noteLatestVersion->getTitle() == "")?"Untitled":$noteLatestVersion->getTitle();
                            $date = $noteLatestVersion->getCreationDate();
                            $content_peek = $noteLatestVersion->getContentPeek();



                            echo "<span class='card-header'>".$date."</span>";

                            echo "<div class='card-body'>
                                <h4 class='card-title'>".$title."</h4>
                                <p class='card-text'>".$content_peek."</p>
                            </div>";

                        echo "</div>";        
                        echo "</a>";

                    //echo "zavrsena ".$columnscounter." kolona
                    echo "</div>";     

                    
                    
                if($columnscounter % 4 == 0) {
                    echo "</div>";
                    $rowscounter++;
                }

                $columnscounter++;
  
            }

        echo "</div>"; 
        // echo "</div>"; 
        $conn->close();
    }




     function GetAllNoteNumbersActionCreated(){

        $userid = GetUserId();
        $actionId = GetActionID('created');
        $conn = connectToDb();

        // Prepare a SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT DISTINCT NoteNumber FROM Note INNER JOIN Version ON NoteID=FK_NoteID WHERE Note.FK_UserID=? AND FK_ActionID=?");
        $stmt->bind_param("ii", $userid, $actionId);
        $stmt->execute();
        $result = $stmt->get_result();

        $noteNumbers = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $noteNumbers[] = $row["NoteNumber"];
            }
        } else {
            // Log error or send an error response
            echo "No notes found or query failed: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        return $noteNumbers;

        // $userid = GetUserId();
        // $sql = "SELECT DISTINCT NoteNumber FROM Note INNER JOIN Version ON NoteID=FK_NoteID WHERE Note.FK_UserID=".$userid." AND FK_ActionID = ".GetActionID('created'); //   * 
        // $conn = connectToDb();
        // $result = $conn->query($sql);

        // $noteNumbers = array();
        // if($result->num_rows>0){
        //     while($row = $result->fetch_assoc()){
        //         $noteNumber = $row["NoteNumber"];
        //         array_push($noteNumbers, $noteNumber);
                
        //     }
        // }
        // $conn->close();
        // return $noteNumbers;
    }


    //moze da se desi da korisnik izbrise glavni note (ciji je Action created). Onda ostaju samo oni koji su edited. Kada ostane samo edited onda se taj note ne prikazuje u prikazu svih note-ova (zbog *). Zato mora prvo da se proveri da li postoji created za taj note i ako ne postoji onda se prikazuje prvi sledeci po datumu - prvi najstariji
    // function NoteHasCreatedAction($notenumber){
    //     $sql = "SELECT * FROM Note INNER JOIN Version ON NoteID = FK_NoteID WHERE NoteNumber=".$notenumber. " AND FK_ActionID = ".GetActionID("created");
    //     $conn = connectToDb();
    //     $result = $conn->query($sql);
    //     if($result->num_rows==1){
    //         //$row = $result->fetch_assoc();
    //         return true;
    //     }
    // }
    GetNotesAsCards();


     // echo "number of notes: ".$numberOfNotes;

            //$numberofrows = round($numberOfNotes/$numberofcolumns) + 1;
            //$numberofcolumns;
            //echo "number of rows: ".$numberofrows;



                       // echo "<div class='row'>";
                    
                    

                    //echo "<div class='col-lg-3'>";
?>

