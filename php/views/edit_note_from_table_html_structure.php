<?php

    
    include_once("../connectToDb.php");
    include_once("../operations/get_category_id_by_name.php");
    
    $html_structure =  
    "
  
    <div style='width: 100%; '>

        <div class='note-width ' style='margin-left: 5%' >
        
        
                <div class='d-flex rounded-2 toolbar toolbar-width' style='flex-direction: row; border: 1px solid #eee; padding-left: 5px; margin-left:10px; position: fixed; margin-top: -30px;  margin-bottom: 10px; background-color: white; z-index:1; ' >
                    <div style='justify-content: space-between; display: inline; position: relative;' >
                        <label style='cursor: pointer;' for='add_image'><img name='icon' src='images/add_image_52.png' width='40' height='40'/></label>
                        <input id='add_image' type='file' class='form-control' style='display: none'  accept='image/*'  name='image'/> 
                        <input type='submit' id='submit_image' hidden/>

                        <span id='font_operations'>
                            <img width='24' height='24' src='images/bold-24.png' style='cursor: pointer;' name='icon' id='bold'/>
                            <img width='24' height='24' src='images/italic-24.png' style='cursor: pointer;' name='icon' id='italic'/>
                            <img width='24' height='24' src='images/underline-24.png' style='cursor: pointer;' name='icon' id='underline'/>
                        </span>

                        <span >
                            <label class='ms-4 categories-title' >Categories:</label>
                            
                            <select id='categories' style='width: 200px;  '  class='form-control ms-4 arrow categories-title' >
                            ";
                                $conn = connectToDb();
                                $sql = "SELECT * FROM Category";
                                $result = $conn->query($sql);
                                if($result->num_rows>0) {
                                    while($row = $result->fetch_assoc()){
                                        $id = $row["CategoryID"];
                                        $name = $row["CategoryName"];
                                        $description = $row["Description"];
                                        $html_structure .= "<option value = '".$id."'>".$name."</option>";
                                    } 
                                }
                            
                            $html_structure .= "
                            
                            </select>

                            <img class='categories-icon' src='images/categories.png' width='28' height='28' style='cursor: pointer;' name='icon' id='categories_icon'/>
                
                            <div id='categories_mobile' class='categories-mobile-hide ' style='position: absolute'>
                                <ul class='categories-ul'>";
                                    
                                    $conn = connectToDb();
                                    $sql = "SELECT * FROM Category";
                                    $result = $conn->query($sql);
                                    if($result->num_rows>0) {
                                        $id = GetCategoryIdByName("No category");
                                         $html_structure .= "<li name='category_mobile' categoryid = '".$id."'>No category</li>";

                                        while($row = $result->fetch_assoc()){
                                            
                                            $id = $row["CategoryID"];
                                            $name = $row["CategoryName"];
                                            
                                            if($name == "No category") continue;

                                            $description = $row["Description"];
                                             $html_structure .= "<li name='category_mobile' categoryid = '".$id."'>".$name."</li>";

                                        } 
                                     }
    

                                 $html_structure .= "</ul>
                            </div>

                            <span class='my-tooltip'>".$description."</span>

                            


                        </span>
                        
                        
                    </div>
                    

                     <span id='operations' style='float: right;'> 
                        <input class='btn btn-light large-screen-cancel' style='margin: 2px;  type='submit' value='Cancel' id='cancel_note' />


                        <img class='small-screen-cancel'  src='images/close-24.png' width='30'  height='30' id = 'cancel_note_small_screen' style='margin: 2px;'  />
                        
                        <input class='btn btn-success large-screen-save' style='margin: 2px; ' type='submit' value='Save Note' id='save_edited_note' /> 

                        <img class='small-screen-save' src='images/save-24.png' width='30'  height='30' id = 'save_edited_note_small_screen' style='margin: 2px; />
                    </span>
                    <script>
                        if(window.innerWidth < 1081) { 
                            $('#cancel_note').css('display', 'none'); 
                           
                            $('#cancel_note_small_screen').css('display', 'inline'); 
                            $('.toolbar').css('width', '100%'); 
                           
                        }
                    </script>
                        

                </div>
        </div>

    <!--<form>
        <div  class='note-width form-note-margin-left note-margin-left' id='note_container'  style='width: 90%;'>
            <div  style='z-index:-1;'>
                
                    <input id='note_title' name='note_title' class='note-width form-control m-2 ' style='position: relative; top: 20px;'  type='text' placeholder='Note title' />
                    <div id='note_text' name='note_text' style='display: inline-block; position: relative; top: 20px; width: 90%;' class='note-content form-control m-2 border border-success' placeholder='Text'  contentEditable='true'>
                        
                    </div>

            </div>
    </form>-->
      

    </div>
    </div>

    ";
    echo  $html_structure;

    /*
      //  echo "<span>notecontent: ".$note->getContent()."</span>";

        $content = "";
        $sql = "SELECT * FROM Image WHERE FK_NoteID = ".$note->getID();
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $content = $note->getContent();
                $imageid = $row['ImageID'];
                //$content = str_replace('/', '\/', $content);
                //$content = preg_replace('[<img imageid="'.$imageid.'" src="blob.* />]', '<img class="note-image" imageid="'.$imageid.'" src="image_'.$imageid.'.jpg"/>', $content); 
            }
        }

    echo "
        <script>
            //alert('".$note->getContent()."');
            //console.log('Cont:".$note->getContent()."');

            $('#note_title').val('".$note->getTitle()."');
            $('#note_text').html('".$content."');
            $('#additional_data').attr('notenumber', '".$note->getNoteNumber()."');
            $('#additional_data').attr('category_id', '".$note->getFK_CategoryID()."');

            console.log('Note number attr: ' + $('#additional_data').attr('notenumber'));

        </script>
    </div>
    </div>
    ";   */


?>