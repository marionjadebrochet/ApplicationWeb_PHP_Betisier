<?php
class EtudiantManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet citation.
  public function getListEtu($num) {
          $listeEtudiant = array();

            $sql = 'select per_prenom, per_mail, per_tel, dep_nom, vil_nom from personne p
                    join etudiant e on p.per_num=e.per_num
                    join departement d on e.dep_num=d.dep_num
                    join ville v on d.vil_num = v.vil_num
                    where p.per_num = '. $num;
          $requete = $this->db->query($sql);
          $requete->execute();
          while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
              $listeEtudiant[] = new Etudiant($etudiant);

          $requete->closeCursor();
          return $listeEtudiant;
    }

    public function addEtudiant($etudiant) {
      $req = $this->db->prepare(
        'INSERT INTO etudiant (per_num, dep_num, div_num)
         VALUES (:num, :depNum, :divNum)');
        $req->bindValue(':num', $etudiant->getEtuNum());
        $req->bindValue(':depNum', $etudiant->getDepNum());
        $req->bindValue(':divNum', $etudiant->getDivNum());
        $req->execute();
    }
 }
