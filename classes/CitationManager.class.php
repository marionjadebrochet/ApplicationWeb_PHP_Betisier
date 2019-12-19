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

    $sql = 'select c.cit_num, concat(p.per_nom, p.per_prenom)
    as cit_nom_enseignant, c.cit_libelle as cit_libelle,
    c.cit_date as cit_date, avg(v.vot_valeur) as cit_moyenne from citation c
    left join personne p on p.per_num = c.per_num
    left join vote v on c.cit_num = v.cit_num
    where c.cit_valide = 1 and c.cit_date_valide is not null
    group by c.cit_num, p.per_nom, c.cit_libelle, c.cit_date';

    $requete = $this->db->query($sql);
    $requete->execute();
    while ($citation = $requete->fetch(PDO::FETCH_OBJ))
    $listeCitation[] = new Citation($citation);

    $requete->closeCursor();
    return $listeCitation;
  }

  //fonction qui retourne le nombre de citation
  public function countCitation() {
    $sql = 'select count(cit_num) as nbrCitation from citation where cit_valide = 1 and cit_date_valide is not null';
    $requete = $this->db->query($sql);
    $count = $requete->fetch();
    $requete->closeCursor();
    return $count['nbrCitation'];
  }

  //fonction qui ajoute une citation
  public function add($newCitation){
    $req=$this->db->prepare(
      'insert into citation (per_num, per_num_etu, cit_libelle, cit_date, cit_date_depo)
      values(:pernum,:pernum_etu,:libelle,:dat,:date_depo)');
      $req->bindValue(':pernum',$newCitation->getPerNum(),PDO::PARAM_INT);
      $req->bindValue(':pernum_etu',$newCitation->getPerNumEtu(),PDO::PARAM_INT );
      $req->bindValue(':libelle',$newCitation->getCitLibelle(),PDO::PARAM_STR);
      $req->bindValue(':dat',$newCitation->getCitDate(),PDO::PARAM_STR );
      $req->bindValue(':date_depo',$newCitation->getCitDateDep(),PDO::PARAM_STR);
      $req->execute();
    }

    public function getBonnesCitations($num,$date1,$date2,$basse,$haute)
    {
      $listeCitation = array();

      $sql = 'select concat(p.per_nom, p.per_prenom)
      as cit_nom_enseignant, c.cit_libelle as cit_libelle,
      c.cit_date as cit_date, avg(v.vot_valeur) as cit_moyenne from citation c
      left join personne p on p.per_num = c.per_num
      left join vote v on c.cit_num = v.cit_num
      where c.cit_valide = 1 and c.cit_date_valide is not null AND c.per_num = '.$num
      .' and cit_date between \''.$date1.'\' and \''.$date2.'\' group by c.cit_num, p.per_nom, c.cit_libelle, c.cit_date
      having avg (v.vot_valeur) > '.$basse.' and avg(v.vot_valeur) < '.$haute;

      $requete = $this->db->query($sql);
      $requete->execute();
      while ($citation = $requete->fetch(PDO::FETCH_OBJ))
      $listeCitation[] = new Citation($citation);

      $requete->closeCursor();
      return $listeCitation;
    }

    public function getCitationsNonValide()
    {
      $listeCitation = array();

      $sql = 'select c.cit_num, CONCAT(p.per_nom, p.per_prenom) as cit_nom_enseignant,
      c.cit_libelle as cit_libelle, c.cit_date as cit_date,
      avg(v.vot_valeur) as cit_moyenne from citation c left join personne p on
      p.per_num = c.per_num left join vote v on c.cit_num = v.cit_num
      where cit_valide = 0
      group by c.cit_num, p.per_nom, c.cit_libelle, c.cit_date';

      $requete = $this->db->query($sql);
      $requete->execute();
      while ($citation = $requete->fetch(PDO::FETCH_OBJ))
      $listeCitation[] = new Citation($citation);

      $requete->closeCursor();
      return $listeCitation;
    }

    //fonction qui update une citation après validation
    public function validerCitation($num) {
      $sql = 'update citation set cit_valide = 1 where cit_num = '.$num;
      $requete = $this->db->query($sql);
      $requete->execute();
      $requete->closeCursor();
    }

    public function getAllCitations() {
      $listeCitation = array();

      $sql = 'select c.cit_num, concat(p.per_nom, p.per_prenom)
      as cit_nom_enseignant, c.cit_libelle as cit_libelle,
      c.cit_date as cit_date, AVG(v.vot_valeur) as cit_moyenne from citation c
      left join personne p on p.per_num = c.per_num
      left join vote v on c.cit_num = v.cit_num
      group by c.cit_num, p.per_nom, c.cit_libelle, c.cit_date';

      $requete = $this->db->query($sql);
      $requete->execute();
      while ($citation = $requete->fetch(PDO::FETCH_OBJ))
      $listeCitation[] = new Citation($citation);

      $requete->closeCursor();
      return $listeCitation;
    }

    //fonction qui supprime une citation
    public function supprimerCitation($num) {
      $sql = 'delete from citation where cit_num = '.$num;
      $requete = $this->db->query($sql);
      $requete->execute();
      $requete->closeCursor();
    }

    public function votedBy($numEtu, $numCitation) {
      $sql = 'select count(cit_num) as nbrCitation from vote where cit_num ='.$numCitation.' and per_num ='.$numEtu;
      $requete = $this->db->query($sql);
      $count = $requete->fetch();
      $requete->closeCursor();
      return $count['nbrCitation'];
    }

    public function vote($numEtu, $numCitation, $note) {
      $req=$this->db->prepare(
        'INSERT INTO vote(cit_num, per_num, vot_valeur)
        VALUES(:citnum,:pernum,:note)');
        $req->bindValue(':pernum',$numEtu,PDO::PARAM_INT);
        $req->bindValue(':citnum',$numCitation,PDO::PARAM_INT);
        $req->bindValue(':note',$note,PDO::PARAM_INT);

        $req->execute();
      }
    }
<<<<<<< HEAD

    public function isValide($citation) {
      $sql = 'select mot_interdit from mot where match(mot_interdit) against (\''.$citation.'\')';
      $requete = $this->db->query($sql);
      $mots = $requete->fetch(PDO::PARAM_STR);
      $requete->closeCursor();
      return $mots['mot_interdit'];
    }
}
?>
=======
    ?>
>>>>>>> 9dad2d2ae871e2ddece5602ca86f558efc9acaa8
