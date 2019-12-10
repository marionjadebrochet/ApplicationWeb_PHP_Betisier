<?php
class DepartementManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet ville.
  public function getList() {
          $listeDepartement = array();

          $sql = 'select dep_num, dep_nom from departement';

          $requete = $this->db->query($sql);

          while ($dep = $requete->fetch(PDO::FETCH_OBJ))
              $listeDepartement[] = new Departement($dep);

          $requete->closeCursor();
          return $listeDepartement;
    }
}
?>
