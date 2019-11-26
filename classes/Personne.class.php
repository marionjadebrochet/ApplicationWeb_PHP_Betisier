<?php
class Personne {

  // ATTRIBUTS
  private $perNum;
  private $perNom;
  private $perPrenom;
  private $perTel;
  private $perMail;
  private $perAdmin;
  private $perLogin;
  private $perPWD;

  // CONSTRUCTEUR
  public function __construct($valeurs = array()) {
    if (!empty($valeurs))
    //print_r ($valeurs);
    $this->affecte($valeurs);
  }

  //FONCTION AFFECTE
  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'per_num': $this->setPerNum($valeur); break;
        case 'per_nom': $this->setPerNom($valeur); break;
        case 'per_prenom': $this->setPerPrenom($valeur); break;
        case 'per_tel': $this->setPerTel($valeur); break;
        case 'per_mail': $this->setPerMail($valeur); break;
        case 'per_admin': $this->setPerAdmin($valeur); break;
        case 'per_login': $this->setPerLogin($valeur); break;
        case 'per_pwd': $this->setPerPWD($valeur); break;
      }
    }
  }
  // GETTERS
  public function getPerNum()
  {
    return $this->perNum;
  }

  public function getPerNom()
  {
    return $this->perNom;
  }

  public function getPerPrenom()
  {
    return $this->perPrenom;
  }

  public function getPerTel()
  {
    return $this->perTel;
  }

  public function getPerMail()
  {
    return $this->perMail;
  }

  public function getPerAdmin()
  {
    return $this->perAdmin;
  }

  public function getPerLogin()
  {
    return $this->perLogin;
  }

  public function getPerPWD()
  {
    return $this->perPWD;
  }

  // SETTERS

  public function setPerNum($perNum)
  {
    $this->perNum = $perNum;

    return $this;
  }

  public function setPerNom($perNom)
  {
    $this->perNom = $perNom;

    return $this;
  }

  public function setPerPrenom($perPrenom)
  {
    $this->perPrenom = $perPrenom;

    return $this;
  }

  public function setPerTel($perTel)
  {
    $this->perTel = $perTel;

    return $this;
  }

  public function setPerMail($perMail)
  {
    $this->perMail = $perMail;

    return $this;
  }

  public function setPerAdmin($perAdmin)
  {
    $this->perAdmin = $perAdmin;

    return $this;
  }

  public function setPerLogin($perLogin)
  {
    $this->perLogin = $perLogin;

    return $this;
  }

  public function setPerPWD($perPWD)
  {
    $this->perPWD = $perPWD;

    return $this;
  }
}
