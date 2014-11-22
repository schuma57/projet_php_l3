<?php
    session_start();
    require_once("Donnees.inc.php");
    $_SESSION["recettes"] = $Recettes;
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    echo $twig->render('cocktails.html.twig',
        array('session' => $_SESSION)
    );


?>
