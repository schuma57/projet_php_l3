<?php
/**
 * Date: 05/12/14
 * Time: 01:21
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

    if( !isset($_POST['submit']) )
    {
        echo $twig->render('editer_profile.html.twig',
            array('session' => $_SESSION)
        );
    }
    else
    {
        $pseudo = $_SESSION['user_courant']['pseudo'];
        $users = json_decode( file_get_contents('models/users.json'), true );

        $users[$pseudo]['nom']      =   $_POST['nom'];
        $users[$pseudo]['prenom']   =   $_POST['prenom'];
        $users[$pseudo]['sexe']     =   $_POST['sexe'];
        $users[$pseudo]['email']    =   $_POST['email'];
        $users[$pseudo]['naissance'] =  $_POST['naissance'];
        $users[$pseudo]['adresse']  =   $_POST['postale'];
        $users[$pseudo]['telephone'] =  $_POST['telephone'];

        $_SESSION['user_courant'] = $users[$pseudo];

        file_put_contents('models/users.json', json_encode($users));

        header("Location: profile.php");
    } //TODO faire les tests cote serveur avant enregistrement
