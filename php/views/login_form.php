<?php

    function ShowLoginForm(){
        echo "

            <form >
                <div class='container signup-size'>
                    <h4 class='mb-4'>Log In</h4>

                    <div class='mb-3'>
                        <input id='email_login' type='email' class='form-control' required placeholder='Email Address' />
                    </div>
                    <div class='mb-3'>
                        <div class='btn-group' style='width: 100%;'>
                            <input id='pass_login' type='password' class='form-control' required placeholder='Password'/>
                            <button id='pass_visibility_login' class='btn btn-success' ><img id='eye' src='images/open_eye.png'/></button>
                        </div>
                    </div>

                    <input id='login_submit' class='btn btn-success' type='submit' value='Log In'/>

                </div>
            </form>

        ";
    }

    ShowLoginForm();
?>