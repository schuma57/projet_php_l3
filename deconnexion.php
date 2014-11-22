<?php
    session_destroy();
    
    sleep(3);
    
    if( isset($_SERVER['HTTP_REFERER']) )
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '' );
    else
        header('Location: index.php');
