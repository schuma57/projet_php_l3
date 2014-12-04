<?php
    session_start();
    include_once("models/user.class.php");
    
    //===========================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    //===========================================================================//

    if( !isset($_POST['submit']) )
    {
        echo $twig->render('inscription.html.twig',
            array('session' => $_SESSION)
        );
    }
    else
    {
        $users = json_decode( file_get_contents('models/users.json'), true );
        if(validePseudo() )
            $users[$_POST['pseudo']] = new User;

        if(validePseudo() )     $users[$_POST['pseudo']]->setPseudo( $_POST['pseudo'] );
        if(valideMdp() )        $users[$_POST['pseudo']]->setMotDePasse( sha1($_POST['motdepasse']) );
        if(valideNom())         $users[$_POST['pseudo']]->setNom( $_POST['nom'] );
        if(validePrenom())      $users[$_POST['pseudo']]->setPrenom( $_POST['prenom'] );
        if(valideEmail())       $users[$_POST['pseudo']]->setEmail($_POST['email']);
        if(valideNaissance())   $users[$_POST['pseudo']]->setNaissance($_POST['naissance']);
        if(valideAdresse())     $users[$_POST['pseudo']]->setAdresse( $_POST['adresse']);
        if(valideTelephone())   $users[$_POST['pseudo']]->setTelephone($_POST['telephone']);

        file_put_contents('models/users.json', json_encode($users) );
        $_SESSION['user_courant'] = $users[$_POST['pseudo']];

        //---- redirection vers l'accueil du site
        header('Location: index.php');
    }

    
    function validePseudo()
    {
        if( isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
            return true;
        else
            return false;
    }

    function valideMdp()
    {
        if( isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) )
            return true;
        else
            return false;
    }

    function valideNom()
    {
        if( isset($_POST['nom']) && $_POST['nom'] != '' && $_POST['nom'] != null )
            return true;
        else
            return false;
    }

    function validePrenom()
    {
        if( isset($_POST['prenom']) && $_POST['prenom'] != '' && $_POST['prenom'] != null )
            return true;
        else
            return false;
    }

    function valideEmail()
    {
        if( isset($_POST['email']) && $_POST['email'] != '' && $_POST['email'] != null )
            return true;
        else
            return false;
    }

    function valideNaissance()
    {
        if( isset($_POST['naissance']) && $_POST['naissance'] != '' && $_POST['naissance'] != null )
            return true;
        else
            return false;
    }

    function valideAdresse()
    {
        if( isset($_POST['postale']) && $_POST['postale'] != '' && $_POST['postale'] != null )
            return true;
        else
            return false;
    }

    function valideTelephone()
    {
        if( isset($_POST['telephone']) && $_POST['telephone'] != '' && $_POST['telephone'] != null )
            return true;
        else
            return false;
    }
?>
