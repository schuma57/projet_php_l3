<?php
    session_start();
    require_once("Donnees.inc.php");
    require_once("models/user.class.php");
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    //$fichier = file_get_contents("models/villes_france.txt");

    //$tab = explode('\n' , $fichier);

    //file_put_contents('models/villes.json', $tab);

    echo $twig->render('test.html.twig',
        array('recettes' => $Recettes,
            'hierarchie' => $Hierarchie
        )
    );

?>