<?php
/**
 * Date: 05/12/14
 * Time: 01:21
 */

    session_start();
    require_once("controle_inscription.php");

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
        echo $twig->render('editer_profil.html.twig',
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
        $users[$pseudo]['codePostal'] = $_POST['postal'];
        $users[$pseudo]['ville']    =   $_POST['ville'];
        $users[$pseudo]['adresse']  =   $_POST['adresse'];
        $users[$pseudo]['telephone'] =  $_POST['telephone'];

        $_SESSION['user_courant'] = $users[$pseudo];

        file_put_contents('models/users.json', json_encode($users));

        header("Location: profil.php");
    } //TODO faire les tests cote serveur avant enregistrement


    function testerErreur()
    {
        valideNom();
        validePrenom();
        valideEmail();
        valideNaissance();
        validePostal();
        valideVille();
        valideTelephone();
    }