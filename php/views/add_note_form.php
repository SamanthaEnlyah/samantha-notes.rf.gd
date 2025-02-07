<?php

    include_once("../connectToDb.php");
    include_once("../operations/get_category_id_by_name.php");

    $date = date("Y.m.d H:i:s");    
    echo 
    "
<!--<div id='date_modified'>'.$date.'</div>,  -->
  
    
        
        <div class='note-width form-note-margin-left form-note-size' >
                
                
                <div class='d-flex rounded-2 toolbar' style='flex-direction: row; border: 1px solid #eee; padding-left: 5px; margin-left:10px; position: fixed; margin-top: -30px;  margin-bottom: 10px; background-color: white; z-index:1; width: 65%; height: 40px;' >
                    <div style='justify-content: space-between; display: inline; position: relative; width: 100%; ' >
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
                                        echo "<option value = '".$id."'>".$name."</option>";
                                    } 
                                }
                            
                            echo "
                            
                            </select>

                            <img class='categories-icon' src='images/categories.png' width='28' height='28' style='cursor: pointer;' name='icon' id='categories_icon'/>
                
                            <div id='categories_mobile' class='hide' style='position: absolute'>
                                <ul class='categories-ul'>";
                                    
                                    $conn = connectToDb();
                                    $sql = "SELECT * FROM Category";
                                    $result = $conn->query($sql);
                                    if($result->num_rows>0) {

                                        $id = GetCategoryIdByName("No category");
                                        echo "<li name='category_mobile' categoryid = '".$id."'>No category</li>";

                                        while($row = $result->fetch_assoc()){
                                            $id = $row["CategoryID"];
                                            $name = $row["CategoryName"];

                                            if($name == "No category") continue;

                                            $description = $row["Description"];
                                            echo "<li name='category_mobile' categoryid = '".$id."'>".$name."</li>";
                                            //echo "<script>$('#noteid').text('".$name."');</script>";

                                        } 
                                     }


                                echo "</ul>
                            </div>

                            <span class='my-tooltip'>".$description."</span>

                        </span>
                        
                        
                    </div>

                   


                    <span id='operations' style='width: 200px;'> 
                        <span class='btn btn-light' style='margin: 2px; display: inline-block;' type='submit'  id='cancel_note' >Cancel</span>
                        <img src='images/close-24.png' width='30'  height='30' id = 'cancel_note_small_screen' style='margin: 2px; display: none;'  />
                        <span class='btn btn-success' style='margin: 2px; display: inline-block;' type='submit' value='Save Note' id='save_note' >Save</span> <!--form='form_note'-->
                         
                    </span>
                   
                    <script>
                        if(window.innerWidth < 1081) { 
                            $('#cancel_note').css('display', 'none'); 
                        
                            $('#cancel_note_small_screen').css('display', 'inline'); 
                            $('.toolbar').css('width', '85%'); 
                            $('#operations').css('width','230px');
                            
                            $('#categories_icon').css('display', 'inline'); 
                            $('#categories_mobile').addClass('hide'); 
                        }
                        $(window).resize(function() {
                            if(window.innerWidth < 1081) { 


                                $('#cancel_note').css('display', 'none'); 
                            
                                $('#cancel_note_small_screen').css('display', 'inline'); 
                                $('.toolbar').css('width', '85%'); 
                                $('#operations').css('width','230px');
                                
                                
                                $('#categories_icon').css('display', 'inline'); 
                                $('#categories_mobile').addClass('hide'); 

                                
                            }
                        });
                    </script>

                </div>
        </div>

    <!--<form  enctype='multipart/form-data' id='form_note'>-->
    
        <div  class='note-width form-note-margin-left' id='note_container' >
            <div class='note-width' style='z-index:-1;'>
                <div class='note-editor'  >
                    
                        <input   id = 'note_title'   class='form-control m-2 title-width' style='position: relative; top: 20px;  '   type='text' placeholder='Note title' required/>
                    

                    
                        <div id = 'note_text'    class='note-content form-control m-2 border border-success note-content-width '  style='position: relative; top: 20px; ' placeholder='Text' required contentEditable='true'>
                            
                        </div>
                    
                </div>
            </div>
        </div>
    <!--</form>-->
            <script>
                $('#note_title').css('width','135%');
                $('#note_text').css('width','135%');
            </script>
      


    ";

?>