<?php
    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once("Donnees.inc.php");

    //=============================================================//
    require_once 'lib/Twig/Autoloader.php' ;
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    function testerSiImageExiste($string)
    {
        if( file_exists('Photos/'.$string.'.jpg') )
            return true;
        else
            return false;
    }

    $urlImage = str_replace(' ', '_', $Recettes[$_GET['id']]['titre']);
    $imageExiste = testerSiImageExiste($urlImage);

    echo $twig->render('recette.html.twig',
        array('session' => $_SESSION,
            'recettes'  => $Recettes,
            'id_recette' => $_GET['id'],
            'nomImage'  => $urlImage,
            'imageExiste' => $imageExiste,
        )
    );

?>
