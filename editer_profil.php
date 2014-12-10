<?php
/**
 * Date: 05/12/14
 * Time: 01:21
 */

    session_start();
    require_once("services/controle_inscription.php");

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
        $erreur = array();

        if( verifierTout() )
        {
            $pseudo = $_SESSION['user_courant']['pseudo'];
            $users = json_decode( file_get_contents('models/users.json'), true );

            if(isset($_POST['nom']))        $users[$pseudo]['nom']      =   trim($_POST['nom']);
            if(isset($_POST['prenom']))     $users[$pseudo]['prenom']   =   trim($_POST['prenom']);
            if(isset($_POST['sexe']))       $users[$pseudo]['sexe']     =   $_POST['sexe'];
            if(isset($_POST['email']))      $users[$pseudo]['email']    =   trim($_POST['email']);
            if(isset($_POST['naissance']))  $users[$pseudo]['naissance'] =  str_replace(array(' ' , '-', '\\'), '/', $_POST['naissance']);
            if(isset($_POST['postal']))     $users[$pseudo]['codePostal'] = trim($_POST['postal']);
            if(isset($_POST['ville']))      $users[$pseudo]['ville']    =   trim($_POST['ville']);
            if(isset($_POST['adresse']))    $users[$pseudo]['adresse']  =   trim($_POST['adresse']);
            if(isset($_POST['telephone']))  $users[$pseudo]['telephone'] =  trim($_POST['telephone']);

            $_SESSION['user_courant'] = $users[$pseudo];

            file_put_contents('models/users.json', json_encode($users));

            sleep(1);
            header("Location: profil.php");
            return;
        }


        echo $twig->render('editer_profil.html.twig',
            array('session' => $_SESSION,
                'erreur'    => $erreur
            )
        );

    }


    function verifierTout()
    {
        global $erreur;
        if( isset($_POST['nom']) )      valideNom( trim($_POST['nom']));
        if( isset($_POST['prenom']) )   validePrenom( trim($_POST['prenom']));
        if( isset($_POST['email']) )    valideEmail( trim($_POST['email']));
        if( isset($_POST['naissance'])) valideNaissance( trim($_POST['naissance']));
        if( isset($_POST['postal']) )   validePostal( trim($_POST['postal']));
        if( isset($_POST['ville']) )    valideVille( trim($_POST['ville']));
        if( isset($_POST['telephone'])) valideTelephone( trim($_POST['telephone']));

        return ( count($erreur) <= 0 );
    }
