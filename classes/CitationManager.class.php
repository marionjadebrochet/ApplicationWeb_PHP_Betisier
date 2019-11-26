<?php
class CitationManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet citation.
  public function getList() {
          $listeCitation = array();

          $sql = 'SELECT CONCAT(p.per_nom, p.per_prenom)
          as cit_nom_enseignant, c.cit_libelle as cit_libelle,
          c.cit_date as cit_date, AVG(v.vot_valeur) as cit_moyenne FROM CITATION c
          LEFT JOIN PERSONNE p ON p.per_num = c.per_num
          LEFT JOIN VOTE v ON c.cit_num = v.cit_num
          WHERE c.cit_valide = 1 AND c.cit_date_valide is not null
          GROUP BY c.cit_num, p.per_nom, c.cit_libelle, c.cit_date';

          $requete = $this->db->query($sql);
          $requete->execute();
          while ($citation = $requete->fetch(PDO::FETCH_OBJ))
              $listeCitation[] = new Citation($citation);

          $requete->closeCursor();
          return $listeCitation;
    }

    //fonction qui retourne le nombre de citation
    public function countCitation() {
            $sql = 'SELECT count(cit_num) as nbrCitation FROM CITATION   WHERE cit_valide = 1 AND cit_date_valide is not null';
            $requete = $this->db->query($sql);
            $count = $requete->fetch();
            $requete->closeCursor();
            return $count['nbrCitation'];
      }
}
?>
