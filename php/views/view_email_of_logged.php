<?php
session_start();
    if(isset($_SESSION['email'])) {
        echo $_SESSION['email'];
        echo "
                <script>
                    $('#logged_email').addClass('border rounded-2 p-2');
                </script>
            ";
    } else {
        echo "
                <script>
                    $('#logged_email').removeClass('border rounded-2 p-2');
                </script>
            ";
    }

?>