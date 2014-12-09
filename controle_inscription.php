<?php
/**
 * Date: 09/12/14
 * Time: 13:58
 */

    function existePseudo($pseudo)  //test si le pseudo est deja utilisé
    {
        if( isset($pseudo) )
        {
            global $erreur;
            $erreur[] = "Ce pseudo est déjà pris.";
            return true;
        }
        else
            return false;
    }


    function validePseudo()
    {
        global $erreur;
        if( isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
        {
            if( strlen($_POST['pseudo']) >= 3 )
                return true;
            else
            {
                $erreur[] = "Pseudo inférieur à 3 caractères.";
                return false;
            }
        }
        else
        {
            $erreur[] = "Pseudo non renseigné.";
            return false;
        }
    }

    function testerPseudo()
    {
        if( isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
        {
            if( strlen($_POST['pseudo']) >= 3 )
                return true;
            else
                return false;
        }
        else
            return false;
    }


    function valideMdp()
    {
        global $erreur;
        if( isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) )
        {
            if( strlen($_POST['motdepasse']) >= 3 )
                return true;
            else
            {
                $erreur[] = "Mot de passe inférieur à 3 caractères, trop faible.";
                return false;
            }
        }
        else
        {
            $erreur[] = "Mot de passe non renseigné.";
            return false;
        }
    }

    function testerMdp()
    {
        if( isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) )
        {
            if( strlen($_POST['motdepasse']) >= 3 )
                return true;
            else
                return false;
        }
        else
            return false;
    }


    function valideNom()
    {
        global $erreur;
        if( isset($_POST['nom']) && $_POST['nom'] != '' && $_POST['nom'] != null )
        {
            if( ctype_alpha($_POST['nom']) )
                return true;
            else
            {
                $erreur[] = "Nom doit contenir que des lettres, ex : César";
                return false;
            }
        }
        else
            return false;
    }

    function validePrenom()
    {
        global $erreur;
        if( isset($_POST['prenom']) && $_POST['prenom'] != '' && $_POST['prenom'] != null )
        {
            if( ctype_alpha($_POST['prenom']) )
                return true;
            else
            {
                $erreur[] = "Prenom doit contenir que des lettres, ex : Jules";
                return false;
            }
        }
        else
            return false;
    }

    function valideSexe()
    {
        if( isset($_POST['sexe']) && $_POST['sexe'] != '' && $_POST['sexe'] != null )
            return true;
        else
            return false;
    }

    function valideEmail()
    {
        global $erreur;
        if( isset($_POST['email']) && $_POST['email'] != '' && $_POST['email'] != null )
        {
            if (preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $_POST['email']))
                return true;
            else
            {
                $erreur[] = "Email non valide, ex : mon.adresse@email.com";
                return false;
            }
        }
        else
            return false;
    }

    function valideNaissance()
    {
        global $erreur;
        if( isset($_POST['naissance']) && $_POST['naissance'] != '' && $_POST['naissance'] != null )
        {
            if (preg_match(
                "/^(((0[1-9]|[12][0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|
                ((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])
                (00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$/" ,
                $_POST['naissance']))
                return true;
            else
            {
                $erreur[] = "Date non valide, ex : 01/01/2000";
                return false;
            }
        }
        else
            return false;
    }

    function validePostal()
    {
        global $erreur;
        if( isset($_POST['postal']) && $_POST['postal'] != '' )
        {
            if( preg_match("/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/", $_POST['postal']) )
                return true;
            else
            {
                $erreur[] = "Code postal non valide, ex : 75000";
                return false;
            }
        }
        else
            return false;

    }

    function valideVille()
    {
        global $erreur;
        if( isset($_POST['ville']) && $_POST['ville'] != '' )
        {
            if( ctype_alpha($_POST['ville']) && strlen($_POST['ville']) > 1 )
                return true;
            else
            {
                $erreur[] = "Ville non valide, ex : Paris";
                return false;
            }
        }
        else
            return false;
    }

    function valideAdresse()
    {
        global $erreur;
        if( isset($_POST['adresse']) && $_POST['adresse'] != '' )
            return true;
        else
            return false;
    }

    function valideTelephone()
    {
        global $erreur;
        if( isset($_POST['telephone']) && $_POST['telephone'] != '' && $_POST['telephone'] != null )
        {
            if(preg_match("`^0[0-9]([-. ]?\d{2}){4}[-. ]?$`", $_POST['telephone']))
                return true;
            else
            {
                $erreur[] = "Numéro de téléphone non valide, ex : 0123456789";
                return false;
            }
        }
        else
            return false;
    }