<?php
class Citation {

  // ATTRIBUTS
  private $citNum;
  private $perNum;
  private $perNumVal;
  private $perNumEtu;
  private $cit_libelle;
  private $cit_date;
  private $citVal;
  private $citDateVal;
  private $citDateDep;
  private $cit_nom_enseignant;
  private $cit_moyenne;

  // CONSTRUCTEUR
  public function __construct($valeurs = array()){
    if (!empty($valeurs))
    //print_r ($valeurs);
    $this->affecte($valeurs);
  }

  //FONCTION AFFECTE
  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur){
      switch ($attribut){
        case 'cit_num': $this->setCitNum($valeur); break;
        case 'per_num': $this->setPerNum($valeur); break;
        case 'per_num_valide': $this->setPerNumVal($valeur); break;
        case 'per_num_etu': $this->setPerNumEtu($valeur); break;
        case 'cit_libelle': $this->setCitLibelle($valeur); break;
        case 'cit_date': $this->setCitDate($valeur); break;
        case 'cit_valide': $this->setCitVal($valeur); break;
        case 'cit_date_valide': $this->setCitDateVal($valeur); break;
        case 'cit_date_depot': $this->setCitDateDep($valeur); break;
        case 'cit_nom_enseignant': $this->setCitNomEnseignant($valeur); break;
        case 'cit_moyenne': $this->setCitMoyenne($valeur); break;

      }
    }
  }

  // GETTERS
  public function getCitNum()
  {
    return $this->citNum;
  }

  public function getPerNum()
  {
    return $this->perNum;
  }

  public function getPerNumVal()
  {
    return $this->perNumVal;
  }

  public function getPerNumEtu()
  {
    return $this->perNumEtu;
  }

  public function getCitLibelle()
  {
      return $this->cit_libelle;
  }

  public function getCitDate()
  {
      return $this->cit_date;
  }

  public function getCitVal()
  {
    return $this->citVal;
  }

  public function getCitDateVal()
  {
    return $this->citDateVal;
  }

  public function getCitDateDep()
  {
    return $this->citDateDep;
  }

  public function getCitNomEnseignant()
  {
      return $this->cit_nom_enseignant;
  }

  public function getCitMoyenne()
  {
      return $this->cit_moyenne;
  }

  // SETTERS

  public function setCitNum($citNum)
  {
    $this->citNum = $citNum;

    return $this;
  }

  public function setPerNum($perNum)
  {
    $this->perNum = $perNum;

    return $this;
  }

  public function setPerNumVal($perNumVal)
  {
    $this->perNumVal = $perNumVal;

    return $this;
  }

  public function setPerNumEtu($perNumEtu)
  {
    $this->perNumEtu = $perNumEtu;

    return $this;
  }

  public function setCitLibelle($cit_libelle)
  {
      $this->cit_libelle = $cit_libelle;

      return $this;
  }

  public function setCitDate($cit_date)
  {
      $this->cit_date = $cit_date;

      return $this;
  }

  public function setCitVal($citVal)
  {
    $this->citVal = $citVal;

    return $this;
  }

  public function setCitDateVal($citDateVal)
  {
    $this->citDateVal = $citDateVal;

    return $this;
  }

  public function setCitDateDep($citDateDep)
  {
    $this->citDateDep = $citDateDep;

    return $this;
  }

  public function setCitNomEnseignant($cit_nom_enseignant)
  {
      $this->cit_nom_enseignant = $cit_nom_enseignant;

      return $this;
  }

  public function setCitMoyenne($cit_moyenne)
  {
      $this->cit_moyenne = $cit_moyenne;

      return $this;
  }
}
