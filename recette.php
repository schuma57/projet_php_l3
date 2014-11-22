<?php
    session_start();
    require_once("Donnees.inc.php");
    $_SESSION["recettes"] = $Recettes;

    //=============================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    echo $twig->render('recette.html.twig',
        array('session' => $_SESSION,
            'id_recette' => $_GET['id']
        )
    );

    function testerSiImageExiste($image)
    {
        if( file_exists($image) )
            return true;
        else
            return false;
    }

?>
