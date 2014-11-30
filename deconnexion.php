<?php
    session_start();
    session_destroy();
    
    sleep(1);
    
    if( isset($_SERVER['HTTP_REFERER']) )
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '' );
    else
        header('Location: index.php');
