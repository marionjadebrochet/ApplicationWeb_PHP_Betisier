<?php
class Etudiant {

  // ATTRIBUTS
  private $etuNum;
  private $depNum;
  private $perMail;
  private $divNum;
  private $perTel;
  private $depNom;
  private $vilNom;

  // CONSTRUCTEUR
  public function __construct($valeurs = array()) {
    if (!empty($valeurs))
      $this->affecte($valeurs);
  }

  //FONCTION AFFECTE
  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'per_num': $this->setEtuNum($valeur); break;
        case 'dep_num': $this->setDepNum($valeur); break;
        case 'div_num': $this->setDivNum($valeur); break;
        case 'per_prenom': $this->setPerPrenom($valeur); break;
        case 'per_mail': $this->setPerMail($valeur); break;
        case 'per_tel': $this->setPerTel($valeur); break;
        case 'dep_nom': $this->setDepNom($valeur); break;
        case 'vil_nom': $this->setVilNom($valeur); break;
      }
    }
  }

  // GETTERS
  public function getPerPrenom()
  {
    return $this->perPrenom;
  }

  public function getPerMail()
  {
    return $this->perMail;
  }

  public function getPerTel()
  {
    return $this->perTel;
  }

  public function getDepNom()
  {
    return $this->depNom;
  }

  public function getVilNom()
  {
    return $this->vilNom;
  }
  public function getEtuNum()
  {
    return $this->etuNum;
  }

  public function getDepNum()
  {
    return $this->depNum;
  }

  public function getDivNum()
  {
    return $this->divNum;
  }

  // SETTERS

  public function setPerPrenom($perPrenom)
  {
    $this->perPrenom = $perPrenom;
    return $this;
  }

  public function setPerMail($perMail)
  {
    $this->perMail = $perMail;
    return $this;
  }

  public function setPerTel($perTel)
  {
    $this->perTel = $perTel;
    return $this;
  }

  public function setDepNom($depNom)
  {
    $this->depNom = $depNom;
    return $this;
  }

  public function setVilNom($vilNom)
  {
    $this->vilNom = $vilNom;
    return $this;
  }

  public function setEtuNum($etuNum)
  {
    $this->etuNum = $etuNum;
    return $this;
  }

  public function setDepNum($depNum)
  {
    $this->depNum = $depNum;
    return $this;
  }

  public function setDivNum($divNum)
  {
    $this->divNum = $divNum;
    return $this;
  }
}
?>
