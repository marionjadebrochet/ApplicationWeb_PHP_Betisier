<?php
class Salarie {

  // ATTRIBUTS
  private $salNum;
  private $perPrenom;
  private $perMail;
  private $tel;
  private $telpro;
  private $fonction;
  private $fonNum;


  // CONSTRUCTEUR
  public function __construct($valeurs = array()) {
    if (!empty($valeurs))
      $this->affecte($valeurs);
  }

  //FONCTION AFFECTE
  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'per_num': $this->setSalNum($valeur); break;
        case 'per_prenom': $this->setPerPrenom($valeur); break;
        case 'per_mail': $this->setPerMail($valeur); break;
        case 'per_tel': $this->setTel($valeur); break;
        case 'sal_telprof': $this->setTelPro($valeur); break;
        case 'fon_libelle': $this->setFonction($valeur); break;
        case 'fon_num': $this->setFonNum($valeur); break;
      }
    }
  }

  // GETTERS
  public function getFonNum()
  {
    return $this->fonNum;
  }
  public function getSalNum()
  {
    return $this->salNum;
  }
  public function getPerPrenom()
  {
    return $this->perPrenom;
  }
  public function getPerMail()
  {
    return $this->perMail;
  }
  public function getTel()
  {
    return $this->tel;
  }
  public function getTelPro()
  {
    return $this->telPro;
  }
  public function getFonction()
  {
    return $this->fonction;
  }

  // SETTERS
  public function setFonNum($fonNum)
  {
    $this->fonNum = $fonNum;
    return $this;
  }
  public function setSalNum($salNum)
  {
    $this->salNum = $salNum;
    return $this;
  }
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
  public function setTel($tel)
  {
    $this->tel = $tel;
    return $this;
  }
  public function setTelPro($telPro)
  {
    $this->telPro = $telPro;
    return $this;
  }
  public function setFonction($fonction)
  {
    $this->fonction = $fonction;
    return $this;
  }

}
?>
