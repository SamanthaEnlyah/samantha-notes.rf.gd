
<?php 
        session_start();
?>

<nav class="nav navbar-expand-lg fixed-top  bg-white " >
    <div class="container mt-3">
     

      
            <ul class="list-group" style="list-style-type: none; display: inline-block;">
                <!-- view latest news or notes -->
                <li class="list-group-item border-top round-top p-2" style="display: inline-block; "><a id = 'home' style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer; text-decoration: underline;">Home</a></li>

                <!-- add, edit and delete notes -->

            <?php
            
            include_once($_SERVER['DOCUMENT_ROOT'] . "/php/operations/user_s_d.php"); 
            if(IsLoggedIn()) {
                
                echo  '
                        <li class="list-group-item border-top round-top p-2" style="display: inline-block;">
                            <!-- <a href="php/notes.php" >Notes</a> -->
                            <div class="dropdown" >
                                <a
                                class="dropdown-toggle"
                                data-bs-toggle="dropdown"
                                data-bs-target="#notes"
                                style="cursor:pointer;"
                                >
                                Notes
                            </a>


                                <ul class="dropdown-menu" id="notes">
                                
                                <li><a id="notes_table" href="#" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">Notes Table</a></li>
                                <li><a id="notes_cards" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">Notes Cards</a></li>
                                <li><a id="add_note"  class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91);cursor: pointer;">Add Note</a></li>


                                <li><a id="add_action" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">Add Action</a></li>
                                <li><a id="add_category" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">Add Category</a></li>
                                <li><a id="view_actions" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">View Actions</a></li>
                                <li><a id="view_categories" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91); cursor: pointer;">View Categories</a></li>
                                
                                </ul>

                    </div>
                </li>
                            ';
                    } ?>
                </ul> 

                <ul class="list-group float-end" style="list-style-type: none; display: inline-block;">
                    <li class="p-2" style="display: inline-block;">
                        <span id='logged_email' class='border rounded-2' >
                         
                        </span>

                        </li>                
                    <li class="list-group-item border-top round-top p-2" style="display: inline-block;">
                   
                        <div class="dropdown"> 
                        <a href="" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-target="#user"><img src="images/user-female-32.png"/></a>
                        <ul class="dropdown-menu" id="user">
                            
                            <?php 
                                
                                if(isset($_SESSION['email']) && isset($_SESSION['passwordHash'])){
                                    $email = $_SESSION['email'];
                                    $pass = $_SESSION['passwordHash'];
                                       
                                    echo "<li><a id='logout' class='dropdown-item' style='font-weight: 1; color: rgb(91, 186, 91);cursor: pointer;'>Log Out</a></li>";
                                        
                                } else {
                                    echo "<li><a id='login' class='dropdown-item' style='font-weight: 1; color: rgb(91, 186, 91);cursor: pointer;'>Log in</a></li>";
                                        
                                }

                            ?>
                            
                        
                        <li><a id="signup" href="#" class="dropdown-item" style="font-weight: 1; color: rgb(91, 186, 91);cursor: pointer;">Sign up</a></li>
                    </div>
                  </li>
                  

                <!-- <li class="list-group-item border-top round-top p-2" style="display: inline-block;"><a href="php/login.php" >Log In</a></li>
                <li class="list-group-item border-top round-top p-2" style="display: inline-block;"><a href="php/signup.php" >Sign Up</a></li> -->
            </ul>
    </div>

    <script>
      $.ajax({
                type: "get",
                url: "php/views/view_email_of_logged.php",
                data: "",
                success: function (response3){
                    $("#logged_email").html(response3);
                    
                }
            });
    </script>

</nav>




  
  
      
      