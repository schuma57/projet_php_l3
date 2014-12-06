<?php
/**
 * Date: 05/12/14
 * Time: 10:06
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


    if( !isset($_SESSION['user_courant']) || $_SESSION['user_courant'] == '' )
    {
        header("Location: connexion.php");
        exit();
    }
    // sinon la page peut s'afficher

    if( !isset($_POST['submit']) )
    {
        echo $twig->render('changer_mdp.html.twig',
            array('session' => $_SESSION,
            )
        );
    }
    else
    {
        if( isset($_POST['mdpactuel']) && !empty($_POST['mdpactuel']) && $_POST['mdpactuel'] != ''
            && isset($_POST['nouveaumdp']) && !empty($_POST['nouveaumdp']) && $_POST['nouveaumdp'] != ''
            && isset($_POST['confNouveau']) && !empty($_POST['confNouveau']) && $_POST['confNouveau'])
        {
            $pseudo = $_SESSION['user_courant']['pseudo'];
            $users = json_decode( file_get_contents('models/users.json'), true );
            if( $users[$pseudo]['motDePasse'] == sha1($_POST['mdpactuel'])  )
            {
                if( $_POST['nouveaumdp'] == $_POST['confNouveau'] )
                {
                    $users[$pseudo]['motDePasse'] = sha1($_POST['nouveaumdp']);
                    $_SESSION['user_courant'] = $users[$pseudo];

                    file_put_contents('models/users.json', json_encode($users));

                    $url = "profile.php";
                    $message = "
                        <p>Mot de passe changé avec succès ! Redirection dans <span id=chrono>3</span> secondes</p>
                        <script>
                        setTimeout(function(){ document.getElementById('chrono').innerHTML = '2';}, 1000 );
                        setTimeout(function(){ document.getElementById('chrono').innerHTML = '1';}, 2000 );
                        setTimeout(function(){ document.getElementById('chrono').innerHTML = '0';}, 3000 );
                        </script>";

                    echo $twig->render("message.html.twig",
                        array(
                            'message' => $message,
                            'url'   => $url
                        )
                    );
                    return;
                }
                else
                {
                    $erreur = "Confirmez votre nouveau mot de passe avec la même valeur.";
                }
            }
            else
            {
                $erreur = "Le mot de passe saisit est incorrect.";
            }
        }
        else
        {
            $erreur = "Saisir tous les champs requis.";
        }

        echo $twig->render('changer_mdp.html.twig',
            array('session' => $_SESSION,
                'erreur' => $erreur
            )
        );
    }