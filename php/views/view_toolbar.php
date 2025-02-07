<?php
    include_once("../connectToDb.php");
    include_once("../operations/get_category_id_by_name.php");

    $categoryid;
    if (isset($_GET['categoryid'])) {
        $categoryid = $_GET['categoryid'];
        // Fetch data related to the note ID from the database
        //echo "CATEGORY FROM QUERY STRING " .$categoryid;
    }
    $toolbar =  
    "
  
    <div style='width: 100%'>

        <div class='note-width ' style='margin-left: 15%'>
                
                
                <span class='d-flex rounded-2 toolbar toolbar-width' style='border: 1px solid #eee; height: 50px; padding-top: 3px; padding-left: 5px;  position: fixed; margin-top: -40px;  margin-bottom: 10px; background-color: white; z-index:1;  ' >
                    <span style='justify-content: space-between; display: inline-block; position: relative; width: 100%;' >
                        <span>
                            <label style='cursor: pointer;' for='add_image'><img name='icon' src='images/add_image_52.png' width='40' height='40'/></label>
                            <input id='add_image' type='file' class='form-control' style='display: none'  accept='image/*'  name='image'/> 
                            <input type='submit' id='submit_image' hidden/>
                        </span>
                        <span id='font_operations' >
                            <img width='24' height='24' src='images/bold-24.png' style='cursor: pointer;' name='icon' id='bold'/>
                            <img width='24' height='24' src='images/italic-24.png' style='cursor: pointer;' name='icon' id='italic'/>
                            <img width='24' height='24' src='images/underline-24.png' style='cursor: pointer;' name='icon' id='underline'/>
                        </span>

                        <span style='display: inline-block; ' >
                            <label class='ms-4 categories-title'>Categories:</label>
                            
                            <select id='categories' class='form-control ms-4 arrow categories-title' >
                            ";
                                $conn = connectToDb();
                                $sql = "SELECT * FROM Category";
                                $result = $conn->query($sql);
                                if($result->num_rows>0) {
                                    while($row = $result->fetch_assoc()){
                                        $id = $row["CategoryID"];
                                        $name = $row["CategoryName"];
                                        $description = $row["Description"];
                                        $selected = ($categoryid == $id)?'selected':''; 
                                        $toolbar.=  "<option value = '".$id."' ".$selected.">".$name."</option>";
                                    } 
                                }
                            
                            $toolbar.= "
                            
                            </select>
                            
                            <span  class='categories-mobile-display' >
                                <img  width='28' height='28' src='images/categories.png' style='cursor: pointer; ' name='icon' id='categories_icon'/>
                            </span>

                            <div id='categories_mobile'  class='categories-mobile-hide' style='position: absolute'>
                               
                                <ul class='categories-ul'>";
                                    
                                    $conn = connectToDb();
                                    $sql = "SELECT * FROM Category";
                                    $result = $conn->query($sql);
                                    if($result->num_rows>0) {
                                        $id = GetCategoryIdByName("No category");
                                        $toolbar.= "<li name='category_mobile' categoryid = '".$id."'>No category</li>";

                                        while($row = $result->fetch_assoc()){
                                            
                                            $id = $row["CategoryID"];
                                            $name = $row["CategoryName"];
                                            
                                            if($name == "No category") continue;

                                            $description = $row["Description"];
                                            $toolbar.=  "<li name='category_mobile' categoryid = '".$id."'>".$name."</li>";

                                        } 
                                     }
    

                                $toolbar .= "</ul>
                            </div>

                            <span class='my-tooltip'>".$description."</span>

                            

                        </span>

                    
                        <span id='operations' style='float: right;'> 
                            
                            <input class='btn btn-light large-screen-cancel' style='margin: 2px;  type='submit' value='Cancel' id='cancel_editing_note_goto_versions_as_cards' />

                            <img class='small-screen-cancel'  src='images/close-24.png' width='30'  height='30' id = 'cancel_editing_note_goto_versions_as_cards_small_screen' style='margin: 2px;'  />
                            
                            <input class='btn btn-success large-screen-save' style='margin: 2px; ' type='submit' value='Save Note' id='save_edited_note' /> 

                            <img class='small-screen-save' src='images/save-24.png' width='30'  height='30' id = 'save_edited_note_small_screen' style='margin: 2px; '/>

                        </span>
                        

                        <script>
                            if(window.innerWidth < 1081) { 
                                $('#cancel_editing_note_goto_versions_as_cards').css('display', 'none'); 
                                $('#cancel_editing_note_goto_versions_as_cards_small_screen').css('display', 'inline'); 
                                
                            }
                        </script>
                        
                    </span>

                </span>
            </div>
    </div>";
    echo $toolbar;
?>