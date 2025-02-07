<?php

    function ShowSignUpForm(){
        echo "
            
        <script>
          

            
                
        </script>




            <form>
                <div class='container signup-size'>
                    <h4 class='mb-4'>Registration</h4>

                    <div class='mb-3'>
                        
                        <input id='email' type='email' class='form-control' required placeholder='Email Address' />
                    </div>
                    <div class='mb-3'>
                        <div class='btn-group' style='width: 100%;'>
                            <input id='pass' type='password' class='form-control' required placeholder='Password'/>
                            <button id='pass_visibility' class='btn btn-success' ><img id='eye' src='images/open_eye.png'/></button>
                        </div>
                    </div>

                    <input id='register' class='btn btn-success' type='submit' value='Register'/>

                </div>
            </form>

        ";
    }

    ShowSignUpForm();
?>