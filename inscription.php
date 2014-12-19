<?php
    session_start();
    require_once("models/user.class.php");
    require_once('services/controle_inscription.php');
    
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
        $erreur = array();

        if( chercherErreur() )
        {
            $users = json_decode( file_get_contents('models/users.json'), true );

            if(!existePseudo($users[$_POST['pseudo']]))
            {
                $users[$_POST['pseudo']] = new User;

                if(isset($_POST['pseudo']))      $users[$_POST['pseudo']]->setPseudo( trim($_POST['pseudo']) );
                if(isset($_POST['motdepasse']))  $users[$_POST['pseudo']]->setMotDePasse( sha1(trim($_POST['motdepasse'])) );
                if(isset($_POST['nom']))         $users[$_POST['pseudo']]->setNom( trim($_POST['nom']) );
                if(isset($_POST['prenom']))      $users[$_POST['pseudo']]->setPrenom( trim($_POST['prenom']) );
                if(isset($_POST['sexe']))        $users[$_POST['pseudo']]->setSexe($_POST['sexe']);
                if(isset($_POST['email']))       $users[$_POST['pseudo']]->setEmail( trim($_POST['email']));
                if(isset($_POST['naissance']))   $users[$_POST['pseudo']]->setNaissance(str_replace(array(' ' , '-', '\\'), '/', $_POST['naissance']) );
                if(isset($_POST['postal']))      $users[$_POST['pseudo']]->setCodePostale( trim($_POST['postal']));
                if(isset($_POST['ville']))       $users[$_POST['pseudo']]->setVille( trim($_POST['ville']));
                if(isset($_POST['adresse']))     $users[$_POST['pseudo']]->setAdresse( trim($_POST['adresse']));
                if(isset($_POST['telephone']))   $users[$_POST['pseudo']]->setTelephone( trim($_POST['telephone']));

                file_put_contents('models/users.json', json_encode($users) );
                $_SESSION['user_courant'] = getUserByPseudo($_POST['pseudo']);

                //---- redirection vers l'accueil du site
                header('Location: index.php');
            }
        }

        echo $twig->render('inscription.html.twig',
            array('session' => $_SESSION,
                'erreur'    => $erreur
            )
        );
    }

    function getUserByPseudo($pseudo)
    {
        $liste = json_decode( file_get_contents('models/users.json'), true );
        return $liste[$pseudo];
    }

    function chercherErreur()
    {
        global $erreur;
        validePseudo( trim($_POST['pseudo']));
        valideMdp( trim($_POST['motdepasse']));
        testerEquivalence( trim($_POST['motdepasse']), trim($_POST['confirmationMdp']));
        valideNom( trim($_POST['nom']));
        validePrenom( trim($_POST['prenom']));
        valideEmail( trim($_POST['email']));
        valideNaissance( trim($_POST['naissance']));
        validePostal( trim($_POST['postal']));
        valideVille( trim($_POST['ville']));
        valideAdresse( trim($_POST['adresse']));
        valideTelephone( trim($_POST['telephone']));

        return ( count($erreur) <= 0 );
    }

?>
