<?php
/**
 * Date: 06/12/14
 * Time: 11:19
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


    if( isset($_SESSION['user_courant']) && $_SESSION['user_courant'] != '' )
    {
        $pseudo = $_SESSION['user_courant']['pseudo'];
        $users = json_decode( file_get_contents('models/users.json'), true );

        $users[$pseudo]['panier'][$_GET['id']] = $_GET['id'];
        asort($users[$pseudo]['panier']);
        $_SESSION['user_courant'] = $users[$pseudo];
        file_put_contents('models/users.json', json_encode($users));
    }
    else
    {
        $_SESSION['panier'][$_GET['id']] = $_GET['id'];
        asort($_SESSION['panier']);
    }


    $url = $_SERVER['HTTP_REFERER'];
    $message = "
        <p>Recette ajoutée à vos favoris ! Redirection dans <span id=\"chrono\">2</span> secondes</p>
        <script>
        setTimeout(function(){ document.getElementById('chrono').innerHTML = '1';}, 1000 );
        setTimeout(function(){ document.getElementById('chrono').innerHTML = '0';}, 2000 );
        </script>";

    echo $twig->render("message.html.twig",
        array(
            'message' => $message,
            'url'   => $url
        )
    );
