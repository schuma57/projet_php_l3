<?php
    session_start();
    require_once("Donnees.inc.php");
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    echo $twig->render('test.html.twig',
        array('recettes' => $Recettes,
            'hierarchie' => $Hierarchie
        )
    );

?>