<?php
    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once("Donnees.inc.php");

    error_reporting (1);
    //=======================================================================//
    require_once 'lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    //=======================================================================//

    //TODO function pour envoyer la racine

    $listeRecettes = $Recettes;

    //================ preparation du fil d'ariane =================
    for($i = 2; $i <= 8 ; $i++)
    {
        if( isset($_POST['niveau'. $i.'']))
        {
            if( !in_array($_POST['niveau' .$i .''] , $Hierarchie[ $_POST['niveau'.($i-1).''] ]['sous-categorie'] ) )
                unset($_POST['niveau'.$i.''] );
        }
    } //=========================================================

    //================= filtrage avant affichage ================

    if( isset($_POST['submit']) )
    {
        $label = 'sous-categorie';
        unset($listeRecettes);

        $max=1;
        for($i = 1 ; $i <= 8; $i++)
        {
            if( isset($_POST['niveau'.$i]) )
            {
                $max = $i;
            }
        }

        $listeAChercher[] = $_POST['niveau'.$max];

        foreach( $Hierarchie[$_POST['niveau'.$max][$label]] as $valeur)
        {
            $listeAChercher[] = $valeur;
        }

        for($j = $max+1 ; $j <= 8; $j++)
        {
            foreach($listeAChercher as $aliment)
            {
                if( is_array($Hierarchie[$aliment][$label]) )
                {
                    foreach( $Hierarchie[$aliment][$label] as $valeur)
                    {
                        $listeAChercher[] = $valeur;
                    }
                }
            }

        }

        for($i = 0 ; $i < count($Recettes) ; $i++)
        {
            foreach( $listeAChercher as $aliment)
            {
                if( in_array( $aliment, $Recettes[$i]['index'] ) )
                    $listeRecettes[$i] = $Recettes[$i];
            }
        }
    }
    //=========================================================


    echo $twig->render('cocktails.html.twig',
        array('session' => $_SESSION,
            'recettes'  => $listeRecettes,
            'hierarchie' => $Hierarchie,
            'get'        => $_POST,
            'nbCocktail' => count($listeRecettes),
        )
    );

?>
