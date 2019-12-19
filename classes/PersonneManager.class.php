<?php
class PersonneManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
  public function __construct($db){
    $this->db = $db;
  }

  // FONCTIONS
  
  //fonction qui retourne un tableau d'objet personne.
  public function getList() {
    $listePersonne = array();

    $sql = 'select per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd from personne';
    $requete = $this->db->query($sql);
    $requete->execute();
    while ($personne = $requete->fetch(PDO::FETCH_OBJ))
    $listePersonne[] = new Personne($personne);

    $requete->closeCursor();
    return $listePersonne;
  }

  //fonction qui retourne un tableau d'objet personne de type salarie.
  public function getListSalarie() {
    $listeSalarie = array();

    $sql = 'select per_nom, p.per_num from personne p join salarie s on p.per_num=s.per_num';
    $requete = $this->db->query($sql);
    $requete->execute();
    while ($personne = $requete->fetch(PDO::FETCH_OBJ))
    $listeSalarie[] = new Personne($personne);

    $requete->closeCursor();
    return $listeSalarie;
  }

  //fonction qui retourne le nombre de personne
  public function countPersonne() {
    $sql = 'select count(per_num) as nbrpersonne from PERSONNE';
    $requete = $this->db->query($sql);
    $count = $requete->fetch();
    $requete->closeCursor();
    return $count['nbrpersonne'];
  }

  //fonction qui permet d'ajouter une personne
  public function addPersonne($personne) {
    $req = $this->db->prepare(
      'INSERT INTO PERSONNE (per_admin, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
      VALUES (:admin, :nom, :prenom, :tel, :mail, :login, :pwd)');
      $req->bindValue(':nom', $personne->getPerNom());
      $req->bindValue(':prenom', $personne->getPerPrenom());
      $req->bindValue(':tel', $personne->getPerTel());
      $req->bindValue(':mail', $personne->getPerMail());
      $req->bindValue(':login', $personne->getPerLogin());
      $req->bindValue(':pwd', $personne->getPerPWD());
      $req->bindValue(':admin', 0);
      $req->execute();
    }

    //fonction pour utiliser le LAST_INSERT_ID et réupère l'id de la personne d'avant
    public function lastInsertId() {
      $req = $this->db->query("select LAST_INSERT_ID()");
      $req->execute();
      $lastId = $req->fetchColumn();
      return $lastId;
    }

    //fonction pour vérifier que la personne est un admin
    public function isAdmin($num) {
      $sql = 'select count(*) as admin from personne where per_admin = 1 and per_num ='.$num;
      $requete = $this->db->query($sql);
      $res = $requete->fetch();

      if ($res["admin"]) {
        return 1;
      } else {
        return 0;
      }
      $requete->closeCursor();
    }

    //fonction pour supprimer une ville
    public function delete($personne) {
      $req1 = $this->db->prepare('delete from vote where per_num ='. $personne);
      $req1->execute();
      $req2 = $this->db->prepare('delete from citation where per_num ='. $personne);
      $req2->execute();
      $req3 = $this->db->prepare('delete from citation where per_num_etu='. $personne);
      $req3->execute();
      $req4 = $this->db->prepare('delete from salarie where per_num ='. $personne);
      $req4->execute();
      $req5 = $this->db->prepare('delete from etudiant where per_num ='. $personne);
      $req5->execute();
      $req6 = $this->db->prepare('delete from personne where per_num ='. $personne);
      $req6->execute();
    }

    //fonction pour vérifier que la personne est un etudiant
    public function isEtudiant($num) {
      $sql = 'select count(*) as etudiant from etudiant where per_num ='.$num;
      $requete = $this->db->query($sql);
      $res = $requete->fetch();

      if ($res["etudiant"]) {
        return 1;
      } else {
        return 0;
      }
      $requete->closeCursor();
    }

    //fonction qui permet de voir si c'est un salarié
    public function estSalarie($num) {
      $sql = 'select count(*) as nbrSalarie from salarie where per_num =' . $num;
      $requete = $this->db->query($sql);
      $nbrSalarie = $requete->fetch();

      if ($nbrSalarie['nbrSalarie']) {
        return 1;
      } else {
        return 0;
      }
      $requete->closeCursor();
    }

    //fonction pour mettre a jour les personne dans Modifier personne
    public function update($personne, $per_num){
      $req = $this->db->prepare(
        'update `personne` set `per_nom` = :nom, `per_prenom` = :prenom, `per_tel` = :tel, `per_mail` = :mail, `per_login` = :login, `per_pwd` = :pwd
        WHERE `personne`.`per_num` = :num');

        $req->bindValue(':nom', $personne->getPerNom(),PDO::PARAM_STR);
        $req->bindValue(':prenom', $personne->getPerPrenom(),PDO::PARAM_STR);
        $req->bindValue(':tel', $personne->getPerTel(),PDO::PARAM_STR);
        $req->bindValue(':mail', $personne->getPerMail(),PDO::PARAM_STR);
        $req->bindValue(':login', $personne->getPerLogin(),PDO::PARAM_STR);
        $req->bindValue(':pwd', $personne->getPerPwd(),PDO::PARAM_STR);
        $req->bindValue(':num',$per_num,PDO::PARAM_STR);
        $req->execute();
      }
    }
    ?>
