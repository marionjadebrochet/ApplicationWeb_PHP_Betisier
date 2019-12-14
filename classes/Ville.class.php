<?php
class Ville {

  // ATTRIBUTS
  private $num;
  private $nom;

  // CONSTRUCTEUR
  public function __construct($ville = array()){
    if (!empty($ville))
      $this->affecte($ville);
  }

  //FONCTION AFFECTE
  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'vil_num': $this->setVilnum($valeur);
        break;
        case 'vil_nom': $this->setVilnom($valeur);
        break;
      }
    }
  }

  // GETTERS
  public function getVilNum()
  {
    return $this->num;
  }

  public function getVilNom()
  {
    return $this->nom;
  }

  // SETTERS

  public function setVilNum($num)
  {
    $this->num = $num;
    return $this;
  }

  public function setVilNom($nom)
  {
    $this->nom = $nom;
    return $this;
  }

}
