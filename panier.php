<?php
/**
 * Date: 05/12/14
 * Time: 08:38
 */

    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    //=====================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //=====================================================================//
    //TODO faire la gestion du panier

    echo $twig->render('panier.html.twig',
        array('session' => $_SESSION
        )
    );
