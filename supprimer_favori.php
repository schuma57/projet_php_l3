<?php
/**
 * Date: 08/12/14
 * Time: 13:37
 */

    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once("Donnees.inc.php");
    //=======================================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //=======================================================================//


    if( isset($_SESSION['user_courant']) && $_SESSION['user_courant'] != '' )
    {
        if( isset($_GET['id']) )
        {
            $pseudo = $_SESSION['user_courant']['pseudo'];
            $users = json_decode( file_get_contents('models/users.json'), true );

            unset( $users[$pseudo]['panier'][$_GET['id']] );
            $_SESSION['user_courant'] = $users[$pseudo];
           file_put_contents('models/users.json', json_encode($users));
        }
    }
    else
    {
        if( isset($_GET['id']) )
        {
            unset($_SESSION['panier'][$_GET['id']]);
            //array_shift($_SESSION['panier']);
        }
    }

    sleep(1);
    header('Location: panier.php');
