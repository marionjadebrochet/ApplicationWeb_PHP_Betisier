<?php
class VilleManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet ville.
  public function getList() {
          $listeVilles = array();

          $sql = 'select vil_num, vil_nom FROM VILLE';

          $requete = $this->db->query($sql);

          while ($ville = $requete->fetch(PDO::FETCH_OBJ))
              $listeVilles[] = new Ville($ville);

          $requete->closeCursor();
          return $listeVilles;
    }

    //fonction qui retourne le nombre de ville
    public function countVille() {
            $sql = 'select count(vil_nom) as nbrVille FROM VILLE';
            $requete = $this->db->query($sql);
            $count = $requete->fetch();
            $requete->closeCursor();
            return $count['nbrVille'];
      }

    //fonction pour ajouter un client
    public function add($ville) {
      $req = $this->db->prepare(
        'INSERT INTO ville (vil_nom) VALUES (:nom)');
        $req->bindValue(':nom', $ville->getVilNom());
        $req->execute();
    }
}
?>
