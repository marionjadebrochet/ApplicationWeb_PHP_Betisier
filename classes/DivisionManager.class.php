<?php
class DivisionManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
  public function __construct($db){
    $this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet ville.
  public function getList() {
    $listeDivision = array();
    $sql = 'select div_num, div_nom from division';
    $requete = $this->db->query($sql);
    while ($div = $requete->fetch(PDO::FETCH_OBJ))
    $listeDivision[] = new Division($div);
    $requete->closeCursor();
    return $listeDivision;
  }
}
?>
