<?php
/**
 * Date: 05/12/14
 * Time: 08:38
 */

    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once 'Donnees.inc.php';

    //=====================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //=====================================================================//


    if( isset($_SESSION['user_courant']) && $_SESSION['user_courant'] != '' )
    {
        $listeFavoris = $_SESSION['user_courant']['panier'];
    }
    else
    {
        $listeFavoris = $_SESSION['panier'];
    }


    echo $twig->render('panier.html.twig',
        array('session' => $_SESSION,
            'recettes'  => $Recettes,
            'listeFavoris' => $listeFavoris
        )
    );
