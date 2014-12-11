<?php
/**
 * Date: 06/12/14
 * Time: 11:19
 */

    session_start();
    if( !isset($_SESSION['panier']) )
        $_SESSION['panier'] = array();
    require_once("../Donnees.inc.php");


    if( isset($_SESSION['user_courant']) && $_SESSION['user_courant'] != '' )
    {
        $pseudo = $_SESSION['user_courant']['pseudo'];
        $users = json_decode( file_get_contents('../models/users.json'), true );

        $users[$pseudo]['panier'][$_GET['id']] = $_GET['id'];
        asort($users[$pseudo]['panier']);
        $_SESSION['user_courant'] = $users[$pseudo];

        file_put_contents('../models/users.json', json_encode($users));
    }
    else
    {
        $_SESSION['panier'][$_GET['id']] = $_GET['id'];
        asort($_SESSION['panier']);
    }


    sleep(2);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '');