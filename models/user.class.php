<?php

class User implements JsonSerializable
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
    private $sexe;
    /**
     * @var string
     */
    private $email;
    /**
     * @var \Date
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
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
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
     * @return \Date
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * @param \Date $naiss
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
     * @return array
     */
    public function getPanier()
    {
        return $this->panier;
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


    public function jsonSerialize() {
        /*return [
            'pseudo'        => $this->getPseudo(),
            'motDePasse'    => $this->getMotDePasse(),
            'nom'           => $this->getNom(),
            'prenom'        => $this->getPrenom(),
            'email'         => $this->getEmail(),
            'naissance'     => $this->getNaissance(),
            'adresse'       => $this->getAdresse(),
            'telephone'     => $this->getTelephone(),
            'panier'        => $this->getPanier()
        ];*/
        return get_object_vars($this);
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