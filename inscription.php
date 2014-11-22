<?php
    session_start();
    include_once("models/user.class.php");
    
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    //==============================================================//

    if( !isset($_POST['submit']))
    {
        echo $twig->render('inscription.html.twig',
            array('session' => $_SESSION)
        );
    }
    else
    {
        $user = new User;
       // header
       
        if(validePseudo() )     $user->setPseudo( $_POST['pseudo'] );
        if(valideMdp() )        $user->setMotDePasse( $_POST['modepasse']);
        if(valideNom())         $user->setNom( $_POST['nom'] );
        if(validePrenom())      $user->setPrenom( $_POST['prenom'] );
        if(valideEmail())       $user->setEmail($_POST['email']);
        if(valideNaissance())   $user->setNaissance($_POST['naissance']);
        if(valideAdresse())     $user->setAdresse( $_POST['adresse']);
        if(valideTelephone())   $user->setTelephone($_POST['telephone']);

        //$_SESSION['users'] += $user;
    }

    
    function validePseudo()
    {
        if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
            return true;
        else
            return false;
    }

    function valideMdp()
    {
        if(isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) )
            return true;
        else
            return false;
    }

    function valideNom()
    {
        if( $_POST['nom'] != '' && $_POST['nom'] != null )
            return true;
        else
            return false;
    }

    function validePrenom()
    {
        if( $_POST['prenom'] != '' && $_POST['prenom'] != null )
            return true;
        else
            return false;
    }

    function valideEmail()
    {
        if( $_POST['email'] != '' && $_POST['email'] != null )
            return true;
        else
            return false;
    }

    function valideNaissance()
    {
        if( $_POST['naissance'] != '' && $_POST['naissance'] != null )
            return true;
        else
            return false;
    }

    function valideAdresse()
    {
        if( $_POST['postale'] != '' && $_POST['postale'] != null )
            return true;
        else
            return false;
    }

    function valideTelephone()
    {
        if( $_POST['telephone'] != '' && $_POST['telephone'] != null )
            return true;
        else
            return false;
    }
?>
