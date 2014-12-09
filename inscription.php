<?php
    session_start();
    require_once("models/user.class.php");
    require_once('controle_inscription.php');
    
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

                if(testerPseudo() )     $users[$_POST['pseudo']]->setPseudo( $_POST['pseudo'] );
                if(testerMdp() )        $users[$_POST['pseudo']]->setMotDePasse( sha1($_POST['motdepasse']) );
                if(valideNom())         $users[$_POST['pseudo']]->setNom( $_POST['nom'] );
                if(validePrenom())      $users[$_POST['pseudo']]->setPrenom( $_POST['prenom'] );
                if(valideSexe())        $users[$_POST['pseudo']]->setSexe($_POST['sexe']);
                if(valideEmail())       $users[$_POST['pseudo']]->setEmail($_POST['email']);
                if(valideNaissance())   $users[$_POST['pseudo']]->setNaissance($_POST['naissance']);
                if(validePostal())     $users[$_POST['pseudo']]->setCodePostale( $_POST['postal']);
                if(valideVille())       $users[$_POST['pseudo']]->setVille( $_POST['ville']);
                if(valideAdresse())     $users[$_POST['pseudo']]->setAdresse( $_POST['adresse']);
                if(valideTelephone())   $users[$_POST['pseudo']]->setTelephone($_POST['telephone']);

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
        validePseudo();
        valideMdp();
        valideNom();
        validePrenom();
        valideEmail();
        valideNaissance();
        validePostal();
        valideVille();
        valideAdresse();
        valideTelephone();

        return testerPseudo() && testerMdp();
    }

?>
