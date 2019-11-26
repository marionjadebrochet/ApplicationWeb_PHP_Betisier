<?php
class Departement {

  // ATTRIBUTS
  private $num;
  private $nom;

  // CONSTRUCTEUR
  public function __construct($dep = array()){
  	if (!empty($dep))
  			//print_r ($valeurs);
  			 $this->affecte($dep);
  }

  public function affecte($donnees){
       foreach ($donnees as $attribut => $valeur){
           switch ($attribut){
               case 'dep_num': $this->setDepNum($valeur);
               break;
               case 'dep_nom': $this->setDepNom($valeur);
               break;
           }
       }
   }

  // GETTERS
  public function getDepNum()
  {
    return $this->num;
  }

  public function getDepNom()
  {
    return $this->nom;
  }

  // SETTERS

  public function setDepNum($num)
  {
    $this->num = $num;

    return $this;
  }

  public function setDepNom($nom)
  {
    $this->nom = $nom;

    return $this;
  }

}
