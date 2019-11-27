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
    $sql = 'select vil_num, vil_nom from ville';
    $requete = $this->db->query($sql);
    while ($ville = $requete->fetch(PDO::FETCH_OBJ))
    $listeVilles[] = new Ville($ville);
    $requete->closeCursor();
    return $listeVilles;
  }

  //fonction qui retourne un tableau d'objet ville qui n'ont pas de département.
  public function getListVilleSansDep() {
    $listeVilles = array();
    $sql = 'select v.vil_num, v.vil_nom from ville v where vil_num not in (select vil_num from departement)';
    $requete = $this->db->query($sql);
    while ($ville = $requete->fetch(PDO::FETCH_OBJ))
    $listeVilles[] = new Ville($ville);
    $requete->closeCursor();
    return $listeVilles;
  }

  //fonction qui retourne le nombre de ville
  public function countVille() {
    $sql = 'select count(vil_nom) as nbrVille from ville';
    $requete = $this->db->query($sql);
    $count = $requete->fetch();
    $requete->closeCursor();
    return $count['nbrVille'];
  }

  //fonction pour ajouter une ville
  public function add($ville) {
    $req = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES (:nom)');
    $req->bindValue(':nom', $ville->getVilNom());
    $req->execute();
  }

  //fonction pour supprimer une ville
  public function delete($ville) {
    $req = $this->db->prepare('delete from ville where vil_num ='. $ville);
    $req->execute();
    }

    //fonction pour modifier une ville
    public function update($ville, $nomVille) {
      $req = $this->db->prepare('update ville set vil_nom ="' . $nomVille .'" where vil_num ='. $ville);
      $req->execute();
    }
}?>
