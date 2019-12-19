<?php
class Division {

  // ATTRIBUTS
  private $num;
  private $nom;

  // CONSTRUCTEUR
  public function __construct($div = array()){
    if (!empty($div))
      $this->affecte($div);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'div_num': $this->setDivNum($valeur);
        break;
        case 'div_nom': $this->setDivNom($valeur);
        break;
      }
    }
  }

  // GETTERS
  public function getDivNum()
  {
    return $this->num;
  }

  public function getDivNom()
  {
    return $this->nom;
  }

  // SETTERS

  public function setDivNum($num)
  {
    $this->num = $num;

    return $this;
  }

  public function setDivNom($nom)
  {
    $this->nom = $nom;

    return $this;
  }
}
