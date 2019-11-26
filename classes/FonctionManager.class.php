<?php
class FonctionManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet ville.
  public function getList() {
          $listeFonction = array();

          $sql = 'select fon_num, fon_libelle FROM FONCTION';

          $requete = $this->db->query($sql);

          while ($fon = $requete->fetch(PDO::FETCH_OBJ))
              $listeFonction[] = new Fonction($fon);

          $requete->closeCursor();
          return $listeFonction;
    }
}
?>
