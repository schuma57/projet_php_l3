<?php

class User
{
    /**
     * @var string
     */
    private $pseudo;
    /**
     * @var string
     */
    private $motDePasse;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $naissance;
    /**
     * @var string
     */
    private $adresse;
    /**
     * @var string
     */
    private $telephone;
    /**
     * @var array
     */
    private $panier;


    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param $mdp
     */
    public function setMotDePasse($mdp)
    {
        $this->motDePasse = $mdp;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * @param $naiss
     */
    public function setNaissance($naiss)
    {
        $this->naissance = $naiss;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param $tel
     */
    public function setTelephone($tel)
    {
        $this->telephone = $tel;
    }

    /**
     * @param $idCocktail
     */
    public function addPanier($idCocktail)
    {
        $this->panier[] = $idCocktail;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return null;
    }


    public function __construct(/*array $donnees*/)
    {
        $this->panier = array();
        /*$this->pseudo = $donnees['pseudo'];
        $this->motDePasse = $donnees['motDePasse'];
        $this->nom = $donnees['nom'];
        $this->prenom = $donnees['prenom'];
        $this->email = $donnees['email'];
        $this->naissance = $donnees['naissance'];
        $this->adresse = $donnees['adresse'];
        $this->telephone = $donnees['telephone'];*/
    }
}