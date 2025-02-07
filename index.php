<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap-sandstone.css"/>
        <link rel="stylesheet" href="css/forms.css"/>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
        <script src="js/jquery.finger.js"></script>
        <title>Notes</title>
        <style>
            .round-top{
                border-top: 1 px solid black;
                border-top-left-radius: 6px;
                border-top-right-radius: 6px;
            }

            .my-shadow {
                -webkit-filter: drop-shadow(5px 5px 5px #222);
                filter: drop-shadow(4px 4px 3px #222);
            }

            // .my-tooltip{
            //     width: 100px;
            //     height: 80px;
            //     z-index: 20;
            //     position: absolute;
            //     top: 0px;
            //     left: 0px;
            //     border: 1px solid black;
            // }

            .arrow{


                appearance: none;
                background-image: url("images/arrow-down-32.png");
                background-repeat: no-repeat;
                background-position: right 0.7rem top 50%;
                background-size: 1rem auto;

                border: 1px solid #efefef;
                margin: 1.5px;
            }

            .categories-title{
                display: inline-block;
            }

            .categories-icon{
                display: none;
            }

            .categories-mobile-hide{
                display: none;
            }


            .large-screen-save{
                display: inline;
            }

            .large-screen-cancel{
                display: inline;
            }
            

            .small-screen-cancel{
                display: none;
            }

            .small-screen-save{
                display: none;
            }

            @media (max-width: 1080px){

                
                .small-screen-cancel{
                    display: inline;
                }

                .large-screen-cancel{
                    display: none;
                }

                .small-screen-save{
                    display: inline;
                }

                .large-screen-save{
                    display: none;
                }

                /* .categories-icon{
                    display: inline-block;
                } */

                .categories-title{
                    display: none;
                }

                /* .categories-mobile-show{
                    display: inline-block;
                    position: absolute;
                } */

                .categories-ul{
                    width: 140px;
                    list-style-type: none;
                    padding: 0px;
                    font-size: 1.0rem;
                    line-height: 2.1rem;
                    background-color: white;
                    color: #00ba00;
                    border: none; 
                }

                [name='category_mobile']{
                    border: 1px solid #00bb00;
                    border-radius: 3px;
                    padding: 6px;
                    margin-bottom: 2px;
                    cursor: pointer;
                    width: 140px;
                }

                [name='category_mobile']:hover{
                    color: #228800;
                    font-weight: bold;
                    border: 3px solid #229900;
                    box-shadow: 3px 3px 3px;
                }

                /* .category-selected{
                    color: #aa00dd;
                    font-weight: bold;
                    border: 3px solid #ee00ff;
                    box-shadow: 3px 3px 3px;
                } */

                #cancel_note{
                    display: none;
                }
                
                .toolbar-width{
                    display: inline-block;
                    width: 85%;
                    margin-left: 8%;
                }

                #note_container{
                    margin-left: 5%;
                    width: 95%;
                }
                
            }
            
            @media (min-width: 1081px){
                .toolbar-width{
                    width: 80%;
                }

                .note-width{
                    width: 90%;
                }
               
            }

          
            @media (min-width: 1501px){
                .toolbar{
                    margin-left: 16%; 
                    width: 66%;
                }

                .form-note-margin-left{
                    margin-left: 16%;
                    width: 82%;
                    
                }
            }

            .note-image{
                width: 100px;
                
            }
            
            .hide{
                display: none;
            }

            .show-block{
                display: block;
            }

            .show-inline{
                display: inline;
            }
                
            #categories_icon{
                display: none;
            }
          
        </style>
    </head>

    <body id='body'>

        <div id='navbar_content'>
            <?php include('html/navbar.php'); ?>
        </div>

        <div style="margin: 100px;"></div>

    

        <main id='main'>

            
            
            <div id = 'content_peek' style='position: absolute;'>
            </div>  
            
            <div id="content">
                
                
            </div>
        <!--<input type="text" id="input_note_text"/>-->

        <div class='modal'  id='modal_delete_note' style='display: none'>
            <div class='modal-dialog' role='document' style='border: 1px solid red;'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' style='color: red;'>Delete note</h5>
                    <button id='delete_close' type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p id='question'> </p>
                </div>
                <div class='modal-footer'>
                    <button id='delete_yes' type='button' class='btn' style='background-color: red; color: white;'>Yes</button>
                    <button id='delete_no' type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                </div>
                </div>
            </div>
        </div>


        
        <div class='modal'  id='modal_delete_note_from_table' style='display: none'>
            <div class='modal-dialog' role='document' style='border: 1px solid red;'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' style='color: red;'>Delete note</h5>
                    <button id='delete_close' type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p id='question_table'> </p>
                </div>
                <div class='modal-footer'>
                    <button id='delete_from_table_yes' type='button' class='btn' style='background-color: red; color: white;'>Yes</button>
                    <button id='delete_from_table_no' type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                </div>
                </div>
            </div>
        </div>

        <div id='note_edit_form'></div>
            
        </main>



        <img id='test_image'/>

        <div id='data'></div>
    
        <div id='response'></div>

        <div id='test'></div>
        
        <label id='noteid'></label>

        <label id='delete_noteid' noteid=''></label>

        <label id='saved_noteid'></label>

        <?php include_once('html/footer.html'); ?>
        
        
        <script>

            //drag is movement of finger on touchscreen
            $("body").on("tap", "#categories_ul", function(){

                alert("tapped (dragged?)");
                //$('#categories_ul').css("display", "none");
                 
            });

            $('body').on('click', '#categories_icon', function(){
                if($('#categories_mobile').hasClass('hide')){
                    //alert("has class hide");
                    $('#categories_mobile').removeClass('hide');
                    $('#categories_mobile').addClass('show-block');  
                } else {
                    //alert("has class show");
                    $('#categories_mobile').removeClass('show-block'); 
                    $('#categories_mobile').addClass('hide');  
                }
            });

            function toggleContentClass(){
                if($("#content").hasClass("content-width ")){
                    $("#content").addClass("content");
                    $("#content").removeClass("content-width");
                } else {
                    $("#content").removeClass("content");
                    $("#content").addClass("content-width");
                }
            
            }


            function setContentWidthClassOnContent(){
                $("#content").removeClass("content");
                $("#content").addClass("content-width");
            }

            function removeContentWidthClassOnContent(){            
                $("#content").addClass("content");
                $("#content").removeClass("content-width");
            }
            //show action form
            $('body').on('click', '#add_action', function(){
                removeContentWidthClassOnContent();
                $.ajax({
                    type: "post",
                    url: "php/views/add_action_form.php",
                    data: "",
                    success: function(response){
                        $("#content").html(response);
                    }
                });
            });

            //insert_action
            $('body').on('click', '#insert_action', function(){
                var action_name = $("#action_name").val();
                
                $.ajax({
                    type: "get",
                    url: "php/operations/insert_action.php",
                    data: "action_name=" + action_name,
                    success: function(response){
                        $("#content").html(response);
                    }
                });
            });

            //show category form
            $('body').on('click', '#add_category', function(){
                removeContentWidthClassOnContent();
                $.ajax({
                    type: "post",
                    url: "php/views/add_category_form.php",
                    data: "",
                    success: function(response){
                        $("#content").html(response);
                    }
                });
            });

            //insert category
            $('body').on('click', '#insert_category', function(){

                var category_name = $("#category_name").val();

                $.ajax({
                    type: "get",
                    url: "php/operations/insert_category.php",
                    data: "category_name=" + category_name,
                    success: function(response){
                        $("#content").html(response);
                    }
                });
            });

                $('body').on('click', '#view_categories', function(){
                    removeContentWidthClassOnContent();

                    $.ajax({
                            type: "post",
                            url: "php/views/view_categories.php",
                            data: "",
                            success: function(response){
                                $("#content").html(response);
                            }
                    });
                });

                $('body').on('click', '#category', function(){
                    var catID = $(this).attr('categoryID');
                    $.ajax({
                        type: 'get',
                        url: 'php/views/view_notes_by_category.php',
                        data: 'categoryid=' + catID,
                        success: function(response){
                            $("#content").html(response);
                        }   
                    });
                
                });


                // add note form
                $('body').on('click', '#add_note', function(){
                    setContentWidthClassOnContent();
                    $.ajax({
                        type: "get",
                        url: "php/views/add_note_form.php",
                        data: "",
                        success: function(response){
                            $("#content").html(response);
                        }
                    });
                
                });

                function show_notes_by_category(catID){
                    removeContentWidthClassOnContent();
                    $.ajax({
                        type: 'post',
                        url: 'php/views/view_notes_by_category.php',
                        data: 'categoryid=' + catID,
                        success: function(response){
                            $("#content").html(response);
                            
                        }   
                    });
                }
                
                //View actions
                $('body').on('click', '#view_actions', function(){
                    removeContentWidthClassOnContent();
                    $.ajax({
                        type: "get",
                        url: "php/views/view_all_actions.php",
                        data: "",
                        success: function(response){
                            $("#content").html(response);
                        }
                    });
                
                });


                function show_notes_by_action(actionID){
                    removeContentWidthClassOnContent();
                    $.ajax({
                        type: 'post',
                        url: 'php/views/view_notes_by_action.php',
                        data: 'actionid=' + actionID,
                        success: function(response){
                            $("#content").html(response);
                            
                        }   
                    });
                }


                $('body').on('click', '#signup', function(){
                    removeContentWidthClassOnContent();
                    $.ajax({
                        type: "get",
                        url: "php/views/sign_up_form.php",
                        data: "",
                        success: function(response){
                            $("#content").html(response);
                        }
                    });
                
                });

                $('body').on('click', '#login', function(){
                    removeContentWidthClassOnContent();
                    $.ajax({
                        type: "get",
                        url: "php/views/login_form.php",
                        data: "",
                        success: function(response){
                            $("#content").html(response);
                        }
                    });
                
                });

                $('body').on('click', '#pass_visibility', function(event){
                    event.preventDefault();
                    
                    if($('#pass').attr('type') == 'password'){
                        $('#pass').attr('type', 'text');
                        $('#eye').attr('src', 'images/closed_eye.png');
                    } else {
                        $('#pass').attr('type', 'password');
                        $('#eye').attr('src', 'images/open_eye.png');
                    }
                });

                $('body').on('click', '#pass_visibility_login', function(event){
                    event.preventDefault();
                    
                    if($('#pass_login').attr('type') == 'password'){
                        $('#pass_login').attr('type', 'text');
                        $('#eye').attr('src', 'images/closed_eye.png');
                    } else {
                        $('#pass_login').attr('type', 'password');
                        $('#eye').attr('src', 'images/open_eye.png');
                    }
                });

                $('body').on('mouseover', "[name='icon']", function(){
    
                    removeAllClasses();
                    $(this).addClass("my-shadow");
                });

                function removeAllClasses(){

                    $("[name='icon']").each(function( index ) {
                        $(this).removeClass("my-shadow");
                    });
                
                }

                $('body').on('mouseout', "[name='icon']", function(){
    
                    removeAllClasses();
                });

                //Text decoration
            $('body').on('click', "#bold", function(){
                        document.execCommand("bold");
                });

            $('body').on('click', "#italic", function(){
                        document.execCommand("italic");
            });

            $('body').on('click', "#underline", function(){
                        document.execCommand("underline");
            });

            $('body').on('click', "#register", function(){
                var email = $("#email").val();
                var password = $("#pass").val();

                //var saltBefore = "";
                //var saltAfter= "";

                $.ajax({
                    type: "post",
                    url: "php/operations/sign_up.php",
                    data: "email="+email + "&pass=" + password,
                    success: function (response){
                        $("#content").html(response);

                        $.ajax({
                            type: "get",
                            url: "html/navbar.php",
                            data: "",
                            success: function (response2){
                                //alert(response2);
                                $("#navbar_content").html(response2);
                                
                            }
                        });       
                    }
                });        
            });

            $('body').on('click', "#login_submit", function(){
                removeContentWidthClassOnContent();
                //alert('login submit pressed');
                var email = $("#email_login").val();
                var password = $("#pass_login").val();

                    //alert('email: ' + email + ", password: " + password);

                    $.ajax({
                        type: "post",
                        url: "php/operations/asdf.php",
                        data: "email="+email + "&pass=" + password,
                        success: function (response){
                            $("#content").html(response);

                                $.ajax({
                                    type: "get",
                                    url: "html/navbar.php",
                                    data: "",
                                    success: function (response2){
                                        //alert(response2);
                                        $("#logged_email").html(email);
                                        $("#logged_email").addClass("border rounded-2 p-2");
                                        $("#logged_email").removeClass("d-none");
                                        $("#navbar_content").html(response2);
                                        
                                    }
                                });       


                                



                        }
                    });




                        
            });

            $('body').on('click', "#logout", function(){
                $.ajax({
                    type: "get",
                    url: "php/operations/logOut.php",
                    data: "",
                    success: function (response){
                        $("#content").html(response);
                        $("#logged_email").html("");
                        $.ajax({
                            type: "get",
                            url: "html/navbar.php",
                            data: "",
                            success: function (response2){
                                $("#navbar_content").html(response2);

                                $.ajax({
                                    type: "get",
                                    url: "php/views/view_email_of_logged.php",
                                    data: "",
                                    success: function (response3){
                                        $("#logged_email").removeClass("border rounded-2 p-2");
                                        $("#logged_email").addClass("d-none");
                                        
                                        
                                    }
                                });
                                
                            }
                        });  

                        window.location.reload();
                    }
                });        
            });
            
            $('body').on('click', "#home", function(){
                removeContentWidthClassOnContent();
                $.ajax({
                    type: "post",
                    url: "php/operations/home.php",
                    data: "",
                    success: function(response){
                        $("#content").html(response);
                    }
                });
            });

                //  !!!
            // $('body').on('click', "#create_note", function(){
            //     setContentWidthClassOnContent();
            //     var noteTitle = $("#note_title").val();
            //     var noteContent = $("#note_text").html();



            //     $.ajax({
            //         type: "post",
            //         url: "php/operations/insert_note.php",
            //         data: "title=" + noteTitle + "&note=" + noteContent,
            //         success: function(response){
            //             //$("#content").html(response);
                       
            //         }
            //     });
            // });

                    
            // function getImgData() {
            //     const files = $("#add_image").files[0];
            //     if (files) {
            //         const fileReader = new FileReader(); 
            //         fileReader.readAsDataURL(files);
            //         fileReader.addEventListener("load", function () {

            //             $("#note_text").append(image);
            //         });    
            //     }
            // }

            // var loadFile = function(event) {
            //     var image = document.getElementById('test_image');
            //     image.src = URL.createObjectURL(event.target.files[0]);
            //     //alert(event.target.files[0].name);
                
            //     alert(URL.createObjectURL(event.target.files[0]));
            // }
           
    
        //*******************************************************************
            var note_text_is_clicked_or_typed = false;

             $('body').on('click', "#note_text", function(){
                console.log(document.getSelection().getRangeAt(0).startOffset);
                note_text_is_clicked_or_typed = true;
            });

         

            $('body').on('keydown', "#note_text", function(event){
                    console.log(document.getSelection().getRangeAt(0).startOffset);  
                    note_text_is_clicked_or_typed = true;
                   
            });

