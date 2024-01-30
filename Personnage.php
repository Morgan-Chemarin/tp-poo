<?php

class Personnage
{
    public $nom = "";
    public $metier = "";
    public $xP = 1;
    public $pV;
    public $pA;
    public $pD;
    public $force;
    public $agilite;
    public $intelligence;
    public $chance;
    public $inventaire = [];
    public $placeRestante = 0;
    private $id = 0;

    public function __construct($nom, $metier)
    {
        $this->pA = rand(5, 10);
        $this->pD = rand(5, 10);
        $this->pV = rand(15, 20);
        $this->force = rand(5, 10);
        $this->agilite = rand(5, 10);
        $this->intelligence = rand(5, 10);
        $this->chance = rand(5, 10);

        $this->nom = $nom;
        $this->metier = $metier;
    }
    public function setId($i)
    {
        $this->id = $i;
    }
    public function getIdentifiant()
    {
        return $this->id;
    }


    public function affichage()
    {
        echo "Nom: " . $this->nom . "<br>";
        echo "Métier: " . $this->metier . "<br>";
        echo "Niveau d'expérience: " . $this->xP . "<br>";
        echo "Points de vie: " . $this->pV . "<br>";
        echo "Points d'attaque: " . $this->pA . "<br>";
        echo "Points de défense: " . $this->pD . "<br>";
        echo "Force: " . $this->force . "<br>";
        echo "Agilité: " . $this->agilite . "<br>";
        echo "Intelligence: " . $this->intelligence . "<br>";
        echo "Chance: " . $this->chance . "<br>";
        echo "Inventaire : ";
        foreach ($this->inventaire as $element) {
            echo $element->nom . " | ";
        }
    }

    public function niveauSuivant()
    {
        $this->xP++;
        $this->pV += min(rand(1, 3), 20);
        $this->pA += min(rand(0, 2), 20);
        $this->pD += min(rand(0, 2), 20);
        $this->agilite += min(rand(0, 2), 20);
        $this->intelligence += min(rand(0, 2), 20);
        $this->force += min(rand(0, 2), 20);
        $this->chance += min(rand(0, 2), 20);
    }

    public function ajouterEquipement(Equipement $equipement)
    {
        if (count($this->inventaire) < 30) {
            $this->inventaire[] = $equipement;
            $this->placeRestante = 30 - count($this->inventaire);
            echo "L'équipement '" . $equipement->nom . "' a été ajouté à l'inventaire.<br>";
        } else {
            echo "L'inventaire est plein. Impossible d'ajouter l'équipement '" . $equipement->nom . "'.<br>";
        }
    }
}

class Equipement
{
    public $nom = "";
    public $place = 1;
    protected $id = 0;

    public function setId($i)
    {
        $this->id = $i;
    }
    public function getIdentifiant()
    {
        return $this->id;
    }
}

class Arme extends Equipement
{
    public $typeMetier = "";
    public $degats = 1;

    public function __construct($nom, $place, $typeMetier, $degats)
    {
        $this->nom = $nom;
        $this->place = $place;
        $this->typeMetier = $typeMetier;
        $this->degats = $degats;
    }

    public function affichage()
    {
        echo "<br>Nom: " . $this->nom . "<br>";
        echo "Place: " . $this->place . "<br>";
        echo "Metier: " . $this->typeMetier . "<br>";
        echo "Degats: " . $this->degats . "<br>";

    }
}
