<?php
    session_start();
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    //==============================================================//
    
    if( !isset($_POST['submit']) )
    {
        echo $twig->render('connexion.html.twig',
            array('session' => $_SESSION)
        );
    }
    else
    {
        if(isset($_POST['pseudo']) && isset($_POST['motdepasse']) )
        {

            $_SESSION['user_courant'] = $_POST['pseudo'];
        }
    }
    

    

?>
