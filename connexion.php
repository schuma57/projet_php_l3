<?php
    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    //=====================================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    //=====================================================================//
    
    if( !isset($_POST['submit']) )
    {
        echo $twig->render('connexion.html.twig',
            array('session' => $_SESSION
            )
        );
    }
    else
    {
        if(isset($_POST['pseudo']) && $_POST['pseudo'] != ''
                && isset($_POST['motdepasse']) && $_POST['motdepasse'] != '' )
        {
            $listeUsers = json_decode( file_get_contents('models/users.json'), true );

            if( array_key_exists( $_POST['pseudo'], $listeUsers ) )
            {
                if( $listeUsers[$_POST['pseudo']]['motDePasse'] == sha1($_POST['motdepasse']) )
                {
                    $_SESSION['user_courant'] = $listeUsers[$_POST['pseudo']];
                    header('Location: index.php');
                    return;
                }
            }
            else
                $erreur = "Cette combinaison pseudo - mot de passe est incorrect.";
        }
        else
            $erreur = "Vous devez renseigner votre pseudo et votre mot de passe.";

        echo $twig->render('connexion.html.twig',
            array('session' => $_SESSION,
                'erreur' => $erreur
            )
        );
    }

?>
