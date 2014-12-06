<?php
    session_start();
    session_destroy();
    
    sleep(1);
    
    if( isset($_SERVER['HTTP_REFERER']) )
    {
        if(basename($_SERVER['HTTP_REFERER']) == "index.php"
            || basename($_SERVER['HTTP_REFERER']) == "cocktails.php"
            || stripos($_SERVER['HTTP_REFERER'], "recette.php") != false )
        {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '' );
            return;
        }
    }

    header('Location: index.php');
