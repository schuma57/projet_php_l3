<?php
/**
 * Date: 05/12/14
 * Time: 01:21
 */

    session_start();
    require_once("services/controle_edition.php");

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

            if(isset($_POST['nom']))        $users[$pseudo]['nom']      =   $_POST['nom'];
            if(isset($_POST['prenom']))     $users[$pseudo]['prenom']   =   $_POST['prenom'];
            if(isset($_POST['sexe']))       $users[$pseudo]['sexe']     =   $_POST['sexe'];
            if(isset($_POST['email']))      $users[$pseudo]['email']    =   $_POST['email'];
            if(isset($_POST['naissance']))  $users[$pseudo]['naissance'] =  $_POST['naissance'];
            if(isset($_POST['postal']))     $users[$pseudo]['codePostal'] = $_POST['postal'];
            if(isset($_POST['ville']))      $users[$pseudo]['ville']    =   $_POST['ville'];
            if(isset($_POST['adresse']))    $users[$pseudo]['adresse']  =   $_POST['adresse'];
            if(isset($_POST['telephone']))  $users[$pseudo]['telephone'] =  $_POST['telephone'];

            $_SESSION['user_courant'] = $users[$pseudo];

            file_put_contents('models/users.json', json_encode($users));

            header("Location: profil.php");
            return;
        }


        echo $twig->render('editer_profil.html.twig',
            array('session' => $_SESSION,
                'erreur'    => $erreur
            )
        );

    } //TODO faire les tests cote serveur avant enregistrement


    function verifierTout()
    {
        global $erreur;
        if( isset($_POST['nom']) )      valideNom();
        if( isset($_POST['prenom']) )   validePrenom();
        if( isset($_POST['email']) )    valideEmail();
        if( isset($_POST['naissance'])) valideNaissance();
        if( isset($_POST['postal']) )   validePostal();
        if( isset($_POST['ville']) )    valideVille();
        if( isset($_POST['telephone'])) valideTelephone();

        return ( count($erreur) <= 0 );
    }
