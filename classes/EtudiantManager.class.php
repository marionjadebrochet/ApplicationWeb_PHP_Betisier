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

  //fonction pour ajouter un étudiant
  public function addEtudiant($etudiant) {
    $req = $this->db->prepare(
      'insert into etudiant (per_num, dep_num, div_num)
      values (:num, :depNum, :divNum)');
      $req->bindValue(':num', $etudiant->getEtuNum());
      $req->bindValue(':depNum', $etudiant->getDepNum());
      $req->bindValue(':divNum', $etudiant->getDivNum());
      $req->execute();
    }

    //fonction pour mettre a jour un etudiant dans ModifierPersonne
    public function updateEtudiant($etudiant){
      $req = $this->db->prepare('update `etudiant` set `dep_num` = :dep_num, `div_num` = :div_num where `etudiant`.`per_num` = :num');
      $req->bindValue(':num',$etudiant->getEtuNum(),PDO::PARAM_STR);
      $req->bindValue(':dep_num',$etudiant->getDepNum(),PDO::PARAM_STR);
      $req->bindValue(':div_num',$etudiant->getDivNum(),PDO::PARAM_STR);
      $retour=$req->execute();
    }

    //fonction pour supprimé un étudiant
    public function suppEtu($numero){
      $req = $this->db->prepare('delete from `etudiant` where `etudiant`.`per_num` = :numero');
      $req->bindValue(':numero',$numero,PDO::PARAM_STR);
      $retour=$req->execute();
    }

    //fonction pour mettre a jour un salarié en étudiat dans ModifierPersonne
    public function updateSalEnEtu($etudiant){
      $req = $this->db->prepare('insert into etudiant (per_num, dep_num, div_num) values (:per_num, :dep_num, :div_num)');
      $req->bindValue(':per_num',$etudiant->getEtuNum(),PDO::PARAM_STR);
      $req->bindValue(':dep_num',$etudiant->getDepNum(),PDO::PARAM_STR);
      $req->bindValue(':div_num',$etudiant->getDivNum(),PDO::PARAM_STR);
      $retour=$req->execute();
    }


  }
