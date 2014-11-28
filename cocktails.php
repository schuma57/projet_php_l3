<?php
    session_start();
    require_once("Donnees.inc.php");
    //=============================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //==============================================================//

    $listeRecettes = $Recettes;

    //================ preparation du fil d'ariane ============
    for($i = 2; $i < 8 ; $i++)
    {
        if( isset($_POST['niveau'. $i.'']))
        {
            if( !in_array($_POST['niveau' .$i .''] , $Hierarchie[ $_POST['niveau'.($i-1).''] ]['sous-categorie'] ) )
                unset($_POST['niveau'.$i.''] );
        }
    } //=======================================

    //================= filtrage avant affichage ==============

    if( isset($_POST['submit']) )
    {
        unset($listeRecettes);

        for($i = 0 ; $i < count($Recettes) ; $i++)
        {
            for($j = 0 ; $j < count($Recettes[$i]['index']) ; $j++)
            {
                if( $_POST['niveau1'] == $Recettes[$i]['index'][$j] )
                    $listeRecettes[$i] = $Recettes[$i];
            }
        }
    }
    //=========================================================


    echo $twig->render('cocktails.html.twig',
        array('recettes' => $listeRecettes,
            'hierarchie' => $Hierarchie,
            'get'       => $_POST
        )
    );

?>