////////////////////////////////////////////////////
            // $("body").on("click", "#note_text", function(event) {
            //     var note_content = document.getElementById("note_text");
                
            //     // Check if the clicked element is inside the 'specialDiv'
            //     if (!note_content.contains(event.target)) {
            //         note_text_is_clicked_or_typed = false;
            //     } else {
            //         note_text_is_clicked_or_typed = true;
            //     }
            // });


             //document.body.addEventListener("click", function (evt) {
                //  var note_content = document.getElementById("note_text");
                // console.log("note-content exists with id: " + note_content.id);
                // // Check if the clicked element is inside the 'specialDiv'
                // if (!note_content.contains(event.target)) {
                //     note_text_is_clicked_or_typed = false;
                // } else {
                //     note_text_is_clicked_or_typed = true;
                // }


                 // code is on line: 1263
            //});


            var loadFile = function(event) {
                //var imgNode = $("<img>");

               // imgNode.attr("src",URL.createObjectURL(event.target.files[0]));
                //alert("event target files 0: " + URL.createObjectURL(event.target.files[0]));

                //imgNode.addClass("img-in-note");
                console.log(event.target.id);
                if(document.getSelection().anchorNode == document.getElementById("note_text")){
                    var imgNode = document.createElement("img");
                    //imgNode.setAttribute("height", 200);
                   // imgNode.setAttribute("width", 200);
                    imgNode.classList.add("img-in-note");
                    //document.getSelection().getRangeAt(0).insertNode(imgNode);
                        
                }
               // $("#note_text").append(imgNode);

                //document.getElementById('note_text').contentWindow.document.execCommand('insertHTML', false, imgNode);

                return imgNode;  

            };

            function GetSelectedTextElement() {
                const selection = window.getSelection();
                if (!selection.rangeCount) return null; // No selection

                const range = selection.getRangeAt(0); // Get the first range of the selection
                let container = range.commonAncestorContainer; // This can be a text node or an element

                // If the container is a text node, use its parent element
                if (container.nodeType === Node.TEXT_NODE) {
                    container = container.parentNode;
                    //return null;
                }

                return container;
            }
            
            var imageids = new Array();

            function insertIntoDatabase(){
                //if(imgnode == null) return;
                //$('#submit_image').click();
                // $.ajax({
                //     type: 'post',
                //     url: 'php/operations/insert_image.php',
                //     data: 'imageurl='+URL.createObjectURL(event.target.files[0]),
                //     success: function(response){
                //             alert('success: ' + response);
                //     }
                // });
                //$('#submit_image').click().preventDefault();

                    // console.log("note text element: " + document.getElementById("note_text").id);
                    // console.log("selected element: " + GetSelectedTextElement().id);
                    // if(GetSelectedTextElement().id == document.getElementById("note_text").id){
                    // console.log("func INSERT INTO DATABASE: note_text_is_clicked_or_typed is " + note_text_is_clicked_or_typed);
                   // if(note_text_is_clicked_or_typed){
                        var imageid = 0;

                        var fileInput = document.getElementById('add_image');
                        var file = fileInput.files[0];
                        var formData = new FormData();
                        formData.append('file', file);


                        //var noteid = $("#saved_noteid").html();
                        
                        //alert("noteid=" + noteid);

                        var extension = ExtractExtension();

                        formData.append('extension', extension);

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'php/operations/insert_image.php', true);
                        xhr.onload = function (responseText) {
                            if (xhr.status == 200 && xhr.readyState == 4) {
                                console.log("" + this.responseText);

                                //console.log("offset: " + document.getSelection().getRangeAt(0).startOffset);

                                imageid = this.responseText;
                                alert("sacuvana slika: " + imageid);
                                //Tabela Image u bazi ima strani kljuc FK_NoteID. Trebaju mi ID-jevi svih slika koje su ubacene u tabelu da bih postavila svima isti FK_NoteID nakon sto se Note napravi. 
                                //Posle insertNote u php-u, odnosno Save Note-a u index.php , treba ocistiti niz imageids.
                                imageids.push(imageid);
                                //imgnode.setAttribute("imageid", imageid);

                                
                                GetImageBlobFromDbAndViewInNote(imageid, file);



                            //imgNode.setAttribute("src",URL.createObjectURL());


                                // Handle response here (e.g., display it in the page)
                                //document.getElementById('response').textContent = this.responseText;
                            }
                        };
                        xhr.send(formData);
                 //   }
            }

            function GetImageBlobFromDbAndViewInNote(imageid, image) {
              
              //*************************************************************** THIS IS NEEDED, 1st way
                    
                //     var xhr = new XMLHttpRequest();
                //     xhr.open('GET', 'php/operations/get_blob_by_image_id.php?imageid='+imageid, true);
                //     xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd/site-test");
                 
                //     xhr.responseType = "blob";
                //     xhr.onreadystatechange = function() {
                //         if (xhr.status == 200 && xhr.readyState == 4) {
                            
                //             var before = document.getElementById("note_text").innerHTML.substring(0,document.getSelection().getRangeAt(0).startOffset);
                //             var image = xhr.response;
                //             var after = document.getElementById("note_text").innerHTML.substring(document.getSelection().getRangeAt(0).startOffset);
                //             //alert(image);
                            
                //             var imageURL = URL.createObjectURL(image);
                //             //var imageURL = "blob:http://samantha-notes.rf.gd/509e6ad8-de66-40e1-bf6c-4b10f1b3a7fe";
                //             //var imageElement = document.createElement("img");
                //             //imageElement.setAttribute("src", imageURL);

                //             var imageString = " <img src='" + imageURL + "' class='img-in-note' /> ";
                //             //imgNode.classList.add("img-in-note");

                //             var imageElement = document.createElement("img");
                //             imageElement.innerHTML = imageString;

                //             document.getElementById("note_text").innerHTML = "";
                //             document.getElementById("note_text").append(before + imageString + after);
                           
                //         }
                //    };
                //    xhr.send();

                //**********************************************  2nd way


                var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'php/operations/get_blob_by_image_id.php?imageid='+imageid, true);
                    xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd");
                 
                    xhr.responseType = "blob";
                    xhr.onreadystatechange = function() {
                        if (xhr.status == 200 && xhr.readyState == 4) {
                            
                            var imageToInsert = xhr.response;
                            //var urlToImage = URL.createObjectURL(imageToInsert);
                            
                            //console.log("url to image: " + urlToImage);

                           // var imageElement = document.createElement("img");
                            //imageElement.src = urlToImage;

                            //insertHTML is command to insert html code at caret position. imageid is used to save and find image in database when displaying it in edit or view note. urlToImage is 
                            //URL that is made from blob object and is used to access this image. it uses blob protocol. it looks like this: 
                            //  blob:http://samantha-notes.rf.gd/df8272a4-364a-4e63-a48e-b1b934b4572d
                            
                            var extension = ExtractExtension();
                            alert("Extension: " + extension);
                            var width = image.width;
                            var height = image.height;
                           document.execCommand("insertHTML", false, '<img imageid="' + imageid + '" src="note-images/image_'+ imageid + '.' + extension + '" />');  //style="width: 45%; height: 45%;"  //width="'+width+'"  height="'+height+'" 
                            //var note_content = $("#note_text").html();

                            //var numberOfLines = note_content.split("<br>").length;
                            
                            //console.log("focusOffset: " + window.getSelection().focusOffset);
                            //console.log("anchorOffset: " + window.getSelection().anchorOffset);
                           
                        }

                    };
                xhr.send();

                //******************************************************

                // fetch('php/operations/get_blob_by_image_id.php?imageid='+imageid)
                // .then(response => response.blob()) // Make sure the server responds with the BLOB data
                // .then(blob => {
                //     var reader = new FileReader();
                //     reader.onload = function() {
                //     var dataUrl = reader.result;
                //     var imageElement = document.createElement('img');
                //     var img = imageElement;
                //     img.src = dataUrl;
                //     };
                //     reader.readAsDataURL(blob);
                // })
                // .catch(error => console.error('Error fetching the BLOB:', error));




                // $.ajax({
                //     method: 'post',
                //     url: 'get_blob_by_image_id.php',
                //     data: 'imageid='+imageid,
                //     success: function(response){
                //         console.log(response);
                //         //imgNode.setAttribute("src", URL.createObjectURL(this.response));
                //     }
                //  });

            }

            
                // $('body').on('click', '#submit_image', function(e){
                //     e.preventDefault();
                    
                // });

                // $('body').on('submit', '#image_form', function(e){
                //     //e.preventDefault();

                // });
            

            //  $('body').on('submit', '#image_form', function(event){
                    
            //         event.preventDefault();
            //  }

            function ExtractExtension(){
                var fileInput = document.getElementById('add_image');
                var file = fileInput.files[0];
                return file.name.split(".").pop();

                        
            }

            $('body').on('change', "#add_image", function(){
                
                //var imgnode = loadFile(event);
                insertIntoDatabase();
                //saveToFolder();
                //id se podesava u php fajlu InsertImage.php, na kraju koda
            });



            // $('body').on('click', "#submit_image", function(){
            
            // });

            // async function uploadFile() {
            //     const f = document.getElementById("form_note");
            //     let formData = new FormData(f); 
                    
            //     let response = await fetch('php/operations/insert_image.php', { 
            //         method: "POST", 
            //         body: formData
            //     }); 
                
            //      $("#content").html(response);
                    
            // }

            // $('body').on('click', "#submit_image", function(){
            //     var form = $("#form_note");
            //     $.ajax({
            //         type: 'post',
            //         url: 'php/operations/insert_image.php',    
            //         data: 'image='+ new FormData(form),
            //         success: function(response){
            //             //$("#note_text:last-child").attr("image_id", response_image_id);
            //             $("#content").html(response);
            //         }

            //     });
                
                
            // });

           

            $('body').on('click', "#save_note", function(){
                var title = encodeURIComponent($("#note_title").val());
                var content =  encodeURIComponent($("#note_text").html()); //var content = encodeURIComponent($("#note_text").html()); //
                var categoryid = encodeURIComponent($("#categories").val());
                //console.log("TEXTFROM ADDNOTE: " + content);
         
                

                //console.log(imageids);//console.log("encoded for php: " + imageidsJSONEncoded);

                var imageidsJSONEncoded = JSON.stringify(imageids);
                
                const note = new FormData();
                note.append("title", title);
                note.append("content", content);
                note.append("categoryid", categoryid);
                note.append("imageids", imageidsJSONEncoded);

                var requestURL = 'php/operations/insert_note.php?title=' + title + "&content=" + content + "&categoryid=" + categoryid + "&imageids=" + imageidsJSONEncoded;
                console.log("Request URL: " + requestURL);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'php/operations/insert_note.php', true); //?title=' + title + "&content=" + content+"&categoryid="+categoryid+"&imageids="+imageidsJSONEncoded
               // xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd");
            

                xhr.onreadystatechange = function(response) {
                    if (xhr.status == 200 && xhr.readyState == 4) {
                            console.log("response:");
                            $("#test").html(this.response);
                    }
                }
                xhr.send(note);



            /*    $.ajax({
                    type: "post",
                    url: "php/operations/insert_note.php",
                    data: "title=" + title + "&content=" + content+"&categoryid="+categoryid,
                    success: function(response){
                        //alert(response);
                        var noteid = response;

                        //var noteid = $("#saved_noteid").html();

                        console.log("noteid="+noteid);
                        imageids.forEach((imageid) => setNoteIDForImage(imageid, noteid));
                        imageids = new Array();
                      
                    }
                });*/
                
                
            });
            
            //SLEDECE: update_fknoteid_in_image
            
            
            function setNoteIDForImage(imageid, noteid){
                alert("ipak se pokrece. noteid:  " + noteid + ", imageid: " + imageid);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'php/operations/update_fknoteid_in_image.php?imageid='+imageid+'&noteid='+noteid, true);
                    xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd");
                xhr.onreadystatechange = function () {
                    if (xhr.status == 200 && xhr.readyState == 4) {
                            //TODO - show somehow that note has been SAVED
                            //$("#content").html(this.responseText);
                    }
                };
                xhr.send();

            }

            // $('body').on('click', "#", function(){
            //     //$sql = "INSERT INTO PICTURE";
            // });
            
            //categories_icon

           /* $('body').on('click', "#categories_icon", function(){
                if($("#categories_mobile").hasClass("categories-mobile-hide")) {
                    $("#categories_mobile").removeClass("categories-mobile-hide");
                    $("#categories_mobile").addClass("categories-mobile-show");
                }
                else {
                    $("#categories_mobile").removeClass("categories-mobile-show");
                    $("#categories_mobile").addClass("categories-mobile-hide");
                }
                
                //$("#categories-mobile").dialog();
            });*/


         /*   $('body').on('click', "[name='category_mobile']", function(){
                //$("#categories_mobile").removeClass("categories-mobile-show");
                //$("#categories_mobile").addClass("categories-mobile-hide");

                
                
            });*/

        

            window.onresize = (event) => {
                const heightOutput = $(window).height();
                const widthOutput = $(window).width();

                if(widthOutput > 1080){
                    $("#categories_mobile").removeClass("categories-mobile-show");
                    $("#categories_mobile").addClass("categories-mobile-hide");
                }
                
            };

            

            $('body').on('click', "#note_container", function(){
                
                $("#categories_mobile").removeClass("show-");
                $("#categories_mobile").addClass("categories-mobile-hide");

                
                
            });

        //  GET SELECTED NOTE CATEGORY
            $('body').on("click", "#categories_icon", function(){
                var noteid = $("#noteid").text();
                $.ajax({
                    type: "get",
                    url: "php/operations/get_selected_note_category.php",
                    data: "noteid="+noteid,
                    success: function(response){    
                        var categoryName = response;
                        $(".categories-ul li").each(function(index){
                            //alert("li");
                            if(response == $(this).val()){
                                $(this).addClass("category-selected");
                            }
                            
                        }) ;                  
                    }
                });
            });


            
            $('body').on("click", "#notes_table", function(){

                $.ajax({
                    type: "get",
                    url: "php/views/view_all_notes_in_table.php",
                    
                    success: function(response){    
                        $("#content").html(response);
                         $("#content_peek").hide();
                    }
                });
            });

            $('body').on("click", "[name='note']", function(){
                var notenumber = ($(this).attr("id").split("_")[2]);
                //alert(notenumber);
                $("#content_peek").show();
                OpenListOfNoteVersions(notenumber);
            });
            
            function OpenListOfNoteVersions(notenumber){
               // alert("DANGER");

                var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'php/views/view_all_note_versions_in_table.php?notenumber=' + notenumber, true);
                    xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd");
                 
                    xhr.onreadystatechange = function() {
                        if (xhr.status == 200 && xhr.readyState == 4) {
                           $("#content").html(this.response);
                           
                        }
                       
                    };
                xhr.send();

            }

            function GoBackToListOfVersions(){
                $("#note_edit_form").html("");
                var notenumber = $("#data").attr("notenumber");
                //alert("notenumber: " + notenumber);
                if(notenumber != undefined) OpenListOfNoteVersions(notenumber);

                // $.ajax({
                //     type: "get",
                //     url: "php/views/view_all_note_versions_in_table.php",
                //     data: "notenumber="+notenumber,
                //     success: function(response){
                //         $("#content").html(this.response);
                //         alert("notenumber: " + notenumber);
                //     }
                // });
            }

            
            function CloseEditForm(){
                $("#note_edit_form").html("");
            }

            $("body").on("click", ".dropdown-item", function(){
                CloseEditForm();
            });

            $("body").on("click", "#cancel_note", function(){
                GoBackToListOfVersions();
            });

            
        

            // $('body').on("click", "[name='edit']", function(){
            //     var noteid = $(this).attr("noteid");
            //     var notenumber = $(this).attr("notenumber");
            //             //alert("clicked on edit - success. notenumber:" + notenumber + "noteid:" + noteid);
            //     $.ajax({
            //         type: "get",
            //         url: "php/views/edit_note_form.php",
            //         data: "noteid="+noteid+"&notenumber="+notenumber,
            //         success: function(response){    
            //             $("#content").html(response);
                                              
            //             $("[imageid]").each(function(element) {
            //                 var id = $(this).attr("imageid");
            //                 var src = "image_" + id + ".jpg";   
                            
            //                 GetImageBlobFromDb(id);
                            
            //                 $(this).attr("src", src);

            //             });
            //         }
            //     });

            // });
         
            var htmlFromAddNote;
            var textFromAddNote;
            var noteContent;
            $("body").on("paste", "#note_text", function(event){
                event.preventDefault();
                //noteContent = $("<div></div>");
                //noteContent.html($("#note_text").html());

                    var pastedData = (event.originalEvent || event).clipboardData.getData('text/html');

                //alert("pasted");

                var arrayOfTags = ["p","h1","h2", "h3", "h4", "h5", "h6" ];
                var tempdiv = $("<div></div>");
                    tempdiv.html(pastedData);
                    //tempdiv = $("<div></div>");
                $.each(arrayOfTags, function(index, value){
                    console.log(index, value);
                    //tempdiv.find("h3").removeAttr("style");
                    
                    // Select all h3 elements in tempdiv
                    var h3Elements = tempdiv.find(arrayOfTags[index]);
                    
                    h3Elements.each(function( index ) {
                        $(this).before($(this).text());
                    });                  
                    
                    // Replace each h3 element with a <br> element
                    h3Elements.replaceWith('<br>');
                
                });

                arrayOfTags = ["ul", "ol", "li", "strong", "b", "i", "u", "span", "div", "main", "nav", "section", "aside" ];
                //tempdiv2 = $("<div></div>");
                    //tempdiv2.html(tempdiv);
                    //tempdiv = $("<div></div>");
                $.each(arrayOfTags, function(index, value){
                    console.log(index, value);
                    tempdiv.find(value).removeAttr("style");
                    

                    
                    
                    
                
                });

                //var processedData = noteContent.html() + tempdiv;
                $("#note_text").append(tempdiv);

                //$("#note_text>h3").removeAttr("style");
                //alert("changed pasted text");

                /*htmlFromAddNote = htmlFromAddNote.replace("<p[^>]*>", "<br>");
                htmlFromAddNote = htmlFromAddNote.replace("<\/p>", "<br>");
                htmlFromAddNote = htmlFromAddNote.replace("<h[1-6][^>]*>", "<br>");
                htmlFromAddNote = htmlFromAddNote.replace("<\/h[1-6]>", "<br>");
                htmlFromAddNote = htmlFromAddNote.replace("", "<br>");

                $(this).html("e pa sad");*/
                /*
                var pastedData = (event.originalEvent || event).clipboardData.getData('text/html');
                htmlFromAddNote = pastedData;
                console.log("HTML FROM ADD NOTE:" + htmlFromAddNote);

                htmlFromAddNote = htmlFromAddNote.replace("<br>","|*br|*");
                var tempdiv = $("<div></div>");
                tempdiv.html(htmlFromAddNote);
                textFromAddNote = tempdiv.text();
                textFromAddNote = textFromAddNote.replace("|*br|*", "<br>");
                console.log("FINAL TEXT: " + textFromAddNote);
                */

                //textFromAddNote = $(this).text();
                /*console.log($("#note_text").html());

                htmlFromAddNote = $("#note_text").html().replace("<br>","|*br|*");
                console.log("htmlFromAddNote: " + htmlFromAddNote);

                var tempdiv = $("<div></div>");
                tempdiv.html(htmlFromAddNote);
                console.log("tempdiv.html: " + tempdiv.html());

                textFromAddNote = tempdiv.text();
                console.log("tempdiv.text: " + textFromAddNote);

                htmlFromAddNote = textFromAddNote.replace("|*br|*", "<br>");
                console.log("html from textFromAddNote: " + htmlFromAddNote);

                $("#note_text").html(htmlFromAddNote);
                console.log("notetext.html: " +  $("#note_text").html());

*/
                //$("#note_text").html($("#note_text").html().replace("<br>","|*br|*"));

                //$("#note_text").html($("#note_text").text());
                //$("#note_text").html($("#note_text").html().replace("|*br|*", "<br>"));

                //$(this).html(StripContentofTags($(this).html());


                //console.log($(this));
            });

            // function StripContentofTags(content){
            //     return content.replace(/<(?!br\s*\/?)[^>]+>/g, '');
            // }

            //PROMENJENO sa .ajax na xhr

            $(document).ready(function() {
                $('body').on("click", "[name='edit']", function(event){
                    event.preventDefault();



                    //učitavanje podataka o kategoriji uz pomoć php-a
                    $("#content").load("php/views/edit_note_from_table_html_structure.php");

                    //samo html elementi, bez php-a, čista forma sa input elementima.
                    $("#note_edit_form").load("php/views/edit_note_from_table_input_and_contenteditable.html");
                    //problem sa ovime je sto se od sad uvek pojavljuju na svakoj strani. treba ih ukloniti kad se korisnik ode sa strane. urađeno. pogledati funkciju CloseEditForm() (gore).
                    

                    // var xhr1 = new XMLHttpRequest();
                                        
                    // xhr1.open("GET", "php/views/edit_note_from_table_html_structure.php", true);

                    
                    // xhr1.onreadystatechange = function(response) {
                    //     if (xhr1.status == 200 && xhr1.readyState == 4) {
                            
                    //         $("#content").html(this.response);
                    //     }

                    // }

                    // xhr1.send();


                    var noteid = $(this).attr("noteid");
                    var notenumber = $(this).attr("notenumber");
                    
                    $("#data").attr("notenumber", notenumber);
                                
                    var xhr = new XMLHttpRequest();
                    
                    xhr.open("GET", "php/operations/get_existing_note_for_editing.php?noteid="+noteid+"&notenumber="+notenumber, true);

                    xhr.responseType = "json";
                    xhr.onreadystatechange = function(response) {
                        if (xhr.status == 200 && xhr.readyState == 4) {
                          
                                //alert("prosao ajax");

                                //console.log("AJAX Response:", this.response);

                            //document.getElementById("content").innerHTML = this.response;

                            //var stringjson = "{title: '', content: ".$note->getContent().", date: ".$date."}";      
                            console.log(this.response);

                            //this.response.each(function( index ) {
                            //    console.log(this.response(index));
                            //});

                            //var note = this.response;

                            //var noteTitle = this.response.substring(0,9);
                            //console.log(noteTitle);    
                           //$("#test").html(this.response["noteTitle"]);    

                            var note = JSON.parse(JSON.stringify(this.response));
                            console.log(note["noteTitle"]);
                            console.log(note["noteContent"]);

                           //console.log(note);

                           // var keys = Object.keys(note);
                            // for(let i = 0; i<keys.length; i++){
                            //     console.log("object properties: " + keys[i]);
                            //     console.log("note["+keys[i]+"]="+note[keys[i]]);
                            // }
                            //console.log("sta dobijam: " + note[keys[0]]);
                            //console.log("sta dobijam: " + note["noteTitle"]);

                            //console.log("parsed note: " + note);
                            //console.log("note: " + note);
                            //console.log('Resp:'+ note.title);
                            

                            //$("#test").html("");
                            //$("#test").append("<div>"+note["noteTitle"]+"</div>");
                            //$("#test").append("<div>"+note["noteContent"]+"</div>");



                            $("#note_title").val(note["noteTitle"]);
                            $("#note_text").html(note["noteContent"]);

                            
                            $("#data").attr("notenumber", notenumber);

                            //alert("nn from data: " + $("#data").attr("notenumber"));        

                            console.log("NOTE TITLE: " + note["noteTitle"]);
                           // $("#input_note_text").val("<div>"+note["noteTitle"]+"</div>");
                            //location.href="http://samantha-notes.rf.gd/site-test";
                            //console.log('Note number attr: ' + $('#additional_data').attr('notenumber'));


                            //alert(imageids.length);

                            for (i = 0; i < imageids.length; i++) {
                                console.log(imageids[i]);
                                GetImageBlobFromDb(imageids[i]);
                            } 
                        //imageids.forEach(GetImageBlobFromDb2);
                            imageids = new Array();
                        }
                    }

                    xhr.send();

                });
            });

            // function GetImageBlobFromDb2(item){
            //     $.ajax({
            //         type: "get",
            //         url: "php/operations/get_blob_by_image_id_to_view.php",
            //         data: "imageid="+item,
            //         success: function(response){    
            //             alert("i AM HERE");
            //         }
            //     });
            // }



            function GetImageBlobFromDb(id){
                 alert('id=' + id);
                 var xhr = new XMLHttpRequest();
                    
                // alert('calling getblobbyimageidtoview with query string imageid');
                    xhr.open('GET', 'php/operations/get_blob_by_image_id_to_view.php?imageid='+id, true);

                // alert('end calling getblobbyimageidtoview with query string imageid');

                // alert('cors');
                    xhr.setRequestHeader("Access-Control-Allow-Origin", "http://samantha-notes.rf.gd");
                //   alert('end cors');
                //  alert('xhr response type= blob');
                    xhr.responseType = "blob";
                    xhr.onreadystatechange = function() {
                        if (xhr.status == 200 && xhr.readyState == 4) {
                            //save blob to temporary image file
                            //img with imageid: set its src to temporeary image file

                            //alert("i AM HERE");

                            // var imageToInsert = xhr.response;
                            // var urlToImage = URL.createObjectURL(imageToInsert);
                            
                            // $(this).attr("src", urlToImage);
                        }

                    };
                    alert('sending');
                xhr.send();
                alert("sent");

            }
            var edit_is_open = false;

            $("body").on("click", "#change_title_from_card", function(){    
              
               

                //length is 0 if element doesn't exist
                if($("#save_title_from_card").length > 0) { 
                    $(this).focus();
                    
                    return; 
                }

                var divChangeTitleSave = $("#change_title_save_btn_group");
                var buttonSave = $("<button></button>");
                var change_title = $("#change_title_from_card");



                //GET CARET POSITION
                const selection = window.getSelection();
                const range = selection.getRangeAt(0);
                const preCaretRange = range.cloneRange();
                preCaretRange.selectNodeContents(this);
                preCaretRange.setEnd(range.endContainer, range.endOffset);
                const cursorPosition = preCaretRange.toString().length;

                // Display the cursor position
                console.log('Cursor Position: ' + cursorPosition);

                //END GET CARET POSITION



                 buttonSave.attr("id", "save_title_from_card");
                 change_title.attr("contenteditable", true);
                 
                 
                 buttonSave.text("Update title");
                 buttonSave.on("click", function(){
                     var new_title = $("#change_title_from_card").text();
                     var noteid = $("#change_title_from_card").attr("noteid");
                    
                    
                    $.ajax({
                        type: "post",
                        url: "php/operations/update_note_title.php",
                        data: "noteid="+noteid+"&newtitle="+new_title,
                        success: function(){
                            buttonSave.remove();
                        }
                    });
                 });

            
                // Promise p = new Promise();
                // p.promising(divChangeTitleSave.remove(buttonSave));
                // p.doPromiseAfter(buttonSave.click());

                //  divChangeTitleSave.attr("id", "change_title_save_btn_group");
                //  divChangeTitleSave.addClass("btn-group");
                //  divChangeTitleSave.css("width", "100%");
                 //const change_title_clone = change_title.clone();
                // divChangeTitleSave.append(change_title_clone);
                 divChangeTitleSave.append(buttonSave);

                //change_title.after(divChangeTitleSave);
                //change_title.remove();
             

                //$("#direct_change_card_body").append(divChangeTitleSave);
    
                
                edit_is_open = true;
               
               //SET CARET POSITION
                
                 
                

                // Set the caret position in the h4 element
                change_title.focus(); // Focus on the h4 element

                // Create a new range for the h4 element
                const h4Range = document.createRange();
                
                console.log(typeof change_title);
                
                //change_title_clone.append(text_node);
                h4Range.setStart(change_title, cursorPosition); // Set the start of the range to the cursor position
                h4Range.collapse(true); // Collapse the range to the start point

                // Clear any existing selections and set the new range
                selection.removeAllRanges();
                selection.addRange(h4Range);

                /*


                    <div class='btn-group' style='width: 100%;'>
                            <input id='pass_login' type='password' class='form-control' required placeholder='Password'/>
                            <button id='pass_visibility_login' class='btn btn-success' ><img id='eye' src='images/open_eye.png'/></button>
                        </div>

                    */
            });

            $("body").on("click", "#edit_note_directly_from_card", function(){
                event.preventDefault();

                var noteid = $(this).attr("noteid");
                var notenumber = $(this).attr("notenumber");
                var categoryid = $(this).attr("categoryid");


                console.log("CATEGORY ID FROM EDITNOTEDIRECTLY: " + categoryid);                
                        $("#content").load("php/views/view_toolbar.php?categoryid="+categoryid);
                        $("#note_edit_form").load("php/views/view_note_edit_directly_from_card.html");
                        

                 var xhr = new XMLHttpRequest();
                xhr.open('GET', 'php/operations/get_existing_note_for_editing.php?noteid='+noteid+'&notenumber='+notenumber+"&categoryid="+categoryid, true);
                 xhr.responseType = "json";
                xhr.onreadystatechange = function(){
                    if(xhr.status == 200 & xhr.readyState == 4){
                        var note = JSON.parse(JSON.stringify(this.response));
                        console.log("from card: title: " + note["noteTitle"]);
                        console.log("from card: categoryid: " + note["categoryID"]);
                        console.log("from card: content: " + note["noteContent"]);

                        $("#note_title").val(note["noteTitle"]);
                        $("#note_title").attr("categoryid", note["categoryID"]);
                        $("#note_text").html(note["noteContent"]);
                        $("#data").attr("notenumber", note["noteNumber"]);
                    }
                }

                xhr.send();
            });

            $('body').on("click", "#edit_from_card", function(event){
                event.preventDefault();

                var noteid = $(this).attr("noteid");
                var notenumber = $(this).attr("notenumber");

                
                        $("#content").load("php/views/view_toolbar.php");
                        $("#note_edit_form").load("php/views/view_note_edit_from_card.html");
                        

                 var xhr = new XMLHttpRequest();
                xhr.open('GET', 'php/operations/get_existing_note_for_editing.php?noteid='+noteid+'&notenumber='+notenumber, true);
                 xhr.responseType = "json";
                xhr.onreadystatechange = function(){
                    if(xhr.status == 200 & xhr.readyState == 4){
                        var note = JSON.parse(JSON.stringify(this.response));
                        console.log("from card: title: " + note["noteTitle"]);
                        console.log("from card: content: " + note["noteContent"]);

                        $("#note_title").val(note["noteTitle"]);
                        $("#note_text").html(note["noteContent"]);
                        $("#data").attr("notenumber", notenumber);
                    }
                }

                xhr.send();




              /*  $.ajax({
                    type: "get",
                    url: "php/views/php/operations/get_existing_note_for_editing.php",
                    data: "noteid="+noteid+"&notenumber="+notenumber,
                    success: function(response){    
                        
                        var note = JSON.parse(JSON.stringify(this.response));

                        console.log("from card: title: " + note["noteTitle"]);
                        console.log("from card: content: " + note["noteContent"]);

                        $("#note_title").val(note["noteTitle"]);
                        $("#note_text").html(note["noteContent"]);
                        $("#data").attr("notenumber", notenumber);
                        console.log("FROM CARD: " + response);
                        console.log("noteid="+noteid+"&notenumber="+notenumber);
                        
                        //console.log($("#content"));
                        //console.log(response);


                        //setHTMLToContent(response, setHtmlAndData());
                        //kad se zavrsi prethodna funkcija, ide sledeca:

                    }
                });*/

            });

            /*function setHtmlAndData(html){
                        alert("note title: " + $('#note_title').val());
            }

            function setHTMLToContent(html, _callback){

                        $("#content").html(html);
                        _callback();
            }*/

             $('body').on("click", "[name='delete']", function(event){
                 event.preventDefault();
                var noteid = $(this).attr("noteid");
                var title = $(this).attr("title");
                
                $('#modal_delete_note_from_table').css("display","block");
                $('#modal_delete_note_from_table').css("position","fixed");
                $('#modal_delete_note_from_table').css("top","25%");
                

                $('#question_table').html("Do you want to delete the note: "+ title +", with id: " + noteid + " ?");
                $("#delete_noteid").attr("noteid", noteid);

            });


             $('body').on('click','#delete_from_table_yes', function(){
                    
                var noteid = $("#delete_noteid").attr("noteid");
                //alert(noteid);

                $.ajax({
                    type: "get",
                    url: "php/operations/delete_selected_note_from_table.php",
                    data: "noteid="+noteid,
                    success: function(response){    
                        //alert("Note deleted");
                        $("#content").html(response);
                        $('#modal_delete_note_from_table').css("display","none");
                        
                    }
                });
            });




            $('body').on('click','#delete_from_table_no', function(){
                    
            
                $('#modal_delete_note_from_table').css("display","none");
                
            });

  
        

            $('body').on("click", "#delete_from_card", function(){
                var title = $(this).attr("notetitle");
                var noteid = $(this).attr("noteid");
                $('#modal_delete_note').css("display","block");
                $('#modal_delete_note').css("position","fixed");
                $('#modal_delete_note').css("top","25%");
                

                $('#question').html("Do you want to delete the note: "+ title +", with id: " + noteid + " ?");
                $('#question').attr("noteid", noteid);
               

            });

            $('body').on('click','#delete_yes', function(){
                    
                var noteid = $("#question").attr("noteid");
                //alert(noteid);

                $.ajax({
                    type: "get",
                    url: "php/operations/delete_selected_note.php",
                    data: "noteid="+noteid,
                    success: function(response){    
                        $("#content").html(response);
                        $('#modal_delete_note').css("display","none");
                        
                    }
                });
            });


            
            $('body').on('click','#delete_no', function(){
                    
            
                $('#modal_delete_note').css("display","none");
                
            });

             $('body').on('click','#delete_close', function(){
                    
            
                $('#modal_delete_note').css("display","none");
                
            });



    //EDIT
    //         $title = $_POST['title'];
    //         $noteNumber = $_POST['note_number'];
    //         $content = $_POST['content'];
    //         $categoryid = $_POST['categoryid'];

            $('body').on('click', "#save_edited_note", function(){
            var title = $("#note_title").val();
            var content = $("#note_text").html();
            var categoryid = $("#categories").val();
            var note_number = $("#data").attr("notenumber");

            alert("content: " + content);

                console.log('edit_note title: ' + title);
                console.log('edit notenumber: ' + note_number);
                console.log('edit note content: ' + content);
                console.log('edit note category id: ' + categoryid);
                
                //alert("title: " + title + ", content: " + content + ", note-number: " + note_number);

                $.ajax({
                    type: "post",
                    url: "php/operations/edit_note.php",
                    data: "title=" + title + "&content=" + content+"&categoryid="+categoryid+"&notenumber="+note_number,
                    success: function(response){
                        $("#response").html(response);
                    }
                });
            });


            $('body').on('click', "#save_edited_note_small_screen", function(){
            var title = $("#note_title").val();
            var content = $("#note_text").html();
            var categoryid = $("#categories").val();
            var note_number = $("#data").attr("notenumber");

                //alert("title: " + title + ", content: " + content + ", note-number: " + note_number);

                $.ajax({
                    type: "post",
                    url: "php/operations/edit_note.php",
                    data: "title=" + title + "&content=" + content+"&categoryid="+categoryid+"&notenumber="+note_number,
                    success: function(response){
                        $("#response").html(response);
                    }
                });
            });

            // $('body').on('click', "#cancel_note", function(){
            //     var notenumber = $("#additional_data").attr("notenumber");
                
            //    if(notenumber === undefined) notenumber = 0;
            //         $.ajax({
            //             type: "get",
            //             url: "php/views/view_all_note_versions.php",
            //             data: "notenumber="+notenumber,
            //             success: function(response){
            //                 $("#content").html(response);
                            
            //             }
            //         });
            // });

            $('body').on('click', "#cancel_editing_note_goto_versions_as_cards", function(){
                $("#note_edit_form").html("");
                 $("#toolbar").html("");
                var notenumber = $("#data").attr("notenumber");
                    $.ajax({
                        type: "post",
                        url: "php/views/view_versions_of_selected_note_as_cards.php",
                        data: "notenumber="+notenumber,
                        success: function(response){
                            $("#content").html(response);
                            
                        }
                    });
            });


                    $('body').on('click', "#cancel_editing_note_goto_versions_as_cards_small_screen", function(){
                var notenumber = $("#additional_data").attr("notenumber");
                    $.ajax({
                        type: "post",
                        url: "php/views/view_versions_of_selected_note_as_cards.php",
                        data: "notenumber="+notenumber,
                        success: function(response){
                            $("#content").html(response);
                            
                        }
                    });
            });

           //TODO
            $('body').on('click', "#cancel_note_small_screen", function(){
                var notenumber = $("#additional_data").attr("notenumber");
               if(notenumber === undefined) notenumber = 0;
                    $.ajax({
                        type: "get",
                        url: "php/views/view_all_note_versions_from_card_small_screen.php",
                        data: "notenumber="+notenumber,
                        success: function(response){
                            $("#content").html(response);
                            
                        }
                    });
            });

            $('body').on('mouseenter', '[name="content_peek"]', function(event){
                var id = $(this).attr("noteid");
                ShowContentPeek(id, event);
            });

            function ShowContentPeek(id, event){
                
                $.ajax({
                    type: "post",
                    url: "php/operations/get_content_peek.php",
                    data: "id="+id,
                    success:function(response){
                        $("#content_peek").html(response);
                        //alert("x,y=" + event.screenX + "," + event.screenY);
                        $("#content_peek").css({'top':event.pageY + 10 + "px",'margin-left': event.pageX + 10 +"px"});
                        
                    }
                });
                
            }



            // var hold_peek = false;

            // $('body').on('mouseenter', '#content_peek', function(event){
            //         hold_peek = true;
            // });

            $('body').on('mousemove', '[name="content_peek"]', function(event){
                var id = $(this).attr("noteid");
                ShowContentPeek(id, event);
            });

            $('body').on('mouseleave', '#content_peek', function(event){
                    // hold_peek = false;
                    // if(!hold_peek) {
                        $("#card").animate({
                            opacity: 0
                        }, "fast");
                    
                    // }
            });


            $('body').on('mouseleave', '[name="content_peek"]', function(event){
                    $("#card").animate({
                            opacity: 0
                        }, "fast");
            });

            //  $('body').on('mouseleave', '[name="content_peek"]', function(event){
            //         //if($("#content_peek").html() != "")
            //         if(!hold_peek) $("#content_peek").html("");

            //  });

            
            document.body.addEventListener("click", function (evt) {
                if (!$(evt.target).is("#card") ){
                    $("#card").animate({
                        opacity: 0
                    }, "fast");
                
                }


                var note_content = $("#note_text");
                //console.log("click event on document: note-content exists with id: " + note_content.attr("id"));
                // Check if the clicked element is inside the 'specialDiv'
                if ($(evt.target).is("#note_text")) {
                    note_text_is_clicked_or_typed = true;
                } else {
                    note_text_is_clicked_or_typed = false;
                }
                    //console.log("note_text_is_clicked_or_typed is " + note_text_is_clicked_or_typed);
            });

        
            // $('body').on('click', '[name="category"]', function(event){
            //     $(this).attr("categoryID");
            // });
        

        $("body").on("click", "#notes_cards", function(){
            $.ajax({
                    type: "get",
                    url: "php/views/view_latest_notes_as_cards.php",
                    data: "",
                    success: function(response){
                        $("#content").html(response);
                        
                    }
                });
        });
        


        $("body").on("click", "[name='open_note_versions_as_cards']", function(){
            var notenumber = $(this).attr("notenumber");

            $.ajax({
                    type: "post",
                    url: "php/views/view_versions_of_selected_note_as_cards.php",
                    data: "notenumber="+notenumber,
                    success: function(response){
                        console.log(response);
                        $("#content").html(response);
                        
                    }
                });
        });

        $("body").on("click", "#open_note", function(){
            var noteid = $(this).attr("noteid");

            $.ajax({
                    type: "get",
                    url: "php/views/view_selected_note.php",
                    data: "noteid="+noteid,
                    success: function(response){
                        $("#content").html(response);
                        
                    }
                });
        });


        
        $("body").on("click", "#open_note_from_cards", function(){
            var noteid = $(this).attr("noteid");
        
            $.ajax({
                    type: "get",
                    url: "php/views/view_selected_note_from_card.php",
                    data: "noteid="+noteid,
                    success: function(response){
                        $("#content").html(response);
                        
                    }
                });
        });



        

        </script>

        <style> 

        
            
        </style>

    <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>



             
