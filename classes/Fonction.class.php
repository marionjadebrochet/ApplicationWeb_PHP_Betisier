<?php
class Fonction {

  // ATTRIBUTS
  private $num;
  private $libelle;

  // CONSTRUCTEUR
  public function __construct($fonc = array()){
    if (!empty($fonc))
    $this->affecte($fonc);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'fon_num': $this->setFonNum($valeur);
        break;
        case 'fon_libelle': $this->setFonLib($valeur);
        break;
      }
    }
  }

  // GETTERS
  public function getFonNum()
  {
    return $this->num;
  }

  public function getFonLib()
  {
    return $this->libelle;
  }

  // SETTERS
  public function setFonNum($num)
  {
    $this->num = $num;
    return $this;
  }

  public function setFonLib($libelle)
  {
    $this->libelle = $libelle;
    return $this;
  }
}
