<?php
/**
 * Date: 04/12/14
 * Time: 15:38
 */

    session_start();
    //include_once("models/user.class.php");

    //===========================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //===========================================================================//


    if( !isset($_SESSION['user_courant']) || $_SESSION['user_courant'] == '' )
    {
        header("Location: connexion.php");
        exit();
    }
    // sinon la page peut s'afficher

    echo $twig->render('profile.html.twig',
        array('session' => $_SESSION)
    );