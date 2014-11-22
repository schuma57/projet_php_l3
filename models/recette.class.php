<?php

class Recette
{
    /**
     * @var string
     */
    private $titre;
    /**
     * @var
     */
    private $ingredients;
    /**
     * @var string
     */
    private $preparation;
    /**
     * @var
     */
    private $listeAliments;


    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return string
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * @return mixed
     */
    public function getListeAliments()
    {
        return $this->listeAliments;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

}