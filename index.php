<?php
    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once("Donnees.inc.php");
    require_once("models/user.class.php");

    //==================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    //==================================================================//


    echo $twig->render('index.html.twig',
        array('session' => $_SESSION,
            'recettes' => $Recettes,
            'hierarchie' => $Hierarchie
        )
    );

?>
