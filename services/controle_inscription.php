<?php
/**
 * Date: 09/12/14
 * Time: 13:58
 */


    function existePseudo($pseudo)  //test si le pseudo est deja utilisé
    {
        if( isset($pseudo) && !empty($pseudo) )
        {
            global $erreur;
            $erreur[] = "Ce pseudo est déjà pris.";
            return true;
        }
        else
            return false;
    }

    function validePseudo($pseudo)
    {
        global $erreur;
        if( isset($pseudo) && !empty($pseudo) )
        {
            if( !strlen($pseudo) >= 3 )
                $erreur[] = "Pseudo inférieur à 3 caractères.";
        }
        else
            $erreur[] = "Pseudo non renseigné.";
    }


    function valideMdp($mdp)
    {
        global $erreur;
        if( isset($mdp) && !empty($mdp) )
        {
            if( !strlen($mdp) >= 3 )
                $erreur[] = "Mot de passe inférieur à 3 caractères, trop faible.";
        }
        else
            $erreur[] = "Mot de passe non renseigné.";
    }


    function valideNom($nom)
    {
        global $erreur;
        if( isset($nom) && $nom != '' && $nom != null )
        {
            if( !ctype_alpha($nom) )
                $erreur[] = "Nom doit contenir que des lettres, ex : César";
        }
    }

    function validePrenom($prenom)
    {
        global $erreur;
        if( isset($prenom) && $prenom != '' && $prenom != null )
        {
            if( !ctype_alpha($prenom) )
                $erreur[] = "Prenom doit contenir que des lettres, ex : Jules";
        }
    }

    function valideSexe()
    {
        if( isset($_POST['sexe']) && $_POST['sexe'] != '' && $_POST['sexe'] != null )
            return true;
        else
            return false;
    }

    function valideEmail($email)
    {
        global $erreur;
        if( isset($email) && $email != '' && $email != null )
        {
            if( !preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $email))
                $erreur[] = "Email non valide, ex : mon.adresse@email.com";
        }
    }

    function valideNaissance($date)
    {
        global $erreur;
        if( isset($date) && $date != '' && $date != null )
        {
            $modifs = str_replace(array(' ' , '-', '\\'), '/', $date);
            list($jour, $mois, $annee)=explode("/", $modifs);

            if( !checkdate($mois, $jour, $annee) )
                $erreur[] = "Date non valide, ex : 01/01/2000";
        }
    }

    function validePostal($code)
    {
        global $erreur;
        if( isset($code) && $code != '' )
        {
            if( !preg_match("/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/", $code ))
                $erreur[] = "Code postal non valide, ex : 75000";
        }
    }

    function valideVille($ville)
    {
        global $erreur;
        if( isset($ville) && $ville != '' )
        {
            if( !ctype_alpha($ville) && strlen($ville) > 1 )
                $erreur[] = "Ville non valide, ex : Paris";
        }
    }

    function valideAdresse($adresse)
    {
        global $erreur;
        if( isset($adresse) && $adresse != '' )
            return true;
        else
            return false;
    }

    function valideTelephone($tel)
    {
        global $erreur;
        if( isset($tel) && $tel != '' && $tel != null )
        {
            if( !preg_match("`^0[0-9]([-. ]?\d{2}){4}[-. ]?$`", $tel ))
                $erreur[] = "Numéro de téléphone non valide, ex : 0123456789";
        }
    }